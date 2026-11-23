@extends('layouts.app')

@section('title', 'Detail Barang: ' . $barang['kode'])

@section('content')
<div style="max-width: 820px; margin: 0 auto 20px;">
    <a href="{{ route('barang.index') }}" class="back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali ke Daftar Inventaris
    </a>
</div>

<div class="detail-card">
    <div class="detail-header">
        <div>
            <span class="code-badge" style="font-size: 0.95rem; padding: 4px 10px;">{{ $barang['kode'] }}</span>
            <h1 class="page-title" style="margin-top: 8px; font-size: 1.6rem;">{{ $barang['nama'] }}</h1>
            <p class="page-subtitle">Kategori: <strong>{{ $barang['kategori'] }}</strong></p>
        </div>
        <div>
            @if ($barang['kondisi'] === 'Baik')
                <span class="badge-status badge-baik" style="font-size: 0.95rem; padding: 6px 16px;">
                    <span class="status-dot"></span> Kondisi Baik
                </span>
            @elseif ($barang['kondisi'] === 'Rusak Ringan')
                <span class="badge-status badge-rusak-ringan" style="font-size: 0.95rem; padding: 6px 16px;">
                    <span class="status-dot"></span> Rusak Ringan
                </span>
            @else
                <span class="badge-status badge-rusak-berat" style="font-size: 0.95rem; padding: 6px 16px;">
                    <span class="status-dot"></span> Rusak Berat
                </span>
            @endif
        </div>
    </div>

    <div class="detail-body">
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Lokasi Penempatan</div>
                <div class="detail-value" style="display: flex; align-items: center; gap: 6px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--slate-400);">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    {{ $barang['lokasi'] }}
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">Jumlah Unit Fisik</div>
                <div class="detail-value" style="display: flex; align-items: center; gap: 6px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--slate-400);">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    </svg>
                    {{ $barang['jumlah'] }} Unit
                </div>
            </div>

            <div class="detail-item detail-full">
                <div class="detail-label">Deskripsi & Catatan Spesifikasi</div>
                <div class="detail-value" style="font-weight: 500; font-size: 0.96rem; line-height: 1.6; color: var(--slate-700);">
                    {{ $barang['deskripsi'] ?? 'Tidak ada catatan atau spesifikasi tambahan yang dilampirkan.' }}
                </div>
            </div>
        </div>

        <div class="form-actions" style="margin-top: 32px; justify-content: space-between;">
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('barang.edit', $barang['kode']) }}" class="btn btn-warning">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Edit Data Ini
                </a>

                <form action="{{ route('barang.destroy', $barang['kode']) }}" method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data barang [{{ $barang['kode'] }}]? Data yang dihapus tidak dapat dipulihkan.');"
                      style="display: inline-block; margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        Hapus Aset
                    </button>
                </form>
            </div>

            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
