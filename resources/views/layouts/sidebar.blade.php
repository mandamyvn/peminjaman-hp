<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%) !important;">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link" style="border-bottom-color: rgba(0,0,0,0.1) !important;">
        <i class="fas fa-tools brand-image img-circle elevation-3" style="background-color: #fff; color: #FDB931;"></i>
        <span class="brand-text font-weight-light" style="color: #000000 !important;">Peminjaman HP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(Auth::user()->isAdmin())
                <!-- Menu Admin -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-users" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Manajemen User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-list" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.alat.index') }}" class="nav-link {{ request()->routeIs('admin.alat.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-laptop" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Alat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.peminjaman.index') }}" class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-handshake" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Peminjaman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pengembalian.index') }}" class="nav-link {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-undo" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Pengembalian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.log-aktifitas.index') }}" class="nav-link {{ request()->routeIs('admin.log-aktifitas.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-history" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Log Aktifitas</p>
                    </a>
                </li>

                @elseif(Auth::user()->isPetugas())
                <!-- Menu Petugas -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('petugas.peminjaman.index') }}" class="nav-link {{ request()->routeIs('petugas.peminjaman.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-handshake" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Peminjaman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('petugas.pengembalian.index') }}" class="nav-link {{ request()->routeIs('petugas.pengembalian.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-undo" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Pengembalian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('petugas.laporan.index') }}" class="nav-link {{ request()->routeIs('petugas.laporan.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-print" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Laporan</p>
                    </a>
                </li>

                @else
                <!-- Menu Peminjam -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peminjam.alat.index') }}" class="nav-link {{ request()->routeIs('peminjam.alat.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-laptop" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Daftar Alat</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peminjam.peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjam.peminjaman.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-handshake" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Peminjaman Saya</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peminjam.pengembalian.index') }}" class="nav-link {{ request()->routeIs('peminjam.pengembalian.*') ? 'active' : '' }}" style="color: #000000 !important;">
                        <i class="nav-icon fas fa-undo" style="color: #000000 !important;"></i>
                        <p style="color: #000000 !important;">Pengembalian</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>

<style>
/* Style untuk menu aktif */
.nav-sidebar .nav-link.active {
    background-color: rgba(255, 255, 255, 0.3) !important;
    color: #000000 !important;
}

.nav-sidebar .nav-link.active i {
    color: #000000 !important;
}

/* Hover effect */
.nav-sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.2) !important;
}

/* Style untuk submenu jika ada */
.nav-treeview {
    background-color: rgba(0, 0, 0, 0.05) !important;
}
</style>