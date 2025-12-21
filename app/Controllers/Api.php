<?php

namespace App\Controllers;

use App\Models\PetaModel;
use CodeIgniter\Controller;
use Config\Services;

class Api extends Controller
{
    public function geojson()
    {
        $model = new PetaModel();
        $data = $model->getAllLokasi();
        $features = [];

        foreach ($data as $row) {
            $features[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float)$row['lng'], (float)$row['lat']]
                ],
                'properties' => [
                    'id'     => $row['id'],
                    'nama'   => $row['nama_toko'],
                    'slug'   => $row['kategori_slug'],
                    'alamat' => $row['alamat'],
                    'produk' => $row['produk_unggulan'],
                    'lat'    => $row['lat'],
                    'lng'    => $row['lng'],
                    'foto'   => base_url('assets/image/' . $row['foto']),
                    'rating' => round($row['rata_rata_rating'], 1) ?: 0
                ]
            ];
        }

        return $this->response->setJSON([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }

    public function categories()
    {
        return $this->response->setJSON(
            (new PetaModel())->getKategori()
        );
    }

    public function get_reviews($toko_id)
    {
        return $this->response->setJSON(
            (new PetaModel())->getUlasanByToko($toko_id)
        );
    }

    public function submit_review()
    {
        $json = $this->request->getJSON();

        $status = (new PetaModel())->insertUlasan([
            'toko_id' => $json->toko_id,
            'nama_pengunjung' => $json->nama,
            'rating' => $json->rating,
            'komentar' => $json->komentar
        ]);

        return $this->response->setJSON([
            'status' => $status ? 'success' : 'error'
        ]);
    }

    public function kotaSukabumi()
    {
        $path = FCPATH . 'geojson/Kota_Sukabumi.geojson';

        if (!file_exists($path)) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'File GeoJSON tidak ditemukan']);
        }

        return $this->response
            ->setHeader('Content-Type', 'application/json')
            ->setBody(file_get_contents($path));
    }

    public function jarjit()
    {
        $path = FCPATH . 'assets/audio/jarjit.mpeg';

        if (!file_exists($path)) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'File audio tidak ditemukan']);
        }

        return $this->response
            ->setHeader('Content-Type', 'audio/mpeg')
            ->setBody(file_get_contents($path));
    }

    // ================= AI GEMINI (FIX FINAL) =================
    public function ai_chat()
    {
        $input = $this->request->getJSON(true);

        if (!$input || empty($input['query'])) {
            return $this->response->setStatusCode(400)
                ->setJSON(['error' => 'Query kosong']);
        }

        $apiKey = getenv('GEMINI_API_KEY');
        if (!$apiKey) {
            return $this->response->setStatusCode(500)
                ->setJSON(['error' => 'API key Gemini tidak ditemukan']);
        }

        $client = Services::curlrequest();

        try {
            $response = $client->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent',
                [
                    // 🔴 INI YANG SEBELUMNYA KURANG
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'query' => [
                        'key' => $apiKey
                    ],
                    'json' => [
                        'contents' => [[
                            'parts' => [[
                                'text' =>
                                    "Konteks data toko:\n" . ($input['context'] ?? '') .
                                    "\n\nPertanyaan user:\n" . $input['query']
                            ]]
                        ]]
                    ],
                    'timeout' => 30
                ]
            );

            return $this->response
                ->setHeader('Content-Type', 'application/json')
                ->setBody($response->getBody());

            } catch (\Throwable $e) {
                return $this->response->setStatusCode(500)->setJSON([
                    'error' => 'Gemini API Error',
                    'detail' => $e->getMessage()
                ]);
            }
    }
}
