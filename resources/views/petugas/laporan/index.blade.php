@extends('layouts.app')

@section('title', 'Laporan')

<link rel="stylesheet" href="{{ asset('css/petugas.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
        <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
            <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                <i class="fas fa-chart-line me-2"></i> Laporan Peminjaman dan Pengembalian
            </h3>
        </div>
        <div class="card-body">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('petugas.laporan.index') }}" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="start_date" style="color: #000000; font-weight: 500;">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                   value="{{ $start_date }}"
                                   style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="end_date" style="color: #000000; font-weight: 500;">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="{{ $end_date }}"
                                   style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color: #000000; font-weight: 500;">&nbsp;</label>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 500; transition: all 0.3s ease;">
                                    <i class="fas fa-filter me-2"></i> Filter
                                </button>
                                <button type="button" class="btn" onclick="cetakLaporan('peminjaman')" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 500; transition: all 0.3s ease;">
                                    <i class="fas fa-print me-2"></i> Cetak Peminjaman
                                </button>
                                <button type="button" class="btn" onclick="cetakLaporan('pengembalian')" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 500; transition: all 0.3s ease;">
                                    <i class="fas fa-print me-2"></i> Cetak Pengembalian
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Statistik -->
            <div class="row mb-4 g-4">
                <div class="col-md-4">
                    <div class="info-box rounded-3 shadow-sm" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border: none;">
                        <span class="info-box-icon" style="background: rgba(0,0,0,0.1); border-radius: 12px;">
                            <i class="fas fa-handshake" style="color: #000000;"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text" style="color: #000000; font-weight: 500;">Total Peminjaman</span>
                            <span class="info-box-number" style="color: #000000; font-size: 28px; font-weight: bold;">{{ $total_peminjaman }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box rounded-3 shadow-sm" style="background: linear-gradient(135deg, #FFE55C 0%, #FFD700 100%); border: none;">
                        <span class="info-box-icon" style="background: rgba(0,0,0,0.1); border-radius: 12px;">
                            <i class="fas fa-undo" style="color: #000000;"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text" style="color: #000000; font-weight: 500;">Total Pengembalian</span>
                            <span class="info-box-number" style="color: #000000; font-size: 28px; font-weight: bold;">{{ $total_pengembalian }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box rounded-3 shadow-sm" style="background: linear-gradient(135deg, #FFD966 0%, #FFC107 100%); border: none;">
                        <span class="info-box-icon" style="background: rgba(0,0,0,0.1); border-radius: 12px;">
                            <i class="fas fa-money-bill" style="color: #000000;"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text" style="color: #000000; font-weight: 500;">Total Denda</span>
                            <span class="info-box-number" style="color: #000000; font-size: 28px; font-weight: bold;">Rp {{ number_format($total_denda, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" style="border-bottom: 2px solid #FFD700;">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab_peminjaman" data-toggle="tab" style="color: #000000; font-weight: 500; border: none; border-bottom: 2px solid transparent; transition: all 0.3s ease;">
                            <i class="fas fa-handshake me-2"></i> Peminjaman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_pengembalian" data-toggle="tab" style="color: #000000; font-weight: 500; border: none; border-bottom: 2px solid transparent; transition: all 0.3s ease;">
                            <i class="fas fa-undo me-2"></i> Pengembalian
                        </a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <!-- Tab Peminjaman -->
                    <div class="tab-pane active" id="tab_peminjaman">
                        <div class="table-responsive">
                            <table class="table table-hover" style="border-collapse: separate; border-spacing: 0;">
                                <thead style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);">
                                    <tr>
                                        <th style="color: #000000; border: none; padding: 12px;">Kode</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Peminjam</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Alat</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Tanggal Pinjam</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Tanggal Kembali</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Jumlah</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($peminjamans as $peminjaman)
                                    <tr style="border-bottom: 1px solid #FFE69C;">
                                        <td style="color: #000000; padding: 12px;">{{ $peminjaman->kode_peminjaman }}</td>
                                        <td style="color: #000000; padding: 12px;">{{ $peminjaman->user->name }}</td>
                                        <td style="color: #000000; padding: 12px;">{{ $peminjaman->alat->nama_alat }}</td>
                                        <td style="color: #000000; padding: 12px;">{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                                        <td style="color: #000000; padding: 12px;">{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</td>
                                        <td style="color: #000000; padding: 12px;">{{ $peminjaman->jumlah }}</td>
                                        <td style="padding: 12px;">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'disetujui' => 'success',
                                                    'ditolak' => 'danger',
                                                    'dipinjam' => 'info',
                                                    'selesai' => 'secondary'
                                                ];
                                                $statusTextColors = [
                                                    'warning' => '#000000',
                                                    'success' => '#FFFFFF',
                                                    'danger' => '#FFFFFF',
                                                    'info' => '#FFFFFF',
                                                    'secondary' => '#FFFFFF'
                                                ];
                                                $badgeColor = $statusColors[$peminjaman->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge" style="background-color: {{ $badgeColor == 'warning' ? '#FFD700' : ($badgeColor == 'success' ? '#28a745' : ($badgeColor == 'danger' ? '#dc3545' : ($badgeColor == 'info' ? '#17a2b8' : '#6c757d'))) }}; color: {{ $statusTextColors[$badgeColor] ?? '#FFFFFF' }}; padding: 6px 12px; border-radius: 6px;">
                                                {{ $peminjaman->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center" style="color: #000000; padding: 40px;">
                                            <i class="fas fa-inbox fa-3x mb-3" style="color: #FFD700;"></i><br>
                                            Tidak ada data peminjaman
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $peminjamans->links() }}
                        </div>
                    </div>

                    <!-- Tab Pengembalian -->
                    <div class="tab-pane" id="tab_pengembalian">
                        <div class="table-responsive">
                            <table class="table table-hover" style="border-collapse: separate; border-spacing: 0;">
                                <thead style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);">
                                    <tr>
                                        <th style="color: #000000; border: none; padding: 12px;">ID</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Peminjaman</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Tanggal Kembali</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Jumlah Kembali</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Kondisi</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Denda</th>
                                        <th style="color: #000000; border: none; padding: 12px;">Diterima Oleh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pengembalians as $pengembalian)
                                    <tr style="border-bottom: 1px solid #FFE69C;">
                                        <td style="color: #000000; padding: 12px;">{{ $pengembalian->id }}</td>
                                        <td style="color: #000000; padding: 12px;">{{ $pengembalian->peminjaman->kode_peminjaman }}</td>
                                        <td style="color: #000000; padding: 12px;">{{ $pengembalian->tanggal_kembali->format('d/m/Y') }}</td>
                                        <td style="color: #000000; padding: 12px;">{{ $pengembalian->jumlah_kembali }}</td>
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
                                            @endphp
                                            <span class="badge" style="background-color: {{ $kondisiColors[$pengembalian->kondisi] ?? '#6c757d' }}; color: {{ $kondisiTextColors[$pengembalian->kondisi] ?? '#FFFFFF' }}; padding: 6px 12px; border-radius: 6px;">
                                                {{ $pengembalian->kondisi }}
                                            </span>
                                        </td>
                                        <td style="color: #000000; padding: 12px;">Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</td>
                                        <td style="color: #000000; padding: 12px;">{{ $pengembalian->diterimaOleh->name }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center" style="color: #000000; padding: 40px;">
                                            <i class="fas fa-inbox fa-3x mb-3" style="color: #FFD700;"></i><br>
                                            Tidak ada data pengembalian
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $pengembalians->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
function cetakLaporan(type) {
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    
    var url = "{{ route('petugas.laporan.cetak') }}?type=" + type;
    
    if (start_date) {
        url += "&start_date=" + start_date;
    }
    
    if (end_date) {
        url += "&end_date=" + end_date;
    }
    
    window.open(url, '_blank');
}
</script>
@endsection