@extends('layouts.app')

@section('title', 'Edit Barang: ' . $barang['kode'])

@section('content')
<div style="max-width: 760px; margin: 0 auto 20px;">
    <a href="{{ route('barang.index') }}" class="back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali ke Daftar Inventaris
    </a>
    <h1 class="page-title">Perbarui Data Inventaris</h1>
    <p class="page-subtitle">Sunting rincian aset dengan kode <strong class="code-badge">{{ $barang['kode'] }}</strong>.</p>
</div>

<div class="form-card">
    <form action="{{ route('barang.update', $barang['kode']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            {{-- Kode Barang (Readonly) --}}
            <div class="form-group">
                <label for="kode" class="form-label">Kode Barang</label>
                <input type="text"
                       id="kode"
                       class="form-control"
                       value="{{ $barang['kode'] }}"
                       readonly>
                <div class="form-help">Kode barang merupakan pengenal unik yang terkunci.</div>
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
                       value="{{ old('nama', $barang['nama']) }}"
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
                @php $curKat = old('kategori', $barang['kategori']); @endphp
                <select id="kategori" name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                    <option value="Elektronik" {{ $curKat === 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                    <option value="Furniture" {{ $curKat === 'Furniture' ? 'selected' : '' }}>Furniture</option>
                    <option value="Perangkat Jaringan" {{ $curKat === 'Perangkat Jaringan' ? 'selected' : '' }}>Perangkat Jaringan</option>
                    <option value="Alat Tulis Kantor" {{ $curKat === 'Alat Tulis Kantor' ? 'selected' : '' }}>Alat Tulis Kantor</option>
                    <option value="Peralatan Multimedia" {{ $curKat === 'Peralatan Multimedia' ? 'selected' : '' }}>Peralatan Multimedia</option>
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
                       value="{{ old('lokasi', $barang['lokasi']) }}"
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
                       value="{{ old('jumlah', $barang['jumlah']) }}"
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
                @php $curKondisi = old('kondisi', $barang['kondisi']); @endphp
                <select id="kondisi" name="kondisi" class="form-control @error('kondisi') is-invalid @enderror" required>
                    <option value="Baik" {{ $curKondisi === 'Baik' ? 'selected' : '' }}>Baik (Siap Pakai)</option>
                    <option value="Rusak Ringan" {{ $curKondisi === 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan (Perlu Servis)</option>
                    <option value="Rusak Berat" {{ $curKondisi === 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat (Afkir / Rusak Total)</option>
                </select>
                @error('kondisi')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="form-group col-span-2">
                <label for="deskripsi" class="form-label">Deskripsi / Keterangan Tambahan</label>
                <textarea id="deskripsi"
                          name="deskripsi"
                          rows="3"
                          class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $barang['deskripsi'] ?? '') }}</textarea>
                @error('deskripsi')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                Simpan Perubahan
            </button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
