@extends('layouts.app')

@section('title', 'Daftar Buku - Portal Pustaka')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Katalog Koleksi Buku</h1>
        <p class="page-subtitle">Daftar pustaka digital bahan ajar dan literatur umum mahasiswa.</p>
    </div>
    <div>
        <a href="{{ route('buku.kategori') }}" class="btn btn-secondary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            Jelajahi Kategori
        </a>
    </div>
</div>

<div class="books-grid">
    @foreach ($daftarBuku as $buku)
        @php
            $isTech = in_array(strtolower($buku['judul']), ['belajar php', 'dasar laravel']);
        @endphp
        <div class="book-card">
            <div>
                <div class="book-card-top">
                    <div class="book-icon-box {{ $isTech ? '' : 'novel' }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <span class="book-id-badge">ID: #0{{ $buku['id'] }}</span>
                </div>

                <h3 class="book-title">{{ $buku['judul'] }}</h3>
                <div class="book-meta">
                    @if ($isTech)
                        <span class="badge-status badge-baik" style="font-size: 0.75rem; padding: 2px 8px;">
                            Pemrograman
                        </span>
                    @else
                        <span class="badge-status badge-rusak-ringan" style="font-size: 0.75rem; padding: 2px 8px;">
                            Novel & Sastra
                        </span>
                    @endif
                </div>
            </div>

            <div class="book-footer">
                <span style="font-size: 0.85rem; color: var(--slate-400);">Tersedia di Rak</span>
                <a href="{{ route('buku.show', $buku['id']) }}" class="btn btn-info btn-sm">
                    Detail Buku
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
