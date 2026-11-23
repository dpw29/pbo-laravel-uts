# UTS Pemrograman Berbasis Objek (PBO) - SIM Inventaris Barang

Aplikasi Web Manajemen Inventaris Barang berbasis Laravel 13 dengan pola arsitektur **Route &rarr; Controller &rarr; Blade** dan penyimpanan data sementara berbasis **Session File Storage** (tanpa ketergantungan database).

---

## Fitur Utama
1. **Routing RESTful Lengkap**: Pengelolaan rute statis dan dinamis dengan penamaan route (*named routes*).
2. **Controller Terstruktur**: Pemisahan logika CRUD pada method tersendiri di `BarangController` (dan alias `ExampleController`).
3. **Session Persistence**: Menggunakan `SESSION_DRIVER=file` untuk menyimpan array koleksi data inventaris.
4. **Validasi Input & Error Handling**: Proteksi terhadap data kosong, tipe data tidak sesuai, keunikan kode barang, serta penanganan 404/redirect saat barang tidak ditemukan.
5. **Blade Templating Responsif**: Layout konsisten (`layouts/app.blade.php`), notifikasi flash messages, dan modal konfirmasi saat penghapusan data (`onsubmit="return confirm(...)"`).

---

## Cara Menjalankan Proyek

1. **Clone repository ini:**
   ```bash
   git clone <link-repo-anda>
   cd pbo-laravel
   ```

2. **Pasang Dependensi:**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment:**
   Salin berkas `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Pastikan pada file `.env` nilai `SESSION_DRIVER=file`.*

4. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```

5. **Akses Aplikasi:**
   Buka peramban (browser) dan akses:
   - Manajemen Inventaris: `http://127.0.0.1:8000/barang` atau `http://127.0.0.1:8000/example`
   - Tambah Barang: `http://127.0.0.1:8000/barang/create`

---

## Daftar Route (php artisan route:list)

| Method | URI | Nama Route | Aksi Controller |
| :--- | :--- | :--- | :--- |
| **GET** | `/barang` | `barang.index` | `BarangController@index` |
| **GET** | `/barang/create` | `barang.create` | `BarangController@create` |
| **POST** | `/barang` | `barang.store` | `BarangController@store` |
| **GET** | `/barang/{kode}` | `barang.show` | `BarangController@show` |
| **GET** | `/barang/{kode}/edit` | `barang.edit` | `BarangController@edit` |
| **PUT/PATCH** | `/barang/{kode}` | `barang.update` | `BarangController@update` |
| **DELETE** | `/barang/{kode}` | `barang.destroy` | `BarangController@destroy` |

*(Rute alias `/example` juga disediakan untuk memenuhi pengujian otomatis).*
