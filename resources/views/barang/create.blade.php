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

        {{-- Menggunakan komponen form bersama --}}
        @include('barang._form')

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
