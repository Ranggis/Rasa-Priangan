<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PetaModel;
use CodeIgniter\Controller; // Pastikan ini ada

class Home extends BaseController
{
    protected $petaModel;
    protected $adminModel;

    public function __construct()
    {
        $this->petaModel = new PetaModel();
        $this->adminModel = new AdminModel();
    }

    // --- 1. HALAMAN UTAMA (PUBLIC) ---
    public function index()
    {
        return view('pages/beranda');
    }

    public function katalog()
    {
        // QUERY UPDATE: Mengambil data polygon dalam format JSON agar bisa dipakai di peta katalog
        $db = \Config\Database::connect();
        $query = $db->table('pusat_oleh_oleh p')
            ->select('p.*, k.nama_kategori, ST_AsGeoJSON(p.wilayah_polygon) as polygon_data')
            ->join('kategori k', 'k.id_kategori = p.kategori_id', 'left')
            ->get();

        $data = [
            'title'    => 'Katalog Produk | Rasa Priangan',
            'toko'     => $query->getResultArray(),
            'kategori' => $this->petaModel->getKategori()
        ];
        return view('pages/katalog', $data);
    }

    // Fungsi tambahan untuk API (dipanggil oleh AJAX di halaman peta)
    public function get_locations()
    {
        $db = \Config\Database::connect();
        $query = $db->table('pusat_oleh_oleh p')
            ->select('p.*, k.nama_kategori, k.icon_marker, ST_AsGeoJSON(p.wilayah_polygon) as polygon_data')
            ->join('kategori k', 'k.id_kategori = p.kategori_id', 'left')
            ->get();
        
        return $this->response->setJSON($query->getResultArray());
    }

    public function map()
    {
        return view('pages/peta_interaktif');
    }

    // --- 2. SISTEM AUTENTIKASI ADMIN ---
    // ... (tetap sama seperti kodinganmu) ...

    public function auth()
    {
        $session = session();
        $username = $this->request->getPost('user_identity');
        $password = $this->request->getPost('user_secret');

        $user = $this->adminModel->where('username', $username)->first();

        if ($user) {
            // Gunakan password_verify jika password di hash, 
            // tapi jika masih plain text gunakan perbandingan biasa
            if ($password == $user['password']) {
                $session->set([
                    'id_admin'    => $user['id'],
                    'username'    => $user['username'],
                    'nama_admin'  => $user['nama_lengkap'],
                    'logged_in'   => TRUE
                ]);
                return redirect()->to(base_url('admin'));
            } else {
                $session->setFlashdata('msg', 'Access Key Tidak Valid.');
                return redirect()->to(base_url('login'));
            }
        } else {
            $session->setFlashdata('msg', 'Identitas Admin Tidak Terdeteksi.');
            return redirect()->to(base_url('login'));
        }
    }

    // --- 3. DASHBOARD ADMIN & CRUD ---
    public function admin_dashboard()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title'    => 'Dashboard Admin | Rasa Priangan',
            'toko'     => $this->petaModel->getAllLokasi(),
            'kategori' => $this->petaModel->getKategori()
        ];
        return view('pages/admin_dashboard', $data);
    }

    public function admin_save()
    {
        if (!session()->get('logged_in')) return redirect()->to(base_url('login'));

        $fileFoto = $this->request->getFile('foto');
        if ($fileFoto->isValid() && !$fileFoto->hasMoved()) {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('assets/image/', $namaFoto);
        } else {
            $namaFoto = 'default.jpg';
        }

        // Ambil data polygon dari input (biasanya format WKT: POLYGON((...)))
        $polygonWKT = $this->request->getPost('wilayah_polygon');

        $dataInsert = [
            'nama_toko'       => $this->request->getPost('nama_toko'),
            'kategori_id'     => $this->request->getPost('kategori_id'),
            'alamat'          => $this->request->getPost('alamat'),
            'lat'             => $this->request->getPost('lat'),
            'lng'             => $this->request->getPost('lng'),
            'produk_unggulan' => $this->request->getPost('produk_unggulan'),
            'jam_operasional' => $this->request->getPost('jam_operasional'),
            'foto'            => $namaFoto
        ];

        // Jalankan Query manual untuk menyisipkan ST_GeomFromText
        $db = \Config\Database::connect();
        if (!empty($polygonWKT)) {
            $db->query("INSERT INTO pusat_oleh_oleh (nama_toko, kategori_id, alamat, lat, lng, produk_unggulan, jam_operasional, foto, wilayah_polygon) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ST_GeomFromText(?))", [
                $dataInsert['nama_toko'],
                $dataInsert['kategori_id'],
                $dataInsert['alamat'],
                $dataInsert['lat'],
                $dataInsert['lng'],
                $dataInsert['produk_unggulan'],
                $dataInsert['jam_operasional'],
                $dataInsert['foto'],
                $polygonWKT
            ]);
        } else {
            $db->table('pusat_oleh_oleh')->insert($dataInsert);
        }

        return redirect()->to(base_url('admin'))->with('success', 'Data toko berhasil ditambahkan!');
    }

    public function admin_delete($id)
    {
        if (!session()->get('logged_in')) return redirect()->to(base_url('login'));

        $this->petaModel->db->table('pusat_oleh_oleh')->where('id', $id)->delete();
        return redirect()->to(base_url('admin'))->with('success', 'Data toko berhasil dihapus!');
    }
}