@extends('layouts.app')

@section('title', 'Daftar Inventaris Barang')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Daftar Inventaris Sarana & Prasarana</h1>
        <p class="page-subtitle">Sistem Pengelolaan Aset Laboratorium Komputer dan Ruang Kampus.</p>
    </div>
    <div>
        <a href="{{ route('barang.create') }}" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Barang Baru
        </a>
    </div>
</div>

@php
    $totalJenis = count($items);
    $totalUnit = 0;
    $totalBaik = 0;
    $totalRusak = 0;

    foreach ($items as $item) {
        $totalUnit += (int) $item['jumlah'];
        if ($item['kondisi'] === 'Baik') {
            $totalBaik++;
        } else {
            $totalRusak++;
        }
    }
@endphp

{{-- Metric Stat Cards --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon stat-icon-blue">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Jenis Aset</div>
            <div class="stat-value">{{ $totalJenis }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-green">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Total Unit Fisik</div>
            <div class="stat-value">{{ $totalUnit }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-amber">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Kondisi Baik</div>
            <div class="stat-value">{{ $totalBaik }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon stat-icon-rose">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>
        <div class="stat-info">
            <div class="stat-label">Perlu Servis</div>
            <div class="stat-value">{{ $totalRusak }}</div>
        </div>
    </div>
</div>

{{-- Content Table Card --}}
<div class="content-card">
    {{-- Search & Filter Bar --}}
    <div class="filter-bar">
        <div class="search-input-wrapper">
            <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="searchInput" class="search-input" placeholder="Cari kode atau nama barang...">
        </div>
        <div>
            <select id="categoryFilter" class="filter-select">
                <option value="">Semua Kategori</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Furniture">Furniture</option>
                <option value="Perangkat Jaringan">Perangkat Jaringan</option>
                <option value="Alat Tulis Kantor">Alat Tulis Kantor</option>
                <option value="Peralatan Multimedia">Peralatan Multimedia</option>
            </select>
        </div>
    </div>

    @if (empty($items) || count($items) === 0)
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
            </div>
            <h3>Belum Ada Data Inventaris</h3>
            <p>Data barang di session masih kosong. Silakan tambahkan barang pertama Anda.</p>
            <a href="{{ route('barang.create') }}" class="btn btn-primary">Tambah Barang Pertama</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table" id="inventoryTable">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th style="width: 120px;">Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th style="text-align: center; width: 90px;">Jumlah</th>
                        <th style="width: 140px;">Kondisi</th>
                        <th style="text-align: right; width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr class="item-row" data-kategori="{{ $item['kategori'] }}">
                            <td style="text-align: center; color: var(--slate-400); font-weight: 600;">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <span class="code-badge">{{ $item['kode'] }}</span>
                            </td>
                            <td>
                                <span class="item-name">{{ $item['nama'] }}</span>
                                @if(!empty($item['deskripsi']) && $item['deskripsi'] !== '-')
                                    <span class="item-desc-preview">{{ Str::limit($item['deskripsi'], 40) }}</span>
                                @endif
                            </td>
                            <td>{{ $item['kategori'] }}</td>
                            <td>{{ $item['lokasi'] }}</td>
                            <td style="text-align: center; font-weight: 700; color: var(--slate-900);">
                                {{ $item['jumlah'] }}
                            </td>
                            <td>
                                @if ($item['kondisi'] === 'Baik')
                                    <span class="badge-status badge-baik">
                                        <span class="status-dot"></span> Baik
                                    </span>
                                @elseif ($item['kondisi'] === 'Rusak Ringan')
                                    <span class="badge-status badge-rusak-ringan">
                                        <span class="status-dot"></span> Rusak Ringan
                                    </span>
                                @else
                                    <span class="badge-status badge-rusak-berat">
                                        <span class="status-dot"></span> Rusak Berat
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('barang.show', $item['kode']) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        Detail
                                    </a>

                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('barang.edit', $item['kode']) }}" class="btn btn-warning btn-sm" title="Ubah Data">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </a>

                                    {{-- Form Hapus dengan Konfirmasi --}}
                                    <form action="{{ route('barang.destroy', $item['kode']) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang [{{ $item['kode'] }}] - {{ $item['nama'] }}?');"
                                          style="display: inline-block; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Barang">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Fitur Live Search & Filter Instan di Sisi Klien
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const rows = document.querySelectorAll('.item-row');

    function filterTable() {
        const query = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value.toLowerCase();

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            const category = (row.getAttribute('data-kategori') || '').toLowerCase();

            const matchSearch = text.includes(query);
            const matchCategory = !selectedCategory || category === selectedCategory;

            if (matchSearch && matchCategory) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterTable);
    }
    if (categoryFilter) {
        categoryFilter.addEventListener('change', filterTable);
    }
</script>
@endsection
