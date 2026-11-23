<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Inventaris') - SIM Aset Kampus</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    {{-- Header & Navigasi Utama --}}
    <header class="topbar">
        <div class="container-wide topbar-inner">
            <a href="{{ route('barang.index') }}" class="brand">
                <div class="brand-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <span>SIM-Inventaris</span>
                <span class="brand-badge">UTS PBO</span>
            </a>

            <nav>
                <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.index') || request()->routeIs('example.index') ? 'active' : '' }}">
                    Daftar Inventaris
                </a>
                <a href="{{ route('barang.create') }}" class="{{ request()->routeIs('barang.create') || request()->routeIs('example.create') ? 'active' : '' }}">
                    + Tambah Barang
                </a>
                <a href="{{ route('buku.index') }}" class="{{ request()->routeIs('buku.*') ? 'active' : '' }}">
                    Portal Buku
                </a>
            </nav>
        </div>
    </header>

    {{-- Konten Utama --}}
    <main class="container-wide">
        {{-- Flash Notification Status --}}
        @if (session('success'))
            <div class="alert alert-success">
                <div class="alert-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div>
                    <strong>Operasi Berhasil:</strong> {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <div class="alert-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <div>
                    <strong>Perhatian:</strong> {{ session('error') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <div class="alert-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <div>
                    <strong>Terdapat kesalahan pengisian formulir:</strong>
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container-wide" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div>
                <strong>SIM-Inventaris</strong> &middot; UTS Pemrograman Berbasis Objek (PBO) Teknik Informatika
            </div>
            <div>
                <span style="font-family: monospace; font-size: 0.85rem; background: var(--slate-100); padding: 2px 6px; border-radius: 4px;">© 2026 Damar Pasha Wijaya. All rights reserved.</span>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
