@extends('layouts.app')

@section('title', 'Peminjaman Saya')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-history me-2"></i> Riwayat Peminjaman Saya
            </h3>
            <div class="card-tools">
                <a href="{{ route('peminjam.alat.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-search me-1"></i> Cari Alat
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($peminjamans->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover-yellow">
                    <thead class="table-header-yellow">
                        <tr>
                            <th style="color: #000000; padding: 12px;">Kode</th>
                            <th style="color: #000000; padding: 12px;">Alat</th>
                            <th style="color: #000000; padding: 12px;">Tanggal Pinjam</th>
                            <th style="color: #000000; padding: 12px;">Tanggal Kembali</th>
                            <th style="color: #000000; padding: 12px;">Jumlah</th>
                            <th style="color: #000000; padding: 12px;">Status</th>
                            <th style="color: #000000; padding: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjamans as $peminjaman)
                        <tr style="border-bottom: 1px solid #FFE69C;">
                            <td style="color: #000000; padding: 12px;">
                                <strong>{{ $peminjaman->kode_peminjaman }}</strong>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-laptop me-1" style="color: #FDB931;"></i>
                                {{ $peminjaman->alat->nama_alat }}
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                {{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                {{ $peminjaman->tanggal_kembali->format('d/m/Y') }}
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge-yellow">
                                    <i class="fas fa-box me-1"></i> {{ $peminjaman->jumlah }}
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                @php
                                    $statusColors = [
                                        'pending' => '#FFD700',
                                        'disetujui' => '#28a745',
                                        'ditolak' => '#dc3545',
                                        'dipinjam' => '#17a2b8',
                                        'menunggu_pengembalian' => '#ffc107',
                                        'selesai' => '#6c757d'
                                    ];
                                    $statusTextColors = [
                                        'pending' => '#000000',
                                        'disetujui' => '#FFFFFF',
                                        'ditolak' => '#FFFFFF',
                                        'dipinjam' => '#FFFFFF',
                                        'menunggu_pengembalian' => '#000000',
                                        'selesai' => '#FFFFFF'
                                    ];
                                    $statusIcons = [
                                        'pending' => 'fa-clock',
                                        'disetujui' => 'fa-check-circle',
                                        'ditolak' => 'fa-times-circle',
                                        'dipinjam' => 'fa-handshake',
                                        'menunggu_pengembalian' => 'fa-hourglass-half',
                                        'selesai' => 'fa-check-double'
                                    ];
                                    $badgeColor = $statusColors[$peminjaman->status] ?? '#6c757d';
                                    $textColor = $statusTextColors[$peminjaman->status] ?? '#FFFFFF';
                                    $icon = $statusIcons[$peminjaman->status] ?? 'fa-info-circle';
                                @endphp
                                <span class="badge" style="background-color: {{ $badgeColor }}; color: {{ $textColor }}; padding: 6px 12px; border-radius: 6px;">
                                    <i class="fas {{ $icon }} me-1"></i>
                                    {{ ucfirst($peminjaman->status) }}
                                </span>
                                
                                @if($peminjaman->status == 'ditolak' && $peminjaman->catatan_admin)
                                <br>
                                <small class="text-muted" style="font-size: 11px; display: inline-block; margin-top: 5px;">
                                    <i class="fas fa-comment me-1"></i> Alasan: {{ $peminjaman->catatan_admin }}
                                </small>
                                @endif
                                
                                @if($peminjaman->status == 'pending' && $peminjaman->catatan_admin)
                                <br>
                                <small class="text-muted" style="font-size: 11px; display: inline-block; margin-top: 5px;">
                                    <i class="fas fa-info-circle me-1"></i> Catatan: {{ $peminjaman->catatan_admin }}
                                </small>
                                @endif
                            </td>
                            <td style="padding: 12px;">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('peminjam.peminjaman.show', $peminjaman) }}" 
                                       class="btn-yellow btn-sm" 
                                       style="padding: 6px 12px;">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                    
                                    @if($peminjaman->status == 'dipinjam')
                                    <a href="{{ route('peminjam.pengembalian.index') }}" 
                                       class="btn-green btn-sm ms-1" 
                                       style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 6px 12px;">
                                        <i class="fas fa-undo me-1"></i> Kembalikan
                                    </a>
                                    @endif
                                    
                                    @if($peminjaman->status == 'disetujui')
                                    <span class="badge" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF; padding: 6px 12px; margin-left: 5px;">
                                        <i class="fas fa-hourglass-half me-1"></i> Menunggu Konfirmasi
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 d-flex justify-content-center">
                {{ $peminjamans->links() }}
            </div>
            
            @else
            <div class="alert-yellow text-center py-5">
                <i class="fas fa-inbox fa-4x mb-3" style="color: #FDB931;"></i>
                <h4 style="color: #000000;">Belum ada peminjaman</h4>
                <p style="color: #666;">Anda belum mengajukan peminjaman alat.</p>
                <a href="{{ route('peminjam.alat.index') }}" class="btn-yellow mt-3">
                    <i class="fas fa-search me-1"></i> Cari Alat Sekarang
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Table hover effect */
.table-hover-yellow tbody tr:hover {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFF3CD 100%);
    transition: all 0.3s ease;
    cursor: pointer;
}

/* Table header styling */
.table-header-yellow {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
}

.table-header-yellow th {
    color: #000000;
    border: none;
    padding: 12px;
    font-weight: 600;
}

/* Badge styling */
.badge-yellow {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    color: #000000;
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 12px;
}

/* Button group styling */
.btn-group {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

.btn-yellow {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    color: #000000;
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
}

.btn-yellow:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    color: #000000;
    text-decoration: none;
}

.btn-yellow.btn-sm {
    padding: 6px 12px;
    font-size: 13px;
}

.btn-green {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: #FFFFFF;
    border: none;
    border-radius: 8px;
    padding: 6px 12px;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
}

.btn-green:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    color: #FFFFFF;
    text-decoration: none;
}

/* Alert styling */
.alert-yellow {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    border-left: 4px solid #FFD700;
    color: #000000;
    border-radius: 12px;
    padding: 40px 20px;
}

/* Pagination styling */
.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    border-color: #FFD700;
    color: #000000;
}

.pagination .page-link {
    color: #FDB931;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    color: #000000;
}

/* Gap utility */
.ms-1 {
    margin-left: 5px;
}

.me-1 {
    margin-right: 5px;
}

.me-2 {
    margin-right: 10px;
}

.mt-3 {
    margin-top: 15px;
}

.mt-4 {
    margin-top: 20px;
}

.mb-2 {
    margin-bottom: 10px;
}

.mb-3 {
    margin-bottom: 15px;
}

/* Responsive */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 13px;
    }
    
    .btn-group {
        flex-direction: column;
        gap: 5px;
    }
    
    .btn-yellow.btn-sm,
    .btn-green {
        padding: 5px 10px;
        font-size: 11px;
    }
    
    .card-header-yellow {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .card-tools {
        justify-content: center;
    }
    
    .table-header-yellow th {
        padding: 8px;
        font-size: 12px;
    }
    
    td {
        padding: 8px !important;
        font-size: 12px;
    }
    
    .badge {
        font-size: 11px;
        padding: 4px 8px;
    }
}

/* Animation */
.card-yellow {
    animation: fadeInUp 0.5s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Status badge animation */
.badge {
    transition: all 0.3s ease;
}

.badge:hover {
    transform: scale(1.05);
}

/* Text styling */
.text-muted {
    color: #6c757d !important;
}

/* Scrollbar */
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

@push('styles')
<style>
/* CSS Global untuk tema kuning - reusable classes */
:root {
    --yellow-primary: #FFD700;
    --yellow-secondary: #FDB931;
    --yellow-light: #FFF9E6;
    --yellow-soft: #FFF3CD;
    --yellow-medium: #FFE69C;
    --yellow-dark: #F39C12;
    --text-dark: #000000;
}

/* Card styling */
.card-yellow {
    background: linear-gradient(135deg, var(--yellow-light) 0%, #FFFFFF 100%);
    border: none;
    border-radius: 12px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-yellow:hover {
    transform: translateY(-3px);
    box-shadow: 0 1rem 2rem rgba(255, 215, 0, 0.2);
}

/* Card header styling */
.card-header-yellow {
    background: linear-gradient(135deg, var(--yellow-primary) 0%, var(--yellow-secondary) 100%);
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    padding: 1rem 1.25rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.card-header-yellow h3,
.card-header-yellow .card-title {
    color: var(--text-dark) !important;
    font-weight: 600;
    margin: 0;
}

/* Table hover effect */
.table-hover-yellow tbody tr:hover {
    background: linear-gradient(135deg, var(--yellow-light) 0%, var(--yellow-soft) 100%);
    transition: all 0.3s ease;
}
</style>
@endpush