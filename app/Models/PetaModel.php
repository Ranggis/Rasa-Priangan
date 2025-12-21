<?php

namespace App\Models;

use CodeIgniter\Model;

class PetaModel extends Model
{
    protected $table = 'pusat_oleh_oleh';
    protected $primaryKey = 'id';

    public function getAllLokasi()
    {
        return $this->db->table($this->table)
            ->select('
                pusat_oleh_oleh.*, 
                kategori.nama_kategori, 
                kategori.icon_marker, 
                kategori.kategori_slug, 
                AVG(ulasan.rating) as rata_rata_rating,
                ST_AsGeoJSON(pusat_oleh_oleh.wilayah_polygon) as polygon_data
            ') // <-- TAMBAHKAN ST_AsGeoJSON di sini
            ->join('kategori', 'kategori.id_kategori = pusat_oleh_oleh.kategori_id', 'left')
            ->join('ulasan', 'ulasan.toko_id = pusat_oleh_oleh.id', 'left')
            ->groupBy('pusat_oleh_oleh.id')
            ->get()->getResultArray();
    }

    public function getKategori()
    {
        // Mengambil kategori untuk filter di peta
        return $this->db->table('kategori')->get()->getResultArray();
    }

    // --- FITUR BARU: AMBIL ULASAN ---
    public function getUlasanByToko($toko_id)
    {
        return $this->db->table('ulasan')
            ->where('toko_id', $toko_id)
            ->orderBy('tanggal_ulasan', 'DESC')
            ->get()->getResultArray();
    }

    // --- FITUR BARU: SIMPAN ULASAN ---
    public function insertUlasan($data)
    {
        return $this->db->table('ulasan')->insert($data);
    }
}