<h1 align="center">🌿 Rasa Priangan</h1>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php" />
  <img src="https://img.shields.io/badge/CodeIgniter-4-EF4223?style=for-the-badge&logo=codeigniter" />
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql" />
  <img src="https://img.shields.io/badge/Leaflet-JS-199900?style=for-the-badge&logo=leaflet" />
  <img src="https://img.shields.io/badge/Status-Academic_Project-success?style=for-the-badge" />
  <img src="https://img.shields.io/badge/Hosting-InfinityFree-blue?style=for-the-badge" />
</p>

<p align="center">
  🌿 Sistem Informasi Geografis Pusat Oleh-Oleh Khas Kota Sukabumi
</p>

<p align="center">
  🔗 <strong>Live Website:</strong><br>
  <a href="https://rasa-priangan.infinityfree.me/">https://rasa-priangan.infinityfree.me/</a>
</p>

---

## 📌 Deskripsi Proyek

**Rasa Priangan** merupakan aplikasi **Sistem Informasi Geografis (SIG) berbasis web** yang dirancang untuk menyajikan informasi lokasi pusat oleh-oleh khas Kota Sukabumi secara interaktif. Sistem ini memanfaatkan peta digital untuk menampilkan titik lokasi, informasi produk, serta visualisasi wilayah, sehingga memudahkan pengguna dalam menemukan pusat oleh-oleh secara akurat dan efisien.

Aplikasi ini dikembangkan sebagai bagian dari implementasi teknologi SIG pada bidang pariwisata dan ekonomi kreatif daerah.

---

## 🎯 Tujuan Pengembangan

* Menyediakan informasi lokasi pusat oleh-oleh khas Sukabumi secara visual dan interaktif
* Membantu wisatawan dan masyarakat lokal menemukan pusat oleh-oleh terdekat
* Meningkatkan pemanfaatan teknologi SIG dalam pemetaan UMKM daerah
* Mendukung promosi produk lokal berbasis data spasial

---

## 🗺️ Fitur Utama

* 🧭 Peta interaktif berbasis Leaflet
* 📍 Penanda lokasi pusat oleh-oleh
* 🏪 Informasi detail lokasi dan produk
* 🗂️ Klasifikasi lokasi berdasarkan kategori
* 🔍 Visualisasi data spasial GeoJSON (point dan polygon)
* 🤖 Layer GeoAI sederhana (rule-based / visual layer)
* 🌐 Tampilan website responsif dan mudah digunakan

---

## 🧠 Konsep GeoAI

Sistem ini mengimplementasikan **layer GeoAI** sebagai pelengkap analisis spasial, yang digunakan untuk:

* Menunjukkan persebaran pusat oleh-oleh
* Menggambarkan kepadatan lokasi pada area tertentu
* Memberikan interpretasi wilayah berdasarkan aturan sederhana

Pendekatan GeoAI ini bertujuan untuk meningkatkan nilai analisis peta, bukan hanya sebagai media visualisasi statis.

---

## 🛠️ Teknologi yang Digunakan

* **Frontend:** HTML, CSS, JavaScript
* **Backend:** PHP (CodeIgniter 4)
* **Database:** MySQL
* **Peta Digital:** Leaflet.js
* **Format Data Spasial:** GeoJSON
* **Hosting:** InfinityFree

---

## 🧩 Gambaran Sistem

* **User Interface:** Menampilkan peta dan informasi pusat oleh-oleh
* **Controller:** Mengelola logika aplikasi dan data GeoJSON
* **Model:** Mengakses dan mengolah data dari database
* **Database:** Menyimpan data lokasi, kategori, dan atribut pendukung

---

## 🚀 Cara Menjalankan Secara Lokal

1. Clone repository proyek
2. Pindahkan folder proyek ke direktori `htdocs` (XAMPP)
3. Import database ke MySQL
4. Konfigurasikan koneksi database pada file `.env`
5. Jalankan aplikasi melalui browser dengan alamat:

   ```
   http://localhost:8080
   ```

---

## 👤 Pengembang

**Ranggis**
Mahasiswa | Pengembang Web & Sistem Informasi Geografis

---

## 📄 Lisensi

Proyek ini dikembangkan untuk keperluan **akademik dan pembelajaran**. Penggunaan dan pengembangan lanjutan diperbolehkan dengan mencantumkan sumber.
