@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-info-circle me-2"></i> Detail Peminjaman: {{ $peminjaman->kode_peminjaman }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.peminjaman.edit', $peminjaman) }}" class="btn-yellow btn-sm" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('admin.peminjaman.index') }}" class="btn-yellow btn-sm ms-1" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: #FFFFFF;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="info-detail-card">
                        <div class="info-detail-header">
                            <i class="fas fa-file-alt me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Peminjaman</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-qrcode" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Kode Peminjaman</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">{{ $peminjaman->kode_peminjaman }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-alt" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Tanggal Pinjam</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                    {{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}
                                    <small class="text-muted ms-2">({{ $peminjaman->tanggal_pinjam->diffForHumans() }})</small>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-check" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Tanggal Kembali</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                    {{ $peminjaman->tanggal_kembali->format('d/m/Y') }}
                                    @if($peminjaman->tanggal_kembali < now() && $peminjaman->status != 'selesai')
                                    <span class="badge ms-2" style="background: #dc3545; color: #FFFFFF;">
                                        <i class="fas fa-exclamation-triangle me-1"></i> Terlambat
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-cube" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Jumlah</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">
                                        <i class="fas fa-box me-1"></i> {{ $peminjaman->jumlah }} Unit
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-tag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Status</strong>
                                </div>
                                <div class="info-value-detail">
                                    @php
                                        $statusColors = [
                                            'pending' => '#FFD700',
                                            'disetujui' => '#28a745',
                                            'ditolak' => '#dc3545',
                                            'dipinjam' => '#17a2b8',
                                            'selesai' => '#6c757d'
                                        ];
                                        $statusTextColors = [
                                            'pending' => '#000000',
                                            'disetujui' => '#FFFFFF',
                                            'ditolak' => '#FFFFFF',
                                            'dipinjam' => '#FFFFFF',
                                            'selesai' => '#FFFFFF'
                                        ];
                                        $statusIcons = [
                                            'pending' => 'fa-clock',
                                            'disetujui' => 'fa-check-circle',
                                            'ditolak' => 'fa-times-circle',
                                            'dipinjam' => 'fa-handshake',
                                            'selesai' => 'fa-check-double'
                                        ];
                                    @endphp
                                    <span class="badge" style="background-color: {{ $statusColors[$peminjaman->status] ?? '#6c757d' }}; color: {{ $statusTextColors[$peminjaman->status] ?? '#FFFFFF' }}; padding: 6px 12px;">
                                        <i class="fas {{ $statusIcons[$peminjaman->status] ?? 'fa-info-circle' }} me-1"></i>
                                        {{ ucfirst($peminjaman->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-comment" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Keperluan</strong>
                                </div>
                                <div class="info-value-detail">
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                        {{ $peminjaman->keperluan }}
                                    </div>
                                </div>
                            </div>
                            
                            @if($peminjaman->catatan_admin)
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-sticky-note" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Catatan Admin</strong>
                                </div>
                                <div class="info-value-detail">
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                        {{ $peminjaman->catatan_admin }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-plus" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Dibuat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                    {{ $peminjaman->created_at->format('d/m/Y H:i') }}
                                    <small class="text-muted ms-2">({{ $peminjaman->created_at->diffForHumans() }})</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="info-detail-card">
                        <div class="info-detail-header">
                            <i class="fas fa-user me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Peminjam</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-user" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Nama Peminjam</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-user-circle me-1" style="color: #FDB931;"></i>
                                    {{ $peminjaman->user->name }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-envelope" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Email</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-envelope me-1" style="color: #FDB931;"></i>
                                    {{ $peminjaman->user->email }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-id-card" style="color: #FDB931; width: 30px;"></i>
                                    <strong>NIM</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $peminjaman->user->nim ?? '-' }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-phone" style="color: #FDB931; width: 30px;"></i>
                                    <strong>No HP</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $peminjaman->user->no_hp ?? '-' }}
                                </div>
                            </div>
                            
                            @if($peminjaman->disetujuiOleh)
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-user-check" style="color: #28a745; width: 30px;"></i>
                                    <strong>Disetujui Oleh</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-user-check me-1" style="color: #28a745;"></i>
                                    {{ $peminjaman->disetujuiOleh->name }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-detail-card mt-4">
                        <div class="info-detail-header">
                            <i class="fas fa-laptop me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Alat</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-tag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Nama Alat</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $peminjaman->alat->nama_alat }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-barcode" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Kode Alat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">{{ $peminjaman->alat->kode_alat }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-folder" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Kategori</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 5px 12px;">
                                        {{ $peminjaman->alat->kategori->nama_kategori }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-industry" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Merk</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $peminjaman->alat->merk ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($peminjaman->pengembalian)
            <div class="row mt-2">
                <div class="col-12">
                    <div class="pengembalian-card">
                        <div class="pengembalian-header">
                            <i class="fas fa-undo-alt me-2" style="color: #28a745;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Pengembalian</span>
                        </div>
                        <div class="pengembalian-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-row-detail">
                                        <div class="info-label-detail">
                                            <i class="fas fa-calendar-check" style="color: #FDB931; width: 30px;"></i>
                                            <strong>Tanggal Kembali</strong>
                                        </div>
                                        <div class="info-value-detail">
                                            <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                            {{ $peminjaman->pengembalian->tanggal_kembali->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    
                                    <div class="info-row-detail">
                                        <div class="info-label-detail">
                                            <i class="fas fa-cube" style="color: #FDB931; width: 30px;"></i>
                                            <strong>Jumlah Kembali</strong>
                                        </div>
                                        <div class="info-value-detail">
                                            <span class="badge-yellow">{{ $peminjaman->pengembalian->jumlah_kembali }} Unit</span>
                                        </div>
                                    </div>
                                    
                                    <div class="info-row-detail">
                                        <div class="info-label-detail">
                                            <i class="fas fa-clipboard-list" style="color: #FDB931; width: 30px;"></i>
                                            <strong>Kondisi</strong>
                                        </div>
                                        <div class="info-value-detail">
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
                                            @endphp
                                            <span class="badge" style="background-color: {{ $kondisiColors[$peminjaman->pengembalian->kondisi] ?? '#6c757d' }}; color: {{ $kondisiTextColors[$peminjaman->pengembalian->kondisi] ?? '#FFFFFF' }}; padding: 6px 12px;">
                                                {{ ucfirst(str_replace('_', ' ', $peminjaman->pengembalian->kondisi)) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="info-row-detail">
                                        <div class="info-label-detail">
                                            <i class="fas fa-money-bill" style="color: #dc3545; width: 30px;"></i>
                                            <strong>Denda</strong>
                                        </div>
                                        <div class="info-value-detail">
                                            <strong class="text-danger">
                                                Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
                                            </strong>
                                        </div>
                                    </div>
                                    
                                    <div class="info-row-detail">
                                        <div class="info-label-detail">
                                            <i class="fas fa-user-check" style="color: #28a745; width: 30px;"></i>
                                            <strong>Diterima Oleh</strong>
                                        </div>
                                        <div class="info-value-detail">
                                            <i class="fas fa-user-check me-1" style="color: #28a745;"></i>
                                            {{ $peminjaman->pengembalian->diterimaOleh->name }}
                                        </div>
                                    </div>
                                    
                                    @if($peminjaman->pengembalian->keterangan)
                                    <div class="info-row-detail">
                                        <div class="info-label-detail">
                                            <i class="fas fa-comment" style="color: #FDB931; width: 30px;"></i>
                                            <strong>Keterangan</strong>
                                        </div>
                                        <div class="info-value-detail">
                                            <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                                {{ $peminjaman->pengembalian->keterangan }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Info Detail Card */
.info-detail-card {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #FFE69C;
}

.info-detail-header {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    padding: 12px 20px;
    border-bottom: 2px solid #FFD700;
    font-weight: 600;
    color: #000000;
}

.info-detail-body {
    padding: 20px;
}

/* Info Row Styling */
.info-row-detail {
    display: flex;
    padding: 12px 0;
    border-bottom: 1px solid #FFE69C;
}

.info-row-detail:last-child {
    border-bottom: none;
}

.info-label-detail {
    width: 35%;
    font-weight: 500;
    color: #000000;
    display: flex;
    align-items: center;
}

.info-value-detail {
    width: 65%;
    color: #000000;
}

/* Pengembalian Card */
.pengembalian-card {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #28a745;
}

.pengembalian-header {
    background: linear-gradient(135deg, #D4EDDA 0%, #C3E6CB 100%);
    padding: 12px 20px;
    border-bottom: 2px solid #28a745;
    font-weight: 600;
    color: #000000;
}

.pengembalian-body {
    padding: 20px;
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

/* Text utilities */
.text-muted {
    color: #6c757d !important;
}

.text-danger {
    color: #dc3545 !important;
}

.ms-2 {
    margin-left: 8px;
}

.me-1 {
    margin-right: 4px;
}

.me-2 {
    margin-right: 8px;
}

.mb-4 {
    margin-bottom: 20px;
}

.mt-2 {
    margin-top: 8px;
}

.mt-4 {
    margin-top: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .info-row-detail {
        flex-direction: column;
    }
    
    .info-label-detail {
        width: 100%;
        margin-bottom: 8px;
    }
    
    .info-value-detail {
        width: 100%;
    }
    
    .card-header-yellow {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .card-tools {
        justify-content: center;
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
</style>
@endpush