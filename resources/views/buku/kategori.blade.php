@extends('layouts.app')

@section('title', 'Kategori Buku')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Kategori Buku: {{ $nama ? ucfirst($nama) : 'Semua Koleksi' }}</h1>
        <p class="page-subtitle">Saring buku berdasarkan genre literatur dan topik perkuliahan.</p>
    </div>
    <div>
        <a href="{{ route('buku.index') }}" class="btn btn-secondary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Daftar Buku
        </a>
    </div>
</div>

{{-- Category Filter Chips --}}
<div class="chips">
    <a class="chip {{ $nama === null ? 'active' : '' }}" href="{{ route('buku.kategori') }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
            <polyline points="2 17 12 22 22 17"></polyline>
            <polyline points="2 12 12 17 22 12"></polyline>
        </svg>
        Semua Kategori
    </a>
    <a class="chip {{ strtolower($nama ?? '') === 'pemrograman' ? 'active' : '' }}" href="{{ route('buku.kategori', 'pemrograman') }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="16 18 22 12 16 6"></polyline>
            <polyline points="8 6 2 12 8 18"></polyline>
        </svg>
        Pemrograman
    </a>
    <a class="chip {{ strtolower($nama ?? '') === 'novel' ? 'active' : '' }}" href="{{ route('buku.kategori', 'novel') }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
        </svg>
        Novel & Sastra
    </a>
</div>

@if (count($daftarBuku) === 0)
    <div class="empty-state">
        <div class="empty-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
        </div>
        <h3>Tidak Ditemukan Buku</h3>
        <p>Belum ada koleksi buku yang tersedia untuk kategori "{{ $nama }}".</p>
        <a href="{{ route('buku.kategori') }}" class="btn btn-secondary">Tampilkan Semua Buku</a>
    </div>
@else
    <div style="margin-bottom: 16px; font-size: 0.9rem; color: var(--slate-500); font-weight: 500;">
        Menampilkan <strong>{{ count($daftarBuku) }}</strong> buku dalam kategori ini:
    </div>

    <div class="books-grid">
        @foreach ($daftarBuku as $buku)
            @php
                $isTech = strtolower($buku['kategori']) === 'pemrograman';
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
                        <span class="badge-status {{ $isTech ? 'badge-baik' : 'badge-rusak-ringan' }}" style="font-size: 0.75rem;">
                            {{ ucfirst($buku['kategori']) }}
                        </span>
                    </div>

                    <h3 class="book-title">{{ $buku['judul'] }}</h3>
                    <p class="book-meta">Kategori resmi: {{ ucfirst($buku['kategori']) }}</p>
                </div>

                <div class="book-footer">
                    <span style="font-size: 0.85rem; color: var(--slate-400);">Status: Tersedia</span>
                    <span class="badge-status badge-baik" style="padding: 2px 8px;">Siap Pinjam</span>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
