@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-info-circle me-2"></i> Detail Peminjaman {{ $peminjaman->kode_peminjaman }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('peminjam.peminjaman.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="info-card">
                        <div class="info-card-header">
                            <i class="fas fa-file-alt me-2" style="color: #FDB931;"></i>
                            <h5 class="mb-0" style="color: #000000;">Informasi Peminjaman</h5>
                        </div>
                        <div class="info-card-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-qrcode" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Kode Peminjaman</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">{{ $peminjaman->kode_peminjaman }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-alt" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Tanggal Pinjam</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}
                                    <small class="text-muted ms-2">({{ $peminjaman->tanggal_pinjam->diffForHumans() }})</small>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-check" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Tanggal Kembali</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $peminjaman->tanggal_kembali->format('d/m/Y') }}
                                    @if(now()->gt($peminjaman->tanggal_kembali))
                                        <span class="badge" style="background: #dc3545; color: #FFFFFF; padding: 2px 8px; margin-left: 8px;">
                                            <i class="fas fa-exclamation-triangle me-1"></i> Terlambat
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-cube" style="color: #FDB931; width: 25px;"></i>
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
                                    <i class="fas fa-tag" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Status</strong>
                                </div>
                                <div class="info-value-detail">
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
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-comment" style="color: #FDB931; width: 25px;"></i>
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
                                    <i class="fas fa-sticky-note" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Catatan Admin</strong>
                                </div>
                                <div class="info-value-detail">
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-left: 3px solid {{ $peminjaman->status == 'ditolak' ? '#dc3545' : '#FFD700' }};">
                                        <i class="fas fa-info-circle me-1" style="color: #FDB931;"></i>
                                        {{ $peminjaman->catatan_admin }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="info-card">
                        <div class="info-card-header">
                            <i class="fas fa-laptop me-2" style="color: #FDB931;"></i>
                            <h5 class="mb-0" style="color: #000000;">Informasi Alat</h5>
                        </div>
                        <div class="info-card-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-tag" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Nama Alat</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $peminjaman->alat->nama_alat }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-barcode" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Kode Alat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">{{ $peminjaman->alat->kode_alat }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-list" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Kategori</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 4px 10px;">
                                        {{ $peminjaman->alat->kategori->nama_kategori }}
                                    </span>
                                </div>
                            </div>
                            
                            @if($peminjaman->alat->merk)
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-industry" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Merk</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $peminjaman->alat->merk }}
                                </div>
                            </div>
                            @endif
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-money-bill" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Harga Sewa / Hari</strong>
                                </div>
                                <div class="info-value-detail">
                                    <strong class="text-success">Rp {{ number_format($peminjaman->alat->harga_sewa_perhari,0,',','.') }}</strong>
                                </div>
                            </div>
                            
                            @php
                                $lama = $peminjaman->tanggal_pinjam->diffInDays($peminjaman->tanggal_kembali);
                                $total = $lama * $peminjaman->jumlah * $peminjaman->alat->harga_sewa_perhari;
                                $hariTerlambat = now()->gt($peminjaman->tanggal_kembali) 
                                    ? $peminjaman->tanggal_kembali->diffInDays(now()) 
                                    : 0;
                                $denda = $hariTerlambat * 5000;
                            @endphp
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-clock" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Lama Pinjam</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $lama }} Hari
                                </div>
                            </div>
                            
                            <div class="info-row-detail highlight">
                                <div class="info-label-detail">
                                    <i class="fas fa-calculator" style="color: #28a745; width: 25px;"></i>
                                    <strong>Total Biaya Sewa</strong>
                                </div>
                                <div class="info-value-detail">
                                    <strong class="text-success" style="font-size: 1.1rem;">
                                        Rp {{ number_format($total,0,',','.') }}
                                    </strong>
                                </div>
                            </div>
                            
                            @if($hariTerlambat > 0)
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-exclamation-triangle" style="color: #dc3545; width: 25px;"></i>
                                    <strong>Keterlambatan</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge" style="background: #dc3545; color: #FFFFFF;">
                                        Terlambat {{ $hariTerlambat }} Hari
                                    </span>
                                    <div class="mt-2">
                                        <small class="text-danger">
                                            <i class="fas fa-money-bill me-1"></i>
                                            Denda: Rp {{ number_format($denda,0,',','.') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @if($peminjaman->status == 'pending')
            <div class="alert-yellow mt-3 text-center">
                <i class="fas fa-clock fa-2x mb-2" style="color: #FDB931;"></i>
                <h5 style="color: #000000;">Menunggu Persetujuan</h5>
                <p style="color: #666;">Peminjaman Anda sedang diproses oleh petugas. Harap menunggu konfirmasi.</p>
            </div>
            @endif
            
            @if($peminjaman->status == 'disetujui')
            <div class="alert-yellow mt-3 text-center" style="border-left-color: #28a745;">
                <i class="fas fa-check-circle fa-2x mb-2" style="color: #28a745;"></i>
                <h5 style="color: #000000;">Peminjaman Disetujui</h5>
                <p style="color: #666;">Peminjaman Anda telah disetujui. Silakan ambil alat sesuai jadwal.</p>
            </div>
            @endif
            
            @if($peminjaman->status == 'dipinjam')
            <div class="alert-yellow mt-3 text-center" style="border-left-color: #17a2b8;">
                <i class="fas fa-handshake fa-2x mb-2" style="color: #17a2b8;"></i>
                <h5 style="color: #000000;">Alat Sedang Dipinjam</h5>
                <p style="color: #666;">Alat sedang Anda gunakan. Jangan lupa mengembalikan tepat waktu.</p>
                <a href="{{ route('peminjam.pengembalian.index') }}" class="btn-yellow mt-2">
                    <i class="fas fa-undo me-1"></i> Kembalikan Alat
                </a>
            </div>
            @endif
            
            @if($peminjaman->status == 'selesai')
            <div class="alert-yellow mt-3 text-center" style="border-left-color: #6c757d;">
                <i class="fas fa-check-double fa-2x mb-2" style="color: #6c757d;"></i>
                <h5 style="color: #000000;">Peminjaman Selesai</h5>
                <p style="color: #666;">Terima kasih telah menggunakan layanan peminjaman alat.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Info Card Styling */
.info-card {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #FFE69C;
    height: 100%;
}

.info-card-header {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    padding: 12px 20px;
    border-bottom: 2px solid #FFD700;
    display: flex;
    align-items: center;
}

.info-card-body {
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

.info-row-detail.highlight {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    margin: 0 -20px;
    padding: 12px 20px;
    border-radius: 8px;
}

.info-label-detail {
    width: 40%;
    font-weight: 500;
    color: #000000;
    display: flex;
    align-items: center;
}

.info-value-detail {
    width: 60%;
    color: #000000;
}

/* Badge Styling */
.badge-yellow {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    color: #000000;
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Alert Styling */
.alert-yellow {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    border-left: 4px solid #FFD700;
    border-radius: 12px;
    padding: 20px;
    transition: all 0.3s ease;
}

.alert-yellow:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.2);
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
    
    .info-card-header h5 {
        font-size: 16px;
    }
    
    .card-header-yellow {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .card-tools {
        justify-content: center;
    }
    
    .alert-yellow {
        padding: 15px;
    }
    
    .alert-yellow h5 {
        font-size: 16px;
    }
    
    .alert-yellow p {
        font-size: 13px;
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

/* Text styling */
.text-success {
    color: #28a745 !important;
}

.text-danger {
    color: #dc3545 !important;
}

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

.mt-2 {
    margin-top: 8px;
}

.mt-3 {
    margin-top: 15px;
}

.mb-0 {
    margin-bottom: 0;
}

.mb-2 {
    margin-bottom: 8px;
}

.mb-4 {
    margin-bottom: 20px;
}
</style>
@endsection