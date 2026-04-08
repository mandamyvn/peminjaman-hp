@extends('layouts.app')

@section('title', 'Manajemen Peminjaman')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

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

</style>
@endsection

