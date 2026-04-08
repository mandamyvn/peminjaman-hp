@extends('layouts.app')

@section('title', 'Detail Pengembalian')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-info-circle me-2"></i> Detail Pengembalian #{{ $pengembalian->id }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.pengembalian.edit', $pengembalian) }}" class="btn-yellow btn-sm" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('admin.pengembalian.index') }}" class="btn-yellow btn-sm ms-1" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: #FFFFFF;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="info-detail-card">
                        <div class="info-detail-header">
                            <i class="fas fa-undo-alt me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Pengembalian</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-hashtag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>ID Pengembalian</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">#{{ $pengembalian->id }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-check" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Tanggal Kembali</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                    {{ $pengembalian->tanggal_kembali->format('d/m/Y') }}
                                    <small class="text-muted ms-2">({{ $pengembalian->tanggal_kembali->diffForHumans() }})</small>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-cube" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Jumlah Kembali</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">
                                        <i class="fas fa-box me-1"></i> {{ $pengembalian->jumlah_kembali }} Unit
                                    </span>
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
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-money-bill" style="color: #dc3545; width: 30px;"></i>
                                    <strong>Denda</strong>
                                </div>
                                <div class="info-value-detail">
                                    @if($pengembalian->denda > 0)
                                    <strong class="text-danger">
                                        <i class="fas fa-money-bill me-1"></i>
                                        Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                                    </strong>
                                    @else
                                    <span class="text-success">
                                        <i class="fas fa-check-circle me-1"></i>
                                        Tidak Ada Denda
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            @if($pengembalian->keterangan)
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-comment" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Keterangan</strong>
                                </div>
                                <div class="info-value-detail">
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                        {{ $pengembalian->keterangan }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-user-check" style="color: #28a745; width: 30px;"></i>
                                    <strong>Diterima Oleh</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-user-check me-1" style="color: #28a745;"></i>
                                    {{ $pengembalian->diterimaOleh->name }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-plus" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Dibuat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                    {{ $pengembalian->created_at->format('d/m/Y H:i') }}
                                    <small class="text-muted ms-2">({{ $pengembalian->created_at->diffForHumans() }})</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="info-detail-card">
                        <div class="info-detail-header">
                            <i class="fas fa-handshake me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Peminjaman</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-qrcode" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Kode Peminjaman</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">{{ $pengembalian->peminjaman->kode_peminjaman }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-user" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Peminjam</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-user-circle me-1" style="color: #FDB931;"></i>
                                    {{ $pengembalian->peminjaman->user->name }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-envelope" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Email Peminjam</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-envelope me-1" style="color: #FDB931;"></i>
                                    {{ $pengembalian->peminjaman->user->email }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-laptop" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Alat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-laptop me-1" style="color: #FDB931;"></i>
                                    {{ $pengembalian->peminjaman->alat->nama_alat }}
                                    <br>
                                    <small class="text-muted">Kode: {{ $pengembalian->peminjaman->alat->kode_alat }}</small>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-alt" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Tanggal Pinjam</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                    {{ $pengembalian->peminjaman->tanggal_pinjam->format('d/m/Y') }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-check" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Tanggal Harus Kembali</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                    {{ $pengembalian->peminjaman->tanggal_kembali->format('d/m/Y') }}
                                    @if($pengembalian->tanggal_kembali > $pengembalian->peminjaman->tanggal_kembali)
                                    <span class="badge ms-2" style="background: #dc3545; color: #FFFFFF;">
                                        <i class="fas fa-exclamation-triangle me-1"></i> Terlambat
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-cube" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Jumlah Dipinjam</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">
                                        <i class="fas fa-box me-1"></i> {{ $pengembalian->peminjaman->jumlah }} Unit
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
                                        {{ $pengembalian->peminjaman->keperluan }}
                                    </div>
                                </div>
                            </div>
                            
                            @if($pengembalian->peminjaman->catatan_admin)
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-sticky-note" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Catatan Admin</strong>
                                </div>
                                <div class="info-value-detail">
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                        {{ $pengembalian->peminjaman->catatan_admin }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @php
                $lambat = $pengembalian->tanggal_kembali > $pengembalian->peminjaman->tanggal_kembali;
            @endphp
            
            @if($lambat && $pengembalian->denda > 0)
            <div class="row mt-2">
                <div class="col-12">
                    <div class="alert-yellow">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Informasi:</strong> Pengembalian terlambat dari jadwal yang ditentukan. Denda telah dikenakan sesuai peraturan.
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection

