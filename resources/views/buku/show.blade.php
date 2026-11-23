@extends('layouts.app')

@section('title', 'Detail Buku #' . $id)

@section('content')
<div style="max-width: 680px; margin: 0 auto 20px;">
    <a href="{{ route('buku.index') }}" class="back-link">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali ke Katalog Buku
    </a>
</div>

<div class="detail-card" style="max-width: 680px;">
    <div class="detail-header">
        <div>
            <span class="book-id-badge" style="font-size: 0.9rem; padding: 4px 10px;">ID PUSTAKA #0{{ $id }}</span>
            <h1 class="page-title" style="margin-top: 10px; font-size: 1.5rem;">Informasi Pustaka Digital</h1>
            <p class="page-subtitle">Rincian parameter identitas buku pada Controller.</p>
        </div>
        <div class="book-icon-box" style="width: 56px; height: 56px;">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
        </div>
    </div>

    <div class="detail-body">
        <div class="detail-grid" style="grid-template-columns: 1fr;">
            <div class="detail-item detail-full">
                <div class="detail-label">Nilai Parameter ID Buku</div>
                <div class="detail-value" style="font-size: 2rem; color: var(--primary); font-family: monospace;">
                    {{ $id }}
                </div>
                <p style="margin: 8px 0 0; font-size: 0.88rem; color: var(--slate-500);">
                    Data ini diterima langsung melalui URL parameter dinamis <code style="background: var(--slate-200); padding: 2px 6px; border-radius: 4px;">/buku/{id}</code> dan dirender oleh method <code style="background: var(--slate-200); padding: 2px 6px; border-radius: 4px;">BukuController@show</code>.
                </p>
            </div>
        </div>

        <div class="form-actions" style="margin-top: 28px;">
            <a href="{{ route('buku.index') }}" class="btn btn-primary">
                Lihat Semua Koleksi Buku
            </a>
            <a href="{{ route('buku.kategori') }}" class="btn btn-secondary">
                Lihat Kategori
            </a>
        </div>
    </div>
</div>
@endsection
