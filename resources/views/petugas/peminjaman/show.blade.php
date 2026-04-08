@extends('layouts.app')

@section('title', 'Detail Peminjaman')

<link rel="stylesheet" href="{{ asset('css/petugas.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
        <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
            <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                <i class="fas fa-info-circle me-2"></i> Detail Peminjaman: {{ $peminjaman->kode_peminjaman }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-sm" style="background: rgba(0,0,0,0.1); color: #000000; border: none; border-radius: 8px; padding: 8px 16px; transition: all 0.3s ease;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                        <div class="card-header" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-bottom: 2px solid #FFD700;">
                            <h5 class="card-title mb-0" style="color: #000000; font-weight: 600;">
                                <i class="fas fa-file-alt me-2" style="color: #FDB931;"></i> Informasi Peminjaman
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless" style="margin-bottom: 0;">
                                <tr>
                                    <th width="40%" style="color: #000000; padding: 8px 0;">Kode Peminjaman</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <strong>{{ $peminjaman->kode_peminjaman }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">Tanggal Pinjam</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                        {{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">Tanggal Kembali</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                        {{ $peminjaman->tanggal_kembali->format('d/m/Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">Jumlah</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 6px 12px; border-radius: 6px;">
                                            <i class="fas fa-box me-1"></i> {{ $peminjaman->jumlah }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">Status</th>
                                    <td style="padding: 8px 0;">
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
                                            $badgeColor = $statusColors[$peminjaman->status] ?? '#6c757d';
                                            $textColor = $statusTextColors[$peminjaman->status] ?? '#FFFFFF';
                                        @endphp
                                        <span class="badge" style="background-color: {{ $badgeColor }}; color: {{ $textColor }}; padding: 6px 12px; border-radius: 6px;">
                                            <i class="fas {{ $peminjaman->status == 'pending' ? 'fa-clock' : ($peminjaman->status == 'disetujui' ? 'fa-check-circle' : ($peminjaman->status == 'dipinjam' ? 'fa-handshake' : 'fa-info-circle')) }} me-1"></i>
                                            {{ ucfirst($peminjaman->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">Keperluan</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                            {{ $peminjaman->keperluan }}
                                        </div>
                                    </td>
                                </tr>
                                @if($peminjaman->catatan_admin)
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">Catatan Admin</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                            <i class="fas fa-sticky-note me-1" style="color: #FDB931;"></i>
                                            {{ $peminjaman->catatan_admin }}
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                        <div class="card-header" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-bottom: 2px solid #FFD700;">
                            <h5 class="card-title mb-0" style="color: #000000; font-weight: 600;">
                                <i class="fas fa-user me-2" style="color: #FDB931;"></i> Informasi Peminjam
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless" style="margin-bottom: 0;">
                                <tr>
                                    <th width="40%" style="color: #000000; padding: 8px 0;">Nama Peminjam</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <i class="fas fa-user-circle me-1" style="color: #FDB931;"></i>
                                        {{ $peminjaman->user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">Email</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <i class="fas fa-envelope me-1" style="color: #FDB931;"></i>
                                        {{ $peminjaman->user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">NIM</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <i class="fas fa-id-card me-1" style="color: #FDB931;"></i>
                                        {{ $peminjaman->user->nim ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">No HP</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <i class="fas fa-phone me-1" style="color: #FDB931;"></i>
                                        {{ $peminjaman->user->no_hp ?? '-' }}
                                    </td>
                                </tr>
                                @if($peminjaman->disetujuiOleh)
                                <tr>
                                    <th style="color: #000000; padding: 8px 0;">Disetujui Oleh</th>
                                    <td style="color: #000000; padding: 8px 0;">
                                        <i class="fas fa-user-check me-1" style="color: #28a745;"></i>
                                        {{ $peminjaman->disetujuiOleh->name }}
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                        <div class="card-header" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-bottom: 2px solid #FFD700;">
                            <h5 class="card-title mb-0" style="color: #000000; font-weight: 600;">
                                <i class="fas fa-laptop me-2" style="color: #FDB931;"></i> Informasi Alat
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless" style="margin-bottom: 0;">
                                        <tr>
                                            <th width="40%" style="color: #000000; padding: 8px 0;">Nama Alat</th>
                                            <td style="color: #000000; padding: 8px 0;">
                                                <i class="fas fa-tag me-1" style="color: #FDB931;"></i>
                                                {{ $peminjaman->alat->nama_alat }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="color: #000000; padding: 8px 0;">Kode Alat</th>
                                            <td style="color: #000000; padding: 8px 0;">
                                                <strong>{{ $peminjaman->alat->kode_alat }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="color: #000000; padding: 8px 0;">Kategori</th>
                                            <td style="color: #000000; padding: 8px 0;">
                                                <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 6px 12px; border-radius: 6px;">
                                                    {{ $peminjaman->alat->kategori->nama_kategori }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="color: #000000; padding: 8px 0;">Merk</th>
                                            <td style="color: #000000; padding: 8px 0;">{{ $peminjaman->alat->merk ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless" style="margin-bottom: 0;">
                                        <tr>
                                            <th width="40%" style="color: #000000; padding: 8px 0;">Spesifikasi</th>
                                            <td style="color: #000000; padding: 8px 0;">{{ $peminjaman->alat->spesifikasi ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th style="color: #000000; padding: 8px 0;">Harga Sewa / Hari</th>
                                            <td style="color: #000000; padding: 8px 0;">
                                                <strong class="text-success">Rp {{ number_format($peminjaman->alat->harga_sewa_perhari,0,',','.') }}</strong>
                                            </td>
                                        </tr>
                                        @php
                                            $lamaHari = $peminjaman->tanggal_pinjam->diffInDays($peminjaman->tanggal_kembali);
                                            $totalHarga = $lamaHari * $peminjaman->jumlah * $peminjaman->alat->harga_sewa_perhari;
                                        @endphp
                                        <tr>
                                            <th style="color: #000000; padding: 8px 0;">Lama Pinjam</th>
                                            <td style="color: #000000; padding: 8px 0;">
                                                <i class="fas fa-clock me-1" style="color: #FDB931;"></i>
                                                {{ $lamaHari }} Hari
                                            </td>
                                        </tr>
                                        <tr style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);">
                                            <th style="color: #000000; padding: 12px 8px; font-weight: 600;">Total Biaya</th>
                                            <td style="color: #000000; padding: 12px 8px;">
                                                <strong class="text-success" style="font-size: 1.2rem;">
                                                    Rp {{ number_format($totalHarga,0,',','.') }}
                                                </strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($peminjaman->status == 'pending')
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                        <div class="card-header" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-bottom: 2px solid #FFD700;">
                            <h5 class="card-title mb-0" style="color: #000000; font-weight: 600;">
                                <i class="fas fa-gavel me-2" style="color: #FDB931;"></i> Aksi Peminjaman
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn" data-toggle="modal" 
                                        data-target="#approveModal"
                                        style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 500; transition: all 0.3s ease;">
                                    <i class="fas fa-check me-2"></i> Setujui Peminjaman
                                </button>
                                <button type="button" class="btn" data-toggle="modal" 
                                        data-target="#rejectModal"
                                        style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 500; transition: all 0.3s ease;">
                                    <i class="fas fa-times me-2"></i> Tolak Peminjaman
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Approve -->
            <div class="modal fade" id="approveModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
                        <div class="modal-header" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                            <h5 class="modal-title" style="color: #FFFFFF; font-weight: 600;">
                                <i class="fas fa-check-circle me-2"></i> Setujui Peminjaman
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" style="color: #FFFFFF;">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('petugas.peminjaman.approve', $peminjaman) }}" method="POST">
                            @csrf
                            <div class="modal-body" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                                <div class="alert" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-left: 4px solid #28a745;">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Setujui peminjaman <strong>{{ $peminjaman->kode_peminjaman }}</strong>?
                                </div>
                                <div class="form-group">
                                    <label style="color: #000000; font-weight: 500;">Catatan (Opsional)</label>
                                    <textarea class="form-control" name="catatan_admin" rows="3" 
                                              style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%); border-top: 1px solid #FFE69C;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; border-radius: 8px;">
                                    <i class="fas fa-check me-1"></i> Setujui
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Reject -->
            <div class="modal fade" id="rejectModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
                        <div class="modal-header" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                            <h5 class="modal-title" style="color: #FFFFFF; font-weight: 600;">
                                <i class="fas fa-times-circle me-2"></i> Tolak Peminjaman
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" style="color: #FFFFFF;">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('petugas.peminjaman.reject', $peminjaman) }}" method="POST">
                            @csrf
                            <div class="modal-body" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                                <div class="alert" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-left: 4px solid #dc3545;">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Tolak peminjaman <strong>{{ $peminjaman->kode_peminjaman }}</strong>?
                                </div>
                                <div class="form-group">
                                    <label style="color: #000000; font-weight: 500;">Alasan Penolakan *</label>
                                    <textarea class="form-control" name="catatan_admin" rows="3" required
                                              style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%); border-top: 1px solid #FFE69C;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: #FFFFFF; border-radius: 8px;">
                                    <i class="fas fa-times me-1"></i> Tolak
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection