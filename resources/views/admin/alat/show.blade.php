@extends('layouts.app')

@section('title', 'Detail Alat')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-laptop me-2"></i> Detail Alat: {{ $alat->nama_alat }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.alat.edit', $alat) }}" class="btn-yellow btn-sm" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('admin.alat.index') }}" class="btn-yellow btn-sm ms-1" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: #FFFFFF;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <!-- Gambar Alat -->
                    @if($alat->gambar)
                    <div class="text-center mb-3">
                        <img src="{{ asset('img/' . $alat->gambar) }}" 
                             alt="{{ $alat->nama_alat }}" 
                             class="img-fluid rounded"
                             style="max-height: 300px; width: 100%; object-fit: cover; border: 3px solid #FFD700; border-radius: 12px;">
                    </div>
                    @else
                    <div class="text-center mb-3">
                        <div class="no-image-placeholder">
                            <i class="fas fa-laptop fa-5x" style="color: #FDB931;"></i>
                            <p class="mt-2" style="color: #000000;">Tidak ada gambar</p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Info Boxes -->
                    <div class="info-box-yellow mb-3">
                        <div class="info-box-icon-yellow" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);">
                            <i class="fas fa-barcode" style="color: #FFFFFF;"></i>
                        </div>
                        <div class="info-box-content">
                            <span class="info-box-text">Kode Alat</span>
                            <span class="info-box-number">{{ $alat->kode_alat }}</span>
                        </div>
                    </div>
                    
                    <div class="info-box-yellow mb-3">
                        <div class="info-box-icon-yellow" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <i class="fas fa-box" style="color: #FFFFFF;"></i>
                        </div>
                        <div class="info-box-content">
                            <span class="info-box-text">Stok Tersedia</span>
                            <span class="info-box-number">{{ $alat->stok }} Unit</span>
                        </div>
                    </div>
                    
                    <div class="info-box-yellow">
                        <div class="info-box-icon-yellow" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);">
                            <i class="fas fa-money-bill" style="color: #000000;"></i>
                        </div>
                        <div class="info-box-content">
                            <span class="info-box-text">Harga Sewa / Hari</span>
                            <span class="info-box-number">Rp {{ number_format($alat->harga_sewa_perhari,0,',','.') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="info-detail-card">
                        <div class="info-detail-header">
                            <i class="fas fa-info-circle me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Lengkap Alat</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-tag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Nama Alat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <strong>{{ $alat->nama_alat }}</strong>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-folder" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Kategori</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 5px 12px;">
                                        <i class="fas fa-folder me-1"></i> {{ $alat->kategori->nama_kategori }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-industry" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Merk</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $alat->merk ?? '-' }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-microchip" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Spesifikasi</strong>
                                </div>
                                <div class="info-value-detail">
                                    @if($alat->spesifikasi)
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                        {{ $alat->spesifikasi }}
                                    </div>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-info-circle" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Status</strong>
                                </div>
                                <div class="info-value-detail">
                                    @php
                                        $statusColors = [
                                            'tersedia' => '#28a745',
                                            'dipinjam' => '#FFD700',
                                            'rusak' => '#dc3545'
                                        ];
                                        $statusTextColors = [
                                            'tersedia' => '#FFFFFF',
                                            'dipinjam' => '#000000',
                                            'rusak' => '#FFFFFF'
                                        ];
                                        $statusIcons = [
                                            'tersedia' => 'fa-check-circle',
                                            'dipinjam' => 'fa-clock',
                                            'rusak' => 'fa-exclamation-triangle'
                                        ];
                                    @endphp
                                    <span class="badge" style="background-color: {{ $statusColors[$alat->status] ?? '#6c757d' }}; color: {{ $statusTextColors[$alat->status] ?? '#FFFFFF' }}; padding: 6px 12px;">
                                        <i class="fas {{ $statusIcons[$alat->status] ?? 'fa-info-circle' }} me-1"></i>
                                        {{ ucfirst($alat->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-align-left" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Deskripsi</strong>
                                </div>
                                <div class="info-value-detail">
                                    @if($alat->deskripsi)
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                        {{ $alat->deskripsi }}
                                    </div>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-plus" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Dibuat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                    {{ $alat->created_at->format('d/m/Y H:i') }}
                                    <small class="text-muted ms-2">({{ $alat->created_at->diffForHumans() }})</small>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-edit" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Diperbarui</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                    {{ $alat->updated_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Riwayat Peminjaman -->
                    <div class="riwayat-card mt-4">
                        <div class="riwayat-header">
                            <i class="fas fa-history me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Riwayat Peminjaman</span>
                            <span class="badge-yellow ms-2">{{ $alat->peminjamans->count() }} Peminjaman</span>
                        </div>
                        <div class="riwayat-body">
                            @if($alat->peminjamans->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover-yellow">
                                    <thead class="table-header-yellow">
                                        <tr>
                                            <th style="color: #000000; padding: 10px;">Kode</th>
                                            <th style="color: #000000; padding: 10px;">Peminjam</th>
                                            <th style="color: #000000; padding: 10px;">Tanggal</th>
                                            <th style="color: #000000; padding: 10px;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($alat->peminjamans->take(5) as $peminjaman)
                                        <tr style="border-bottom: 1px solid #FFE69C;">
                                            <td style="color: #000000; padding: 10px;">
                                                <strong>{{ $peminjaman->kode_peminjaman }}</strong>
                                            </td>
                                            <td style="color: #000000; padding: 10px;">
                                                <i class="fas fa-user-circle me-1" style="color: #FDB931;"></i>
                                                {{ $peminjaman->user->name }}
                                            </td>
                                            <td style="color: #000000; padding: 10px;">
                                                <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                                {{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}
                                            </td>
                                            <td style="padding: 10px;">
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
                                                @endphp
                                                <span class="badge" style="background-color: {{ $statusColors[$peminjaman->status] ?? '#6c757d' }}; color: {{ $statusTextColors[$peminjaman->status] ?? '#FFFFFF' }}; padding: 5px 10px;">
                                                    {{ ucfirst($peminjaman->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($alat->peminjamans->count() > 5)
                            <div class="text-center mt-3">
                                <small class="text-muted">Menampilkan 5 dari {{ $alat->peminjamans->count() }} peminjaman</small>
                            </div>
                            @endif
                            @else
                            <div class="alert-yellow text-center py-4">
                                <i class="fas fa-inbox fa-2x mb-2" style="color: #FDB931;"></i>
                                <p style="color: #000000; margin: 0;">Belum ada riwayat peminjaman</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Info Box Styling */
.info-box-yellow {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border-radius: 12px;
    border: 1px solid #FFE69C;
    display: flex;
    align-items: center;
    padding: 15px;
    transition: all 0.3s ease;
}

.info-box-yellow:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);
}

.info-box-icon-yellow {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-right: 15px;
}

.info-box-content {
    flex: 1;
}

.info-box-text {
    font-size: 12px;
    text-transform: uppercase;
    color: #6c757d;
    margin-bottom: 5px;
}

.info-box-number {
    font-size: 20px;
    font-weight: bold;
    color: #000000;
}

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

/* Riwayat Card */
.riwayat-card {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #FFE69C;
}

.riwayat-header {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    padding: 12px 20px;
    border-bottom: 2px solid #FFD700;
    font-weight: 600;
    color: #000000;
    display: flex;
    align-items: center;
}

.riwayat-body {
    padding: 20px;
}

/* No Image Placeholder */
.no-image-placeholder {
    padding: 60px 40px;
    background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%);
    border-radius: 12px;
    border: 2px dashed #FFD700;
    text-align: center;
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

/* Alert styling */
.alert-yellow {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    border-left: 4px solid #FFD700;
    color: #000000;
    border-radius: 8px;
    padding: 15px;
}

/* Table hover effect */
.table-hover-yellow tbody tr:hover {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFF3CD 100%);
    transition: all 0.3s ease;
}

/* Text utilities */
.text-muted {
    color: #6c757d !important;
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

.mb-2 {
    margin-bottom: 8px;
}

.mb-3 {
    margin-bottom: 15px;
}

.mb-4 {
    margin-bottom: 20px;
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

.py-4 {
    padding-top: 20px;
    padding-bottom: 20px;
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
    
    .riwayat-header {
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
    }
    
    .info-box-yellow {
        padding: 10px;
    }
    
    .info-box-icon-yellow {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .info-box-number {
        font-size: 16px;
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