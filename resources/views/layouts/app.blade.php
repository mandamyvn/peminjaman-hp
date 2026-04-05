<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
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

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="content">
                <div class="container-fluid">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">Peminjaman Alat</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>

  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- AdminLTE Custom File Input -->
<script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

@stack('scripts')

</body>
</html>