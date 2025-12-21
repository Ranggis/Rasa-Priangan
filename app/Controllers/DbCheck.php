<?php

namespace App\Controllers;

use Config\Database;

class DbCheck extends BaseController
{
    public function index()
    {
        $db = Database::connect();
        $status = false;
        $message = "";
        $dbName = "";

        try {
            // Mencoba melakukan koneksi
            if ($db->connect()) {
                $status = true;
                $message = "Koneksi Berhasil! Database sudah terhubung dengan sempurna.";
                $dbName = $db->getDatabase(); // Mengambil nama DB dari .env
            }
        } catch (\Exception $e) {
            $status = false;
            $message = "Koneksi Gagal: " . $e->getMessage();
        }

        $data = [
            'title'   => 'Database Status | Rasa Priangan',
            'status'  => $status,
            'message' => $message,
            'dbName'  => $dbName
        ];

        return view('db_status', $data);
    }
}