@extends('layouts.app')

@section('title', 'Manajemen Peminjaman')

<link rel="stylesheet" href="{{ asset('css/petugas.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
        <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
            <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                <i class="fas fa-handshake me-2"></i> Daftar Peminjaman
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-sm" style="background: rgba(0,0,0,0.1); color: #000000; border: none;" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="peminjamanTable" style="width: 100%;">
                    <thead style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);">
                        <tr>
                            <th style="color: #000000; border: none; padding: 12px;">No</th>
                            <th style="color: #000000; border: none; padding: 12px;">Kode</th>
                            <th style="color: #000000; border: none; padding: 12px;">Peminjam</th>
                            <th style="color: #000000; border: none; padding: 12px;">Alat</th>
                            <th style="color: #000000; border: none; padding: 12px;">Tanggal Pinjam</th>
                            <th style="color: #000000; border: none; padding: 12px;">Tanggal Kembali</th>
                            <th style="color: #000000; border: none; padding: 12px;">Jumlah</th>
                            <th style="color: #000000; border: none; padding: 12px;">Status</th>
                            <th style="color: #000000; border: none; padding: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $index => $peminjaman)
                        <tr style="border-bottom: 1px solid #FFE69C;">
                            <td style="color: #000000; padding: 12px;">{{ $index + 1 }}</td>
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
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 6px 12px; border-radius: 6px;">
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
                                    $badgeColor = $statusColors[$peminjaman->status] ?? '#6c757d';
                                    $textColor = $statusTextColors[$peminjaman->status] ?? '#FFFFFF';
                                @endphp
                                <span class="badge" style="background-color: {{ $badgeColor }}; color: {{ $textColor }}; padding: 6px 12px; border-radius: 6px;">
                                    <i class="fas {{ $peminjaman->status == 'pending' ? 'fa-clock' : ($peminjaman->status == 'disetujui' ? 'fa-check-circle' : ($peminjaman->status == 'dipinjam' ? 'fa-handshake' : 'fa-info-circle')) }} me-1"></i>
                                    {{ ucfirst($peminjaman->status) }}
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('petugas.peminjaman.show', $peminjaman) }}" class="btn btn-sm" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: none; border-radius: 6px; margin: 0 2px; padding: 8px 12px;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($peminjaman->status == 'pending')
                                    <button type="button" class="btn btn-sm" data-toggle="modal" 
                                            data-target="#approveModal{{ $peminjaman->id }}"
                                            style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; border: none; border-radius: 6px; margin: 0 2px; padding: 8px 12px;">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm" data-toggle="modal" 
                                            data-target="#rejectModal{{ $peminjaman->id }}"
                                            style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: #FFFFFF; border: none; border-radius: 6px; margin: 0 2px; padding: 8px 12px;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                    
                                    @if($peminjaman->status == 'disetujui')
                                    <form action="{{ route('petugas.peminjaman.borrowed', $peminjaman) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF; border: none; border-radius: 6px; margin: 0 2px; padding: 8px 12px;">
                                            <i class="fas fa-handshake"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Approve -->
                        <div class="modal fade" id="approveModal{{ $peminjaman->id }}" tabindex="-1">
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
                        <div class="modal fade" id="rejectModal{{ $peminjaman->id }}" tabindex="-1">
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
                        @empty
                        <tr>
                            <td colspan="9" class="text-center" style="color: #000000; padding: 40px;">
                                <i class="fas fa-inbox fa-3x mb-3" style="color: #FFD700;"></i><br>
                                Tidak ada data peminjaman
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>


<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#peminjamanTable').DataTable({
        responsive: true,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data per halaman",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
            },
            emptyTable: "Tidak ada data peminjaman",
            zeroRecords: "Data tidak ditemukan"
        },
        order: [[1, 'desc']], // Sort by kode descending
        columnDefs: [
            { orderable: false, targets: [8] } // Disable sorting on action column
        ],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]]
    });
    
    // Add styling to DataTables elements
    $('.dataTables_wrapper .dataTables_length select').addClass('form-control form-control-sm');
    $('.dataTables_wrapper .dataTables_filter input').addClass('form-control form-control-sm');
    $('.dataTables_wrapper .dataTables_paginate').addClass('pagination-sm');
});
</script>


@endsection