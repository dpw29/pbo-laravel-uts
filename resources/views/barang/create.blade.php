@extends('layouts.app')

@section('title', 'Tambah Inventaris Barang')

@section('content')
<div style="max-width: 760px; margin: 0 auto 20px;">
    <a href="{{ route('barang.index') }}" class="back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali ke Daftar Inventaris
    </a>
    <h1 class="page-title">Tambah Inventaris Barang</h1>
    <p class="page-subtitle">Daftarkan aset sarana atau prasarana baru ke dalam sistem inventaris.</p>
</div>

<div class="form-card">
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        <div class="form-grid">
            {{-- Kode Barang --}}
            <div class="form-group">
                <label for="kode" class="form-label">
                    Kode Barang <span class="required">*</span>
                </label>
                <input type="text"
                       id="kode"
                       name="kode"
                       class="form-control @error('kode') is-invalid @enderror"
                       placeholder="Contoh: BRG-005"
                       value="{{ old('kode') }}"
                       required>
                @error('kode')
                    <div class="form-error">{{ $message }}</div>
                @else
                    <div class="form-help">Kode unik pengenal aset (huruf & angka).</div>
                @enderror
            </div>

            {{-- Nama Barang --}}
            <div class="form-group">
                <label for="nama" class="form-label">
                    Nama Barang <span class="required">*</span>
                </label>
                <input type="text"
                       id="nama"
                       name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       placeholder="Contoh: Monitor Dell UltraSharp 24 inch"
                       value="{{ old('nama') }}"
                       required>
                @error('nama')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="form-group">
                <label for="kategori" class="form-label">
                    Kategori <span class="required">*</span>
                </label>
                <select id="kategori" name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Elektronik" {{ old('kategori') === 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                    <option value="Furniture" {{ old('kategori') === 'Furniture' ? 'selected' : '' }}>Furniture</option>
                    <option value="Perangkat Jaringan" {{ old('kategori') === 'Perangkat Jaringan' ? 'selected' : '' }}>Perangkat Jaringan</option>
                    <option value="Alat Tulis Kantor" {{ old('kategori') === 'Alat Tulis Kantor' ? 'selected' : '' }}>Alat Tulis Kantor</option>
                    <option value="Peralatan Multimedia" {{ old('kategori') === 'Peralatan Multimedia' ? 'selected' : '' }}>Peralatan Multimedia</option>
                </select>
                @error('kategori')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Lokasi Penempatan --}}
            <div class="form-group">
                <label for="lokasi" class="form-label">
                    Lokasi Penempatan <span class="required">*</span>
                </label>
                <input type="text"
                       id="lokasi"
                       name="lokasi"
                       class="form-control @error('lokasi') is-invalid @enderror"
                       placeholder="Contoh: Lab Jaringan Komputer Lt. 2"
                       value="{{ old('lokasi') }}"
                       required>
                @error('lokasi')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jumlah Unit --}}
            <div class="form-group">
                <label for="jumlah" class="form-label">
                    Jumlah Unit Fisik <span class="required">*</span>
                </label>
                <input type="number"
                       id="jumlah"
                       name="jumlah"
                       min="1"
                       class="form-control @error('jumlah') is-invalid @enderror"
                       value="{{ old('jumlah', 1) }}"
                       required>
                @error('jumlah')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kondisi Fisik --}}
            <div class="form-group">
                <label for="kondisi" class="form-label">
                    Kondisi Fisik <span class="required">*</span>
                </label>
                <select id="kondisi" name="kondisi" class="form-control @error('kondisi') is-invalid @enderror" required>
                    <option value="Baik" {{ old('kondisi', 'Baik') === 'Baik' ? 'selected' : '' }}>Baik (Siap Pakai)</option>
                    <option value="Rusak Ringan" {{ old('kondisi') === 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan (Perlu Servis)</option>
                    <option value="Rusak Berat" {{ old('kondisi') === 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat (Afkir / Rusak Total)</option>
                </select>
                @error('kondisi')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi / Keterangan --}}
            <div class="form-group col-span-2">
                <label for="deskripsi" class="form-label">Deskripsi / Keterangan Tambahan</label>
                <textarea id="deskripsi"
                          name="deskripsi"
                          rows="3"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          placeholder="Nomor seri, spesifikasi teknis, atau riwayat pengadaan...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                Simpan Barang
            </button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
