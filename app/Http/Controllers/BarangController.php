<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Data awal default untuk inisialisasi session jika masih kosong.
     */
    protected function getInitialData(): array
    {
        return [
            [
                'kode' => 'BRG-001',
                'nama' => 'Laptop ASUS ROG Zephyrus',
                'kategori' => 'Elektronik',
                'lokasi' => 'Lab Komputer 1',
                'jumlah' => 12,
                'kondisi' => 'Baik',
                'deskripsi' => 'Laptop spesifikasi tinggi untuk praktikum grafika dan komputasi lanjut.',
            ],
            [
                'kode' => 'BRG-002',
                'nama' => 'Proyektor Epson EB-X500',
                'kategori' => 'Elektronik',
                'lokasi' => 'Ruang Teori 302',
                'jumlah' => 3,
                'kondisi' => 'Baik',
                'deskripsi' => 'Proyektor 3600 lumens untuk presentasi perkuliahan.',
            ],
            [
                'kode' => 'BRG-003',
                'nama' => 'Kursi Kerja Ergonomis',
                'kategori' => 'Furniture',
                'lokasi' => 'Ruang Dosen TI',
                'jumlah' => 25,
                'kondisi' => 'Baik',
                'deskripsi' => 'Kursi hidrolik dengan sandaran jaring mesh fleksibel.',
            ],
            [
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
     * Mengambil daftar barang dari session.
     */
    protected function getItemsFromSession(): array
    {
        if (!session()->has('data_barang')) {
            session()->put('data_barang', $this->getInitialData());
        }
        return session()->get('data_barang', []);
    }

    /**
     * Menyimpan kembali daftar barang ke session.
     */
    protected function saveItemsToSession(array $items): void
    {
        session()->put('data_barang', array_values($items));
    }

    /**
     * Menampilkan daftar semua barang.
     */
    public function index()
    {
        $items = $this->getItemsFromSession();
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
        $validated = $request->validate([
            'kode' => 'required|string|max:50',
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'lokasi' => 'required|string|max:150',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat',
            'deskripsi' => 'nullable|string',
        ], [
            'kode.required' => 'Kode barang wajib diisi.',
            'nama.required' => 'Nama barang wajib diisi.',
            'kategori.required' => 'Kategori barang wajib dipilih.',
            'lokasi.required' => 'Lokasi penempatan barang wajib diisi.',
            'jumlah.required' => 'Jumlah barang wajib diisi angka minimal 1.',
            'kondisi.required' => 'Kondisi barang wajib dipilih.',
        ]);

        $items = $this->getItemsFromSession();

        // Validasi keunikan kode barang di session
        foreach ($items as $item) {
            if (strtoupper($item['kode']) === strtoupper($validated['kode'])) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['kode' => "Barang dengan kode {$validated['kode']} sudah terdaftar!"]);
            }
        }

        $items[] = [
            'kode' => strtoupper(trim($validated['kode'])),
            'nama' => trim($validated['nama']),
            'kategori' => $validated['kategori'],
            'lokasi' => trim($validated['lokasi']),
            'jumlah' => (int) $validated['jumlah'],
            'kondisi' => $validated['kondisi'],
            'deskripsi' => trim($validated['deskripsi'] ?? '-'),
        ];

        $this->saveItemsToSession($items);

        return redirect()->route('barang.index')
            ->with('success', "Barang [{$validated['kode']}] berhasil ditambahkan!");
    }

    /**
     * Menampilkan detail satu barang berdasarkan kode.
     */
    public function show(string $kode)
    {
        $items = $this->getItemsFromSession();
        $barang = null;

        foreach ($items as $item) {
            if (strtoupper($item['kode']) === strtoupper($kode)) {
                $barang = $item;
                break;
            }
        }

        if (!$barang) {
            return redirect()->route('barang.index')
                ->with('error', "Data barang dengan kode '{$kode}' tidak ditemukan.");
        }

        return view('barang.show', compact('barang'));
    }

    /**
     * Menampilkan form edit data barang berdasarkan kode.
     */
    public function edit(string $kode)
    {
        $items = $this->getItemsFromSession();
        $barang = null;

        foreach ($items as $item) {
            if (strtoupper($item['kode']) === strtoupper($kode)) {
                $barang = $item;
                break;
            }
        }

        if (!$barang) {
            return redirect()->route('barang.index')
                ->with('error', "Data barang dengan kode '{$kode}' tidak ditemukan untuk disunting.");
        }

        return view('barang.edit', compact('barang'));
    }

    /**
     * Memperbarui data barang pada session berdasarkan kode.
     */
    public function update(Request $request, string $kode)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'lokasi' => 'required|string|max:150',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string|in:Baik,Rusak Ringan,Rusak Berat',
            'deskripsi' => 'nullable|string',
        ], [
            'nama.required' => 'Nama barang wajib diisi.',
            'kategori.required' => 'Kategori barang wajib dipilih.',
            'lokasi.required' => 'Lokasi penempatan barang wajib diisi.',
            'jumlah.required' => 'Jumlah barang wajib diisi angka minimal 1.',
            'kondisi.required' => 'Kondisi barang wajib dipilih.',
        ]);

        $items = $this->getItemsFromSession();
        $found = false;

        foreach ($items as $index => $item) {
            if (strtoupper($item['kode']) === strtoupper($kode)) {
                $items[$index]['nama'] = trim($validated['nama']);
                $items[$index]['kategori'] = $validated['kategori'];
                $items[$index]['lokasi'] = trim($validated['lokasi']);
                $items[$index]['jumlah'] = (int) $validated['jumlah'];
                $items[$index]['kondisi'] = $validated['kondisi'];
                $items[$index]['deskripsi'] = trim($validated['deskripsi'] ?? '-');
                $found = true;
                break;
            }
        }

        if (!$found) {
            return redirect()->route('barang.index')
                ->with('error', "Data barang dengan kode '{$kode}' tidak ditemukan.");
        }

        $this->saveItemsToSession($items);

        return redirect()->route('barang.index')
            ->with('success', "Data barang [{$kode}] berhasil diperbarui!");
    }

    /**
     * Menghapus barang dari session berdasarkan kode.
     */
    public function destroy(string $kode)
    {
        $items = $this->getItemsFromSession();
        $filtered = [];
        $found = false;

        foreach ($items as $item) {
            if (strtoupper($item['kode']) === strtoupper($kode)) {
                $found = true;
                continue; // dilewati untuk dihapus
            }
            $filtered[] = $item;
        }

        if (!$found) {
            return redirect()->route('barang.index')
                ->with('error', "Gagal menghapus: data barang dengan kode '{$kode}' tidak ditemukan.");
        }

        $this->saveItemsToSession($filtered);

        return redirect()->route('barang.index')
            ->with('success', "Barang dengan kode [{$kode}] berhasil dihapus dari sistem!");
    }
}
