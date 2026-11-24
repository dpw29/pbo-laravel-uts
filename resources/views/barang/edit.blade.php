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

        {{-- Menggunakan komponen form bersama --}}
        @include('barang._form', ['barang' => $barang])

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
