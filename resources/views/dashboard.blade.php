@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    @if(Auth::user()->isAdmin())
   <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-sunset-modern border-0 shadow-lg animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-dark-50 mb-1 fw-light" style="color: rgba(0,0,0,0.7) !important;">Total Alat</p>
                        <h2 class="mb-0 text-dark fw-bold display-6">{{ $total_alat }}</h2>
                        <div class="mt-2">
                            <span class="badge bg-white text-warning-dark px-3 py-1 rounded-pill">
                                <i class="fas fa-chart-line me-1"></i> Tersedia
                            </span>
                        </div>
                    </div>
                    <div class="icon-circle-lg bg-white-30">
                        <i class="fas fa-laptop text-dark"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4">
                    <a href="{{ route('admin.alat.index') }}" class="text-dark text-decoration-none d-flex align-items-center">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <div class="text-dark-50">
                        <small>Updated: Today</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-sunset-modern border-0 shadow-lg animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-dark-50 mb-1 fw-light" style="color: rgba(0,0,0,0.7) !important;">Total Peminjam</p>
                        <h2 class="mb-0 text-dark fw-bold display-6">{{ $total_peminjam }}</h2>
                        <div class="mt-2">
                            <span class="badge bg-white text-warning-dark px-3 py-1 rounded-pill">
                                <i class="fas fa-user-check me-1"></i> Aktif
                            </span>
                        </div>
                    </div>
                    <div class="icon-circle-lg bg-white-30">
                        <i class="fas fa-users text-dark"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4">
                    <a href="{{ route('admin.users.index') }}" class="text-dark text-decoration-none d-flex align-items-center">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <div class="text-dark-50">
                        <small>Updated: Today</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-sunset-modern border-0 shadow-lg animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-dark-50 mb-1 fw-light" style="color: rgba(0,0,0,0.7) !important;">Total Peminjaman</p>
                        <h2 class="mb-0 text-dark fw-bold display-6">{{ $total_peminjaman }}</h2>
                        <div class="mt-2">
                            <span class="badge bg-white text-warning-dark px-3 py-1 rounded-pill">
                                <i class="fas fa-calendar-alt me-1"></i> {{ now()->format('M') }}
                            </span>
                        </div>
                    </div>
                    <div class="icon-circle-lg bg-white-30">
                        <i class="fas fa-handshake text-dark"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4">
                    <a href="{{ route('admin.peminjaman.index') }}" class="text-dark text-decoration-none d-flex align-items-center">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <div class="text-dark-50">
                        <small>Updated: Today</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card gradient-sunset-modern border-0 shadow-lg animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-uppercase text-dark-50 mb-1 fw-light" style="color: rgba(0,0,0,0.7) !important;">Pending Approval</p>
                        <h2 class="mb-0 text-dark fw-bold display-6">{{ $peminjaman_pending }}</h2>
                        <div class="mt-2">
                            <span class="badge bg-white text-warning-dark px-3 py-1 rounded-pill">
                                <i class="fas fa-clock me-1"></i> Menunggu
                            </span>
                        </div>
                    </div>
                    <div class="icon-circle-lg bg-white-30">
                        <i class="fas fa-clock text-dark"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4">
                    <a href="{{ route('admin.peminjaman.index') }}" class="text-dark text-decoration-none d-flex align-items-center">
                        <span>Lihat Detail</span>
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <div class="text-dark-50">
                        <small>Need Review</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
            <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                    <i class="fas fa-chart-line me-2"></i>Statistik Peminjaman 6 Bulan Terakhir
                </h3>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="peminjamanChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
            <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                    <i class="fas fa-chart-pie me-2"></i>Status Alat
                </h3>
            </div>
            <div class="card-body">
                <canvas id="alatStatusChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
            <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                    <i class="fas fa-history me-2"></i>Peminjaman Terbaru
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);">
                            <tr>
                                <th style="color: #000000;">Kode</th>
                                <th style="color: #000000;">Peminjam</th>
                                <th style="color: #000000;">Alat</th>
                                <th style="color: #000000;">Tanggal</th>
                                <th style="color: #000000;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_peminjaman as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->kode_peminjaman }}</td>
                                <td>{{ $peminjaman->user->name }}</td>
                                <td>{{ $peminjaman->alat->nama_alat }}</td>
                                <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'disetujui' => 'success',
                                            'dipinjam' => 'info',
                                            'dikembalikan' => 'secondary',
                                            'ditolak' => 'danger'
                                        ];
                                        $badgeColor = $statusColors[$peminjaman->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $badgeColor }}" style="color: {{ $badgeColor == 'warning' ? '#000000' : '#FFFFFF' }};">
                                        {{ $peminjaman->status }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@elseif(Auth::user()->isPetugas())
<div class="row">
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);">
            <div class="inner">
                <h3 style="color: #000000;">{{ $total_peminjaman }}</h3>
                <p style="color: #000000;">Total Peminjaman</p>
            </div>
            <div class="icon">
                <i class="fas fa-handshake" style="color: rgba(0,0,0,0.3);"></i>
            </div>
            <a href="{{ route('petugas.peminjaman.index') }}" class="small-box-footer" style="background: rgba(0,0,0,0.1); color: #000000;">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box" style="background: linear-gradient(135deg, #FFE55C 0%, #FFD700 100%);">
            <div class="inner">
                <h3 style="color: #000000;">{{ $peminjaman_pending }}</h3>
                <p style="color: #000000;">Pending Approval</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock" style="color: rgba(0,0,0,0.3);"></i>
            </div>
            <a href="{{ route('petugas.peminjaman.index') }}" class="small-box-footer" style="background: rgba(0,0,0,0.1); color: #000000;">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box" style="background: linear-gradient(135deg, #FFD966 0%, #FFC107 100%);">
            <div class="inner">
                <h3 style="color: #000000;">{{ $peminjaman_aktif }}</h3>
                <p style="color: #000000;">Peminjaman Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle" style="color: rgba(0,0,0,0.3);"></i>
            </div>
            <a href="{{ route('petugas.peminjaman.index') }}" class="small-box-footer" style="background: rgba(0,0,0,0.1); color: #000000;">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box" style="background: linear-gradient(135deg, #FDB931 0%, #F39C12 100%);">
            <div class="inner">
                <h3 style="color: #000000;">{{ $pengembalian_belum }}</h3>
                <p style="color: #000000;">Belum Dikembalikan</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle" style="color: rgba(0,0,0,0.3);"></i>
            </div>
            <a href="{{ route('petugas.pengembalian.index') }}" class="small-box-footer" style="background: rgba(0,0,0,0.1); color: #000000;">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
            <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                    <i class="fas fa-clock me-2"></i>Peminjaman Menunggu Persetujuan
                </h3>
            </div>
            <div class="card-body">
                @if($recent_peminjaman->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);">
                            <tr>
                                <th style="color: #000000;">Kode</th>
                                <th style="color: #000000;">Peminjam</th>
                                <th style="color: #000000;">Alat</th>
                                <th style="color: #000000;">Tanggal Pinjam</th>
                                <th style="color: #000000;">Keperluan</th>
                                <th style="color: #000000;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_peminjaman as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->kode_peminjaman }}</td>
                                <td>{{ $peminjaman->user->name }}</td>
                                <td>{{ $peminjaman->alat->nama_alat }}</td>
                                <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>{{ Str::limit($peminjaman->keperluan, 50) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('petugas.peminjaman.show', $peminjaman) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: 1px solid rgba(0,0,0,0.1);">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('petugas.peminjaman.approve', $peminjaman) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button class="btn btn-sm" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; border: 1px solid rgba(0,0,0,0.1);">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('petugas.peminjaman.reject', $peminjaman) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button class="btn btn-sm" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: #FFFFFF; border: 1px solid rgba(0,0,0,0.1);">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 4px solid #FFD700; color: #000000;">
                    <i class="fas fa-check-circle me-2"></i> Tidak ada peminjaman yang menunggu persetujuan.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@else
<!-- Dashboard Peminjam -->
<div class="row">
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);">
            <div class="inner">
                <h3 style="color: #000000;">{{ $total_peminjaman }}</h3>
                <p style="color: #000000;">Total Peminjaman</p>
            </div>
            <div class="icon">
                <i class="fas fa-handshake" style="color: rgba(0,0,0,0.3);"></i>
            </div>
            <a href="{{ route('peminjam.peminjaman.index') }}" class="small-box-footer" style="background: rgba(0,0,0,0.1); color: #000000;">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box" style="background: linear-gradient(135deg, #FFE55C 0%, #FFD700 100%);">
            <div class="inner">
                <h3 style="color: #000000;">{{ $peminjaman_aktif }}</h3>
                <p style="color: #000000;">Peminjaman Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle" style="color: rgba(0,0,0,0.3);"></i>
            </div>
            <a href="{{ route('peminjam.peminjaman.index') }}" class="small-box-footer" style="background: rgba(0,0,0,0.1); color: #000000;">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box" style="background: linear-gradient(135deg, #FFD966 0%, #FFC107 100%);">
            <div class="inner">
                <h3 style="color: #000000;">{{ $peminjaman_selesai }}</h3>
                <p style="color: #000000;">Peminjaman Selesai</p>
            </div>
            <div class="icon">
                <i class="fas fa-history" style="color: rgba(0,0,0,0.3);"></i>
            </div>
            <a href="{{ route('peminjam.peminjaman.index') }}" class="small-box-footer" style="background: rgba(0,0,0,0.1); color: #000000;">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box" style="background: linear-gradient(135deg, #FDB931 0%, #F39C12 100%);">
            <div class="inner">
                <h3 style="color: #000000;">{{ $jatuh_tempo }}</h3>
                <p style="color: #000000;">Jatuh Tempo</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-triangle" style="color: rgba(0,0,0,0.3);"></i>
            </div>
            <a href="{{ route('peminjam.pengembalian.index') }}" class="small-box-footer" style="background: rgba(0,0,0,0.1); color: #000000;">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="mb-4">
    <video autoplay muted loop controls style="width: 100%; height: auto; border-radius: 10px;">
        <source src="{{ asset('img/iklan2.mp4') }}" type="video/mp4">
    </video>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
            <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                    <i class="fas fa-history me-2"></i>Peminjaman Terbaru Saya
                </h3>
            </div>
            <div class="card-body">
                @if($recent_peminjaman->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);">
                            <tr>
                                <th style="color: #000000;">Kode</th>
                                <th style="color: #000000;">Alat</th>
                                <th style="color: #000000;">Tanggal Pinjam</th>
                                <th style="color: #000000;">Tanggal Kembali</th>
                                <th style="color: #000000;">Status</th>
                                <th style="color: #000000;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_peminjaman as $peminjaman)
                            <tr>
                                <td>{{ $peminjaman->kode_peminjaman }}</td>
                                <td>{{ $peminjaman->alat->nama_alat }}</td>
                                <td>{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'disetujui' => 'success',
                                            'dipinjam' => 'info',
                                            'dikembalikan' => 'secondary',
                                            'ditolak' => 'danger'
                                        ];
                                        $badgeColor = $statusColors[$peminjaman->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $badgeColor }}" style="color: {{ $badgeColor == 'warning' ? '#000000' : '#FFFFFF' }};">
                                        {{ $peminjaman->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($peminjaman->status == 'dipinjam')
                                    <a href="{{ route('peminjam.pengembalian.index') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: 1px solid rgba(0,0,0,0.1);">
                                        <i class="fas fa-undo"></i> Kembalikan
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 4px solid #FFD700; color: #000000;">
                    <i class="fas fa-info-circle me-2"></i> Belum ada peminjaman. 
                    <a href="{{ route('peminjam.alat.index') }}" style="color: #000000; font-weight: 600; text-decoration: underline;">Ajukan peminjaman sekarang!</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
            <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                    <i class="fas fa-info-circle me-2"></i>Informasi Penting
                </h3>
            </div>
            <div class="card-body">
                <div class="p-3 rounded" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-left: 4px solid #FFD700;">
                    <h5 style="color: #000000; font-weight: 600;"><i class="fas fa-info-circle"></i> Petunjuk Peminjaman</h5>
                    <p style="color: #000000;">1. Pilih alat yang tersedia</p>
                    <p style="color: #000000;">2. Ajukan peminjaman dengan lengkap</p>
                    <p style="color: #000000;">3. Tunggu persetujuan petugas</p>
                    <p style="color: #000000;">4. Kembalikan tepat waktu</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</div>

<style>
/* Gradasi Warna Kuning Modern */
.gradient-sunset-modern {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.gradient-sunset-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(255, 215, 0, 0.3) !important;
}

/* Efek overlay yang lebih halus */
.gradient-sunset-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0));
    pointer-events: none;
}

/* Icon Circle */
.icon-circle-lg {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.bg-white-30 {
    background: rgba(255, 255, 255, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.4);
}

/* Warna teks */
.text-dark-50 {
    color: rgba(0, 0, 0, 0.7) !important;
}

.text-warning-dark {
    color: #FDB931 !important;
}

/* Badge styling */
.badge {
    font-weight: 500;
    padding: 0.5rem 1rem;
}

/* Table styling */
.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFF3CD 100%);
    transition: all 0.3s ease;
}

.table td, .table th {
    border-color: rgba(0,0,0,0.05);
}

/* Small box customization */
.small-box {
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.small-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 2rem rgba(255, 215, 0, 0.3);
}

.small-box .inner {
    padding: 1.5rem;
}

.small-box .icon {
    font-size: 5rem;
    opacity: 0.5;
}

/* Alert styling */
.alert {
    border-radius: 0.5rem;
    padding: 1rem 1.5rem;
}

/* Video styling */
video {
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    width: 100%;
    max-width: 600px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .icon-circle-lg {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .display-6 {
        font-size: 2rem;
    }
}

/* Hover effect untuk link */
.card a {
    transition: all 0.3s ease;
}

.card a:hover {
    letter-spacing: 0.5px;
}

/* Efek glow pada hover icon */
.gradient-sunset-modern:hover .icon-circle-lg {
    background: rgba(255, 255, 255, 0.4);
    transform: scale(1.1);
    transition: all 0.3s ease;
}

/* Card header styling */
.card-header {
    border-radius: 0.5rem 0.5rem 0 0 !important;
    padding: 1rem 1.5rem;
}

/* Table border styling */
.table-bordered {
    border: 1px solid rgba(255, 215, 0, 0.2);
}

.table-bordered th,
.table-bordered td {
    border: 1px solid rgba(255, 215, 0, 0.2);
}

/* Button group styling */
.btn-group .btn {
    margin: 0 2px;
    border-radius: 0.25rem !important;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 10px rgba(0,0,0,0.1);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #FFF9E6;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #FDB931 0%, #FFD700 100%);
}

</style>

@endsection

@if(Auth::user()->isAdmin())
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* ================= PEMINJAMAN 6 BULAN ================= */
const peminjamanCtx = document.getElementById('peminjamanChart');

if (peminjamanCtx) {
    new Chart(peminjamanCtx, {
        type: 'line',
        data: {
            labels: @json($chart_bulan),
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: @json($chart_total),
                borderWidth: 3,
                fill: false,
                tension: 0.3,
                borderColor: '#FDB931',
                backgroundColor: 'rgba(255, 215, 0, 0.1)',
                pointBackgroundColor: '#FFD700',
                pointBorderColor: '#000000',
                pointHoverBackgroundColor: '#FDB931',
                pointHoverBorderColor: '#000000'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#000000'
                    }
                }
            },
            scales: {
                y: {
                    grid: {
                        color: 'rgba(255, 215, 0, 0.1)'
                    },
                    ticks: {
                        color: '#000000'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 215, 0, 0.1)'
                    },
                    ticks: {
                        color: '#000000'
                    }
                }
            }
        }
    });
}

/* ================= STATUS ALAT ================= */
const alatCtx = document.getElementById('alatStatusChart');

if (alatCtx) {
    new Chart(alatCtx, {
        type: 'doughnut',
        data: {
            labels: ['Tersedia', 'Dipinjam', 'Rusak'],
            datasets: [{
                data: [
                    {{ $alat_tersedia }},
                    {{ $alat_dipinjam }},
                    {{ $alat_rusak }}
                ],
                backgroundColor: [
                    '#FFD700',
                    '#FDB931',
                    '#F39C12'
                ],
                borderColor: '#FFFFFF',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#000000'
                    }
                }
            }
        }
    });
}
</script>
@endpush
@endif