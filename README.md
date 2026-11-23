# Sistem Informasi Manajemen Inventaris Barang (SIM-Inventaris)
### Ujian Tengah Semester (UTS) Pemrograman Berbasis Objek (PBO)

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Storage](https://img.shields.io/badge/Storage-Session%20File-0ea5e9?style=for-the-badge)](https://laravel.com/docs/session)
[![Architecture](https://img.shields.io/badge/Pattern-Route%20--%3E%20Controller%20--%3E%20Blade-10b981?style=for-the-badge)]()

Proyek aplikasi web manajemen inventaris sarana dan prasarana laboratorium kampus yang dibangun menggunakan framework **Laravel 13** dan **PHP 8.3**. Aplikasi ini mengimplementasikan pola arsitektur **Route &rarr; Controller &rarr; Blade** secara murni dengan media penyimpanan sementara berbasis **Session File Storage** (`SESSION_DRIVER=file`) tanpa ketergantungan pada database SQL.

---

## 📌 Identitas Mahasiswa

* **Mata Kuliah:** Pemrograman Berbasis Objek (PBO)
* **Program Studi:** S1 Teknik Informatika
* **Topik Ujian:** Pola Arsitektur MVC (Route, Controller, Blade) & Session Persistence
* **Studi Kasus:** Pengelolaan Aset Inventaris Sarana & Prasarana Kampus

---

## 🌟 Fitur Utama Aplikasi

1. **Pengelolaan CRUD Lengkap (Berbasis Session):**
   * **Create:** Formulir penambahan barang dengan validasi kode unik, jumlah angka positif, dan kelengkapan field.
   * **Read (Index & Show):** Tabel data inventaris lengkap serta tampilan detail informasi spesifikasi aset.
   * **Update:** Pengubahan data aset lama dengan mempertahankan nilai awal (*prefilled* menggunakan `old()`).
   * **Delete:** Penghapusan data aset dari session yang diamankan dengan dialog konfirmasi (*confirmation prompt*).
2. **Dashboard Statistik Aset:**
   * Kartu metrik otomatis yang menghitung ragam jenis barang, total unit fisik, aset kondisi baik, dan aset perlu servis.
3. **Pencarian & Filter Interaktif (Client-Side):**
   * *Instant Live Search* untuk mencari kode/nama barang secara langsung tanpa reload halaman.
   * *Category Filter* dropdown (Elektronik, Furniture, Perangkat Jaringan, dll).
4. **Keamanan & Validasi Ketat:**
   * Proteksi formulir terhadap serangan CSRF menggunakan direktif `@csrf`.
   * *Method Spoofing* menggunakan `@method('PUT')` dan `@method('DELETE')`.
   * Flash alert notifikasi (*success* & *error*) serta penanganan elegan bila kode barang tidak ditemukan.
5. **Koleksi Pustaka (Arsip Praktikum):**
   * Tersedia pula modul katalog buku (`/buku`) sebagai dokumentasi praktikum pertemuan sebelumnya.

---

## 🚀 Panduan Instalasi & Menjalankan Proyek

Pastikan perangkat Anda telah terpasang **PHP >= 8.2** dan **Composer**.

### 1. Clone Repositori
```bash
git clone https://github.com/dpw29/pbo-laravel-uts.git
cd pbo-laravel-uts
```

### 2. Pasang Dependensi Vendor
```bash
composer install
```

### 3. Konfigurasi Berkas Environment
Salin berkas `.env.example` menjadi `.env`, lalu buat *application key*:
```bash
cp .env.example .env
php artisan key:generate
```

> **Penting:** Pastikan konfigurasi driver session di berkas `.env` menggunakan mode file:
> ```env
> SESSION_DRIVER=file
> ```

### 4. Jalankan Server Pengembangan
```bash
php artisan serve
```

Aplikasi dapat langsung diakses melalui peramban pada alamat:
* **Inventaris Barang (Studi Kasus):** [`http://127.0.0.1:8000/barang`](http://127.0.0.1:8000/barang)
* **Rute Alias Soal:** [`http://127.0.0.1:8000/example`](http://127.0.0.1:8000/example)
* **Portal Buku:** [`http://127.0.0.1:8000/buku`](http://127.0.0.1:8000/buku)

---

## 📋 Pemetaan Rute Sistem (`php artisan route:list`)

Seluruh rute telah didaftarkan pada `routes/web.php` dan terikat dengan method pada `BarangController` (dan `ExampleController`):

| No | HTTP Method | URI | Nama Route | Aksi Controller | Deskripsi Fungsi |
|:--:|:-----------:|:----|:-----------|:----------------|:-----------------|
| 1 | **GET** | `/barang` | `barang.index` | `BarangController@index` | Menampilkan tabel daftar inventaris dari session |
| 2 | **GET** | `/barang/create` | `barang.create` | `BarangController@create` | Menampilkan form tambah inventaris baru |
| 3 | **POST** | `/barang` | `barang.store` | `BarangController@store` | Menyimpan data barang baru ke session |
| 4 | **GET** | `/barang/{kode}` | `barang.show` | `BarangController@show` | Menampilkan rincian lengkap satu barang |
| 5 | **GET** | `/barang/{kode}/edit` | `barang.edit` | `BarangController@edit` | Menampilkan form edit data barang terpilih |
| 6 | **PUT/PATCH** | `/barang/{kode}` | `barang.update` | `BarangController@update` | Memperbarui data barang pada session |
| 7 | **DELETE** | `/barang/{kode}` | `barang.destroy` | `BarangController@destroy` | Menghapus data barang dari session |

> **Catatan Teknis (Route Precedence):**  
> URI statis `/barang/create` sengaja didefinisikan **sebelum** URI parameter dinamis `/barang/{kode}`. Hal ini mencegah mekanisme pencocokan URL Laravel mengira kata `"create"` sebagai nilai dari parameter `{kode}`.

---

## 📂 Struktur Berkas Utama Proyek

```text
pbo-laravel-uts/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── BarangController.php   # Logika bisnis CRUD & manipulasi session
│           ├── ExampleController.php  # Controller alias sesuai spesifikasi soal
│           └── BukuController.php     # Controller arsip praktikum buku
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php          # Kerangka layout utama & wadah flash alert
│       ├── barang/
│       │   ├── index.blade.php        # Tampilan daftar inventaris & kartu statistik
│       │   ├── create.blade.php       # Formulir input barang baru (@csrf)
│       │   ├── edit.blade.php         # Formulir edit (@method('PUT') & old())
│       │   └── show.blade.php         # Kartu informasi rincian aset
│       └── buku/                      # Tampilan modul pustaka buku
├── routes/
│   └── web.php                        # Definisi rute web & named routes
├── public/
│   └── css/
│       └── style.css                  # Desain antarmuka modern & responsif
└── UTS_PBO_NIM_Nama.docx              # Berkas laporan praktikum UTS lengkap
```

---

## 🧪 Skenario Pengujian Fungsionalitas

1. **Uji Tambah Barang:** Buka menu `+ Tambah Barang`, isi field formulir lalu simpan. Perhatikan notifikasi sukses dan kembalinya data ke tabel utama.
2. **Uji Validasi Duplikasi:** Coba tambahkan barang dengan kode yang sudah ada (misal `BRG-001`). Sistem akan menolak dan memberi peringatan bahwa kode sudah terdaftar.
3. **Uji Edit Data:** Klik tombol *Edit* pada baris data, lakukan perubahan jumlah atau kondisi, lalu simpan. Nilai terbaru akan langsung tersimpan di session.
4. **Uji Keamanan Hapus:** Klik tombol *Hapus*. Browser akan memunculkan dialog konfirmasi sebelum data benar-benar dihapus.
5. **Uji URL Tidak Ditemukan:** Akses rute `/barang/KODE-SALAH`. Sistem akan otomatis mengarahkan kembali ke halaman utama dengan pesan error yang informatif.

---

## 📄 Lisensi & Hak Cipta
Dikembangkan untuk keperluan **Ujian Tengah Semester (UTS) Pemrograman Berbasis Objek**, Program Studi Teknik Informatika.
