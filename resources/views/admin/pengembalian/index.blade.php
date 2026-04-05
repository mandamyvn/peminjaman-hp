@extends('layouts.app')

@section('title', 'Manajemen Pengembalian')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-undo-alt me-2"></i> Daftar Pengembalian
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.pengembalian.create') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Pengembalian
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($pengembalians->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover-yellow" id="pengembalianTable">
                    <thead class="table-header-yellow">
                        <tr>
                            <th style="color: #000000; padding: 12px;">ID</th>
                            <th style="color: #000000; padding: 12px;">Kode Peminjaman</th>
                            <th style="color: #000000; padding: 12px;">Tanggal Kembali</th>
                            <th style="color: #000000; padding: 12px;">Jumlah</th>
                            <th style="color: #000000; padding: 12px;">Kondisi</th>
                            <th style="color: #000000; padding: 12px;">Denda</th>
                            <th style="color: #000000; padding: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengembalians as $pengembalian)
                        <tr style="border-bottom: 1px solid #FFE69C;">
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge-yellow">#{{ $pengembalian->id }}</span>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-qrcode me-1" style="color: #FDB931;"></i>
                                <strong>{{ $pengembalian->peminjaman->kode_peminjaman }}</strong>
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i> {{ $pengembalian->peminjaman->user->name }}
                                </small>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                {{ $pengembalian->tanggal_kembali->format('d/m/Y') }}
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i> {{ $pengembalian->tanggal_kembali->format('H:i') }}
                                </small>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge-yellow">
                                    <i class="fas fa-box me-1"></i> {{ $pengembalian->jumlah_kembali }}
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                @php
                                    $kondisiColors = [
                                        'baik' => '#28a745',
                                        'rusak_ringan' => '#FFD700',
                                        'rusak_berat' => '#dc3545'
                                    ];
                                    $kondisiTextColors = [
                                        'baik' => '#FFFFFF',
                                        'rusak_ringan' => '#000000',
                                        'rusak_berat' => '#FFFFFF'
                                    ];
                                    $kondisiIcons = [
                                        'baik' => 'fa-check-circle',
                                        'rusak_ringan' => 'fa-exclamation-triangle',
                                        'rusak_berat' => 'fa-times-circle'
                                    ];
                                @endphp
                                <span class="badge" style="background-color: {{ $kondisiColors[$pengembalian->kondisi] ?? '#6c757d' }}; color: {{ $kondisiTextColors[$pengembalian->kondisi] ?? '#FFFFFF' }}; padding: 6px 12px; border-radius: 6px;">
                                    <i class="fas {{ $kondisiIcons[$pengembalian->kondisi] ?? 'fa-info-circle' }} me-1"></i>
                                    {{ ucfirst(str_replace('_', ' ', $pengembalian->kondisi)) }}
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                @if($pengembalian->denda > 0)
                                <span class="text-danger">
                                    <i class="fas fa-money-bill me-1"></i>
                                    <strong>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</strong>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Tidak Ada Denda
                                </span>
                                @endif
                            </td>
                            <td style="padding: 12px;">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.pengembalian.show', $pengembalian) }}" class="btn-yellow btn-sm" 
                                       style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF;">
                                        <i class="fas fa-eye me-1"></i>
                                    </a>
                                    <a href="{{ route('admin.pengembalian.edit', $pengembalian) }}" class="btn-yellow btn-sm ms-1"
                                       style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                                        <i class="fas fa-edit me-1"></i>
                                    </a>
                                    <form action="{{ route('admin.pengembalian.destroy', $pengembalian) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data pengembalian untuk peminjaman {{ $pengembalian->peminjaman->kode_peminjaman }}?')"
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
                {{ $pengembalians->links() }}
            </div>
            @else
            <div class="alert-yellow text-center py-5">
                <i class="fas fa-inbox fa-4x mb-3" style="color: #FDB931;"></i>
                <h4 style="color: #000000;">Tidak ada data pengembalian</h4>
                <p style="color: #666;">Belum ada pengembalian yang terdaftar dalam sistem.</p>
                <a href="{{ route('admin.pengembalian.create') }}" class="btn-yellow mt-2">
                    <i class="fas fa-plus me-1"></i> Tambah Pengembalian Pertama
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

/* Text utilities */
.text-muted {
    color: #6c757d !important;
    font-size: 11px;
}

.text-success {
    color: #28a745 !important;
}

.text-danger {
    color: #dc3545 !important;
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