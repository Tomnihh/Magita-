@php $role = Auth::user()->role; @endphp

@if($role === 'ADMIN_INSPEKTORAT')
    <div class="text-white-50 text-uppercase small px-1 mb-1" style="font-size:.7rem;letter-spacing:.08em">Menu Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>
    <a href="{{ route('admin.master-desa.index') }}" class="nav-link {{ request()->routeIs('admin.master-desa.*') ? 'active' : '' }}">
        <i class="bi bi-map me-2"></i> Master Desa
    </a>
    <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
        <i class="bi bi-flag me-2"></i> Laporan Warga
        @php $laporanBaru = \App\Models\Pelaporan::where('status','BARU')->count(); @endphp
        @if($laporanBaru > 0)
            <span class="badge bg-danger ms-1">{{ $laporanBaru }}</span>
        @endif
    </a>

    <div class="text-white-50 text-uppercase small px-1 mb-1 mt-3" style="font-size:.7rem;letter-spacing:.08em">Administrasi</div>
    <a href="{{ route('admin.verifikasi.index') }}" class="nav-link {{ request()->routeIs('admin.verifikasi.*') ? 'active' : '' }}">
        <i class="bi bi-person-check me-2"></i> Verifikasi Akun
        @php $pending = \App\Models\User::where('status_akun','PENDING')->count(); @endphp
        @if($pending > 0)
            <span class="badge bg-warning text-dark ms-1">{{ $pending }}</span>
        @endif
    </a>
    <a href="{{ route('admin.audit-trail.index') }}" class="nav-link {{ request()->routeIs('admin.audit-trail.*') ? 'active' : '' }}">
        <i class="bi bi-journal-text me-2"></i> Audit Trail
    </a>

@elseif($role === 'WARGA')
    <a href="{{ route('warga.dashboard') }}" class="nav-link {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house me-2"></i> Dashboard
    </a>
    <a href="{{ route('warga.laporan.create') }}" class="nav-link {{ request()->routeIs('warga.laporan.create') ? 'active' : '' }}">
        <i class="bi bi-megaphone me-2"></i> Buat Laporan
    </a>
@endif
