@extends('layouts.app')

@section('title', 'Manajemen Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-handshake me-2"></i> Daftar Peminjaman
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.peminjaman.create') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Peminjaman
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($peminjamans->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover-yellow" id="peminjamanTable">
                    <thead class="table-header-yellow">
                        <tr>
                            <th style="color: #000000; padding: 12px;">Kode</th>
                            <th style="color: #000000; padding: 12px;">Peminjam</th>
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
                                <i class="fas fa-user-circle me-1" style="color: #FDB931;"></i>
                                {{ $peminjaman->user->name }}
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
                                @if($peminjaman->tanggal_kembali < now() && $peminjaman->status != 'selesai')
                                <br>
                                <span class="badge" style="background: #dc3545; color: #FFFFFF; margin-top: 5px;">
                                    <i class="fas fa-exclamation-triangle me-1"></i> Terlambat
                                </span>
                                @endif
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
                            </td>
                            <td style="padding: 12px;">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.peminjaman.show', $peminjaman) }}" class="btn-yellow btn-sm" 
                                       style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF;">
                                        <i class="fas fa-eye me-1"></i>
                                    </a>
                                    <a href="{{ route('admin.peminjaman.edit', $peminjaman) }}" class="btn-yellow btn-sm ms-1"
                                       style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                                        <i class="fas fa-edit me-1"></i>
                                    </a>
                                    <form action="{{ route('admin.peminjaman.destroy', $peminjaman) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman {{ $peminjaman->kode_peminjaman }}?')"
                                                style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 6px 12px;">
                                            <i class="fas fa-trash me-1"></i>
                                        </button>
                                    </form>
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
                <h4 style="color: #000000;">Tidak ada data peminjaman</h4>
                <p style="color: #666;">Belum ada peminjaman yang terdaftar dalam sistem.</p>
                <a href="{{ route('admin.peminjaman.create') }}" class="btn-yellow mt-2">
                    <i class="fas fa-plus me-1"></i> Tambah Peminjaman Pertama
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
    display: inline-flex;
    align-items: center;
    gap: 5px;
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

/* Gap utilities */
.ms-1 {
    margin-left: 5px;
}

.me-1 {
    margin-right: 5px;
}

.me-2 {
    margin-right: 10px;
}

.mt-2 {
    margin-top: 8px;
}

.mt-3 {
    margin-top: 15px;
}

.mt-4 {
    margin-top: 20px;
}

.mb-3 {
    margin-bottom: 15px;
}

/* Text utilities */
.text-muted {
    color: #6c757d !important;
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
    .btn-group .btn-sm {
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
    
    .alert-yellow h4 {
        font-size: 18px;
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

/* Badge animation */
.badge {
    transition: all 0.3s ease;
}

.badge:hover {
    transform: scale(1.05);
}

/* Button hover effects */
.btn-group .btn-sm {
    transition: all 0.3s ease;
}

.btn-group .btn-sm:hover {
    transform: translateY(-2px);
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