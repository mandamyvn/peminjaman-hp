@extends('layouts.app')

@section('title', 'Peminjaman Saya')


<link rel="stylesheet" href="{{ asset('css/peminjam.css') }}">

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


@endsection
