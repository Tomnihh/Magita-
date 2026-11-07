<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MAGITA') — Inspektorat Kabupaten Sumbawa</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <style>
        :root {
            --mg-primary: #1a3a5c;
            --mg-secondary: #2e7d32;
            --mg-accent: #f57c00;
        }
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--mg-primary) 0%, #1e4976 100%);
            width: 260px;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
            padding: .6rem 1rem;
            border-radius: .375rem;
            margin: 2px 8px;
            transition: all .2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255,255,255,.15);
        }
        .sidebar .nav-link .bi { width: 1.25rem; }
        .sidebar-brand {
            padding: 1.2rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .main-content {
            margin-left: 260px;
            padding: 1.5rem;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: .75rem 1.5rem;
            margin-left: 260px;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .card {
            border: none;
            box-shadow: 0 .125rem .5rem rgba(0,0,0,.08);
            border-radius: .5rem;
        }
        .stat-card { border-left: 4px solid; }
        .stat-card.merah  { border-left-color: #dc3545; }
        .stat-card.kuning { border-left-color: #ffc107; }
        .stat-card.hijau  { border-left-color: #198754; }
        .stat-card.biru   { border-left-color: #0d6efd; }
        .badge-risiko-HIJAU  { background-color: #198754; color: #fff; }
        .badge-risiko-KUNING { background-color: #ffc107; color: #000; }
        .badge-risiko-MERAH  { background-color: #dc3545; color: #fff; }
        #peta-sumbawa { height: 480px; border-radius: .5rem; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content, .topbar { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column" id="sidebar">
        <div class="sidebar-brand text-center">
            <div class="text-white fw-bold fs-5">
                <i class="bi bi-shield-check me-2" style="color:var(--mg-accent)"></i>MAGITA
            </div>
            <div class="text-white-50 small">Inspektorat Kab. Sumbawa</div>
        </div>

        <div class="px-2 pt-3 flex-grow-1">
            @auth
                @include('layouts.partials.sidebar-menu')
            @endauth
        </div>

        @auth
        <div class="p-3 border-top border-secondary mt-auto" style="border-color:rgba(255,255,255,.1)!important">
            <div class="d-flex align-items-center text-white-50 small mb-2">
                <i class="bi bi-person-circle me-2 fs-5"></i>
                <div>
                    <div class="text-white fw-semibold">{{ Auth::user()->nama_lengkap }}</div>
                    <div>{{ Auth::user()->role }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-1"></i> Keluar
                </button>
            </form>
        </div>
        @endauth
    </nav>

    <!-- Topbar -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div class="fw-semibold text-muted">@yield('page-title', 'Dashboard')</div>
        <div class="text-muted small">
            <i class="bi bi-calendar3 me-1"></i>
            {{ now()->locale('id')->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('scripts')
</body>
</html>
