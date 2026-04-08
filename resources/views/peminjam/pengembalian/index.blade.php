@extends('layouts.app')

@section('title', 'Pengembalian Alat')

<link rel="stylesheet" href="{{ asset('css/peminjam.css') }}">

@section('content')
<div class="container-fluid">
    <!-- Peminjaman Aktif -->
    @if($peminjamans->count() > 0)
    <div class="card-yellow mb-4">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-clock me-2"></i> Peminjaman Aktif (Harus Dikembalikan)
            </h3>
            <div class="card-tools">
                <span class="badge-yellow">
                    <i class="fas fa-chart-line me-1"></i> Total: {{ $peminjamans->count() }}
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover-yellow">
                    <thead class="table-header-yellow">
                        <tr>
                            <th style="color: #000000; padding: 12px;">Kode</th>
                            <th style="color: #000000; padding: 12px;">Alat</th>
                            <th style="color: #000000; padding: 12px;">Tanggal Pinjam</th>
                            <th style="color: #000000; padding: 12px;">Tanggal Kembali</th>
                            <th style="color: #000000; padding: 12px;">Jumlah</th>
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
                            <td style="padding: 12px;">
                                <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                {{ $peminjaman->tanggal_kembali->format('d/m/Y') }}
                                @if($peminjaman->tanggal_kembali < now())
                                <br>
                                <span class="badge" style="background: #dc3545; color: #FFFFFF; padding: 4px 8px; margin-top: 5px;">
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
                                <button type="button" class="btn-yellow btn-sm" data-toggle="modal" 
                                        data-target="#returnModal{{ $peminjaman->id }}">
                                    <i class="fas fa-undo me-1"></i> Ajukan Pengembalian
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Pengembalian -->
                        <div class="modal fade" id="returnModal{{ $peminjaman->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
                                    <div class="modal-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                                        <h5 class="modal-title" style="color: #000000; font-weight: 600;">
                                            <i class="fas fa-undo me-2"></i> Ajukan Pengembalian
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" style="color: #000000;">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('peminjam.pengembalian.store', $peminjaman) }}" method="POST">
                                        @csrf
                                        <div class="modal-body" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                                            <div class="alert-yellow mb-3">
                                                <i class="fas fa-info-circle me-2"></i>
                                                Anda akan mengajukan pengembalian untuk peminjaman:
                                            </div>
                                            
                                            <div class="info-modal">
                                                <div class="info-modal-row">
                                                    <div class="info-modal-label">
                                                        <i class="fas fa-qrcode" style="color: #FDB931;"></i> Kode
                                                    </div>
                                                    <div class="info-modal-value">
                                                        <strong>{{ $peminjaman->kode_peminjaman }}</strong>
                                                    </div>
                                                </div>
                                                <div class="info-modal-row">
                                                    <div class="info-modal-label">
                                                        <i class="fas fa-laptop" style="color: #FDB931;"></i> Alat
                                                    </div>
                                                    <div class="info-modal-value">
                                                        {{ $peminjaman->alat->nama_alat }}
                                                    </div>
                                                </div>
                                                <div class="info-modal-row">
                                                    <div class="info-modal-label">
                                                        <i class="fas fa-box" style="color: #FDB931;"></i> Jumlah
                                                    </div>
                                                    <div class="info-modal-value">
                                                        {{ $peminjaman->jumlah }} Unit
                                                    </div>
                                                </div>
                                                <div class="info-modal-row">
                                                    <div class="info-modal-label">
                                                        <i class="fas fa-calendar-check" style="color: #FDB931;"></i> Tanggal Harus Kembali
                                                    </div>
                                                    <div class="info-modal-value">
                                                        {{ $peminjaman->tanggal_kembali->format('d/m/Y') }}
                                                        @if($peminjaman->tanggal_kembali < now())
                                                        <span class="badge ms-2" style="background: #dc3545; color: #FFFFFF;">
                                                            Terlambat
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @php
                                                    $hariTerlambat = now()->gt($peminjaman->tanggal_kembali) 
                                                        ? $peminjaman->tanggal_kembali->diffInDays(now()) 
                                                        : 0;
                                                    $denda = $hariTerlambat * 5000;
                                                @endphp
                                                @if($hariTerlambat > 0)
                                                <div class="info-modal-row highlight">
                                                    <div class="info-modal-label">
                                                        <i class="fas fa-money-bill" style="color: #dc3545;"></i> Denda Keterlambatan
                                                    </div>
                                                    <div class="info-modal-value">
                                                        <span class="text-danger">
                                                            <strong>Rp {{ number_format($denda,0,',','.') }}</strong>
                                                        </span>
                                                        <br>
                                                        <small class="text-muted">(Terlambat {{ $hariTerlambat }} hari x Rp 5.000)</small>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            
                                            <div class="alert-warning mt-3">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                <strong>Perhatian:</strong> Setelah mengajukan pengembalian, harap segera menyerahkan alat kepada petugas untuk verifikasi.
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%); border-top: 1px solid #FFE69C;">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                            <button type="submit" class="btn-yellow">
                                                <i class="fas fa-paper-plane me-1"></i> Ajukan Pengembalian
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="alert-yellow text-center mb-4 py-4">
        <i class="fas fa-check-circle fa-3x mb-2" style="color: #28a745;"></i>
        <h4 style="color: #000000;">Tidak Ada Peminjaman Aktif</h4>
        <p style="color: #666;">Semua peminjaman Anda sudah dikembalikan.</p>
        <a href="{{ route('peminjam.alat.index') }}" class="btn-yellow mt-2">
            <i class="fas fa-search me-1"></i> Pinjam Alat Lagi
        </a>
    </div>
    @endif

    <!-- Riwayat Pengembalian -->
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-history me-2"></i> Riwayat Pengembalian Saya
            </h3>
            <div class="card-tools">
                <span class="badge-yellow">
                    <i class="fas fa-chart-line me-1"></i> Total: {{ $peminjaman_selesai->total() }}
                </span>
            </div>
        </div>
        <div class="card-body">
            @if($peminjaman_selesai->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover-yellow">
                    <thead class="table-header-yellow">
                        
                            <th style="color: #000000; padding: 12px;">Kode</th>
                            <th style="color: #000000; padding: 12px;">Alat</th>
                            <th style="color: #000000; padding: 12px;">Tanggal Pinjam</th>
                            <th style="color: #000000; padding: 12px;">Tanggal Kembali</th>
                            <th style="color: #000000; padding: 12px;">Kondisi</th>
                            <th style="color: #000000; padding: 12px;">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman_selesai as $peminjaman)
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
                                @if($peminjaman->pengembalian)
                                <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                {{ $peminjaman->pengembalian->tanggal_kembali->format('d/m/Y') }}
                                @if($peminjaman->pengembalian->tanggal_kembali > $peminjaman->tanggal_kembali)
                                <br>
                                <span class="badge" style="background: #dc3545; color: #FFFFFF; margin-top: 5px;">
                                    Terlambat
                                </span>
                                @endif
                                @else
                                -
                                @endif
                            </td>
                            <td style="padding: 12px;">
                                @if($peminjaman->pengembalian)
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
                                        <i class="fas {{ $peminjaman->pengembalian->kondisi == 'baik' ? 'fa-check-circle' : ($peminjaman->pengembalian->kondisi == 'rusak_ringan' ? 'fa-exclamation-triangle' : 'fa-times-circle') }} me-1"></i>
                                        {{ ucfirst(str_replace('_', ' ', $peminjaman->pengembalian->kondisi)) }}
                                    </span>
                                @else
                                <span class="badge" style="background: #6c757d; color: #FFFFFF;">Menunggu</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">
                                @if($peminjaman->pengembalian && $peminjaman->pengembalian->denda > 0)
                                <span class="text-danger">
                                    <i class="fas fa-money-bill me-1"></i>
                                    <strong>Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</strong>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="fas fa-check-circle me-1"></i> Tidak Ada Denda
                                </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 d-flex justify-content-center">
                {{ $peminjaman_selesai->links() }}
            </div>
            @else
            <div class="alert-yellow text-center py-5">
                <i class="fas fa-inbox fa-4x mb-3" style="color: #FDB931;"></i>
                <h4 style="color: #000000;">Belum ada riwayat pengembalian</h4>
                <p style="color: #666;">Anda belum memiliki riwayat pengembalian alat.</p>
                <a href="{{ route('peminjam.alat.index') }}" class="btn-yellow mt-2">
                    <i class="fas fa-search me-1"></i> Pinjam Alat Sekarang
                </a>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection