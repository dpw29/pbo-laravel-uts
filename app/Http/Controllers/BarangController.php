<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Data awal default untuk inisialisasi session jika masih kosong.
     */
    protected function dataAwal(): array
    {
        return [
            'BRG-001' => [
                'kode' => 'BRG-001',
                'nama' => 'Laptop ASUS ROG Zephyrus',
                'kategori' => 'Elektronik',
                'lokasi' => 'Lab Komputer 1',
                'jumlah' => 12,
                'kondisi' => 'Baik',
                'deskripsi' => 'Laptop spesifikasi tinggi untuk praktikum grafika dan komputasi lanjut.',
            ],
            'BRG-002' => [
                'kode' => 'BRG-002',
                'nama' => 'Proyektor Epson EB-X500',
                'kategori' => 'Elektronik',
                'lokasi' => 'Ruang Teori 302',
                'jumlah' => 3,
                'kondisi' => 'Baik',
                'deskripsi' => 'Proyektor 3600 lumens untuk presentasi perkuliahan.',
            ],
            'BRG-003' => [
                'kode' => 'BRG-003',
                'nama' => 'Kursi Kerja Ergonomis',
                'kategori' => 'Furniture',
                'lokasi' => 'Ruang Dosen TI',
                'jumlah' => 25,
                'kondisi' => 'Baik',
                'deskripsi' => 'Kursi hidrolik dengan sandaran jaring mesh fleksibel.',
            ],
            'BRG-004' => [
                'kode' => 'BRG-004',
                'nama' => 'Switch Cisco Catalyst 24 Port',
                'kategori' => 'Perangkat Jaringan',
                'lokasi' => 'Server Room Gedung A',
                'jumlah' => 2,
                'kondisi' => 'Rusak Ringan',
                'deskripsi' => 'Port 7 dan 8 tidak menyala, menunggu jadwal perbaikan teknisi.',
            ],
        ];
    }

    /**
     * Mengambil semua data barang dari session.
     */
    protected function ambilSemua(): array
    {
        if (!session()->has('data_barang')) {
            session()->put('data_barang', $this->dataAwal());
        }
        return session()->get('data_barang', []);
    }

    /**
     * Menyimpan seluruh data barang ke session.
     */
    protected function simpanSemua(array $semua): void
    {
        session()->put('data_barang', $semua);
    }

    /**
     * Mencari satu data barang berdasarkan kode.
     */
    protected function cari(string $kode): ?array
    {
        $semua = $this->ambilSemua();
        $kode = strtoupper($kode);
        return $semua[$kode] ?? null;
    }

    /**
     * Membentuk array data barang terstruktur.
     */
    protected function susunBarang(string $kode, array $input): array
    {
        return [
            'kode' => strtoupper($kode),
            'nama' => trim($input['nama']),
            'kategori' => $input['kategori'],
            'lokasi' => trim($input['lokasi']),
            'jumlah' => (int) $input['jumlah'],
            'kondisi' => $input['kondisi'],
            'deskripsi' => trim($input['deskripsi'] ?? '-'),
        ];
    }

    /**
     * Aturan validasi form barang.
     */
    protected function aturan(bool $isEdit = false): array
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'lokasi' => 'required|string|max:150',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat',
            'deskripsi' => 'nullable|string',
        ];

        if (!$isEdit) {
            $rules['kode'] = 'required|string|max:50';
        }

        return $rules;
    }

    /**
     * Pesan kesalahan kustom untuk validasi.
     */
    protected function pesanError(): array
    {
        return [
            'kode.required' => 'Kode barang wajib diisi.',
            'nama.required' => 'Nama barang wajib diisi.',
            'kategori.required' => 'Kategori barang wajib dipilih.',
            'lokasi.required' => 'Lokasi penempatan barang wajib diisi.',
            'jumlah.required' => 'Jumlah barang wajib diisi angka minimal 1.',
            'kondisi.required' => 'Kondisi barang wajib dipilih.',
        ];
    }

    /**
     * Menampilkan daftar semua barang.
     */
    public function index()
    {
        $items = array_values($this->ambilSemua());
        return view('barang.index', compact('items'));
    }

    /**
     * Menampilkan form tambah barang baru.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Menyimpan data barang baru ke session setelah validasi.
     */
    public function store(Request $request)
    {
        $input = $request->validate($this->aturan(), $this->pesanError());

        $kode = strtoupper($input['kode']);
        $semua = $this->ambilSemua();

        if (isset($semua[$kode])) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['kode' => "Barang dengan kode {$kode} sudah terdaftar!"]);
        }

        $semua[$kode] = $this->susunBarang($kode, $input);
        $this->simpanSemua($semua);

        return redirect()->route('barang.index')
            ->with('status', 'Barang berhasil ditambahkan.')
            ->with('success', "Barang [{$kode}] berhasil ditambahkan!");
    }

    /**
     * Menampilkan detail satu barang berdasarkan kode.
     */
    public function show(string $kode)
    {
        $barang = $this->cari($kode);

        if (!$barang) {
            return redirect()->route('barang.index')
                ->with('error', 'Barang tidak ditemukan.');
        }

        return view('barang.show', compact('barang'));
    }

    /**
     * Menampilkan form edit data barang berdasarkan kode.
     */
    public function edit(string $kode)
    {
        $barang = $this->cari($kode);

        if (!$barang) {
            return redirect()->route('barang.index')
                ->with('error', 'Barang tidak ditemukan.');
        }

        return view('barang.edit', compact('barang'));
    }

    /**
     * Memperbarui data barang pada session berdasarkan kode.
     */
    public function update(Request $request, string $kode)
    {
        $input = $request->validate($this->aturan(true), $this->pesanError());
        $semua = $this->ambilSemua();
        $kode = strtoupper($kode);

        if (!isset($semua[$kode])) {
            return redirect()->route('barang.index')
                ->with('error', 'Barang tidak ditemukan.');
        }

        $semua[$kode] = $this->susunBarang($kode, $input);
        $this->simpanSemua($semua);

        return redirect()->route('barang.index')
            ->with('status', 'Data barang berhasil diperbarui.')
            ->with('success', "Data barang [{$kode}] berhasil diperbarui!");
    }

    /**
     * Menghapus barang dari session berdasarkan kode.
     */
    public function destroy(string $kode)
    {
        $semua = $this->ambilSemua();
        $kode = strtoupper($kode);

        if (!isset($semua[$kode])) {
            return redirect()->route('barang.index')
                ->with('error', 'Barang tidak ditemukan.');
        }

        unset($semua[$kode]);
        $this->simpanSemua($semua);

        return redirect()->route('barang.index')
            ->with('status', 'Barang berhasil dihapus.')
            ->with('success', "Barang dengan kode [{$kode}] berhasil dihapus!");
    }
}
