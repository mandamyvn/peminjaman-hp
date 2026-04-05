@extends('layouts.app')

@section('title', 'Manajemen Pengembalian')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Peminjaman Aktif -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                    <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                        <i class="fas fa-clock me-2"></i> Peminjaman Aktif (Belum Dikembalikan)
                    </h3>
                </div>
                <div class="card-body">
                    @if($peminjamans->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover" style="border-collapse: separate; border-spacing: 0;">
                            <thead style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);">
                                <tr>
                                    <th style="color: #000000; border: none; padding: 12px;">Kode</th>
                                    <th style="color: #000000; border: none; padding: 12px;">Peminjam</th>
                                    <th style="color: #000000; border: none; padding: 12px;">Alat</th>
                                    <th style="color: #000000; border: none; padding: 12px;">Jumlah</th>
                                    <th style="color: #000000; border: none; padding: 12px;">Aksi</th>
                                 </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjamans as $peminjaman)
                                <tr style="border-bottom: 1px solid #FFE69C;">
                                    <td style="color: #000000; padding: 12px;">{{ $peminjaman->kode_peminjaman }}</td>
                                    <td style="color: #000000; padding: 12px;">{{ $peminjaman->user->name }}</td>
                                    <td style="color: #000000; padding: 12px;">{{ $peminjaman->alat->nama_alat }}</td>
                                    <td style="color: #000000; padding: 12px;">{{ $peminjaman->jumlah }}</td>
                                    <td style="padding: 12px;">
                                        <button type="button" class="btn btn-sm" data-toggle="modal" 
                                                data-target="#returnModal{{ $peminjaman->id }}"
                                                style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: none; border-radius: 8px; padding: 8px 16px; font-weight: 500; transition: all 0.3s ease;">
                                            <i class="fas fa-undo me-1"></i> Kembalikan
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Pengembalian -->
                                <div class="modal fade" id="returnModal{{ $peminjaman->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
                                            <div class="modal-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                                                <h5 class="modal-title" style="color: #000000; font-weight: 600;">
                                                    <i class="fas fa-undo me-2"></i> Proses Pengembalian
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" style="color: #000000;">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('petugas.pengembalian.store', $peminjaman) }}" method="POST">
                                                @csrf
                                                <div class="modal-body" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="info-box mb-3" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-radius: 8px; padding: 15px;">
                                                                <span class="info-box-icon" style="background: rgba(0,0,0,0.1); border-radius: 8px;">
                                                                    <i class="fas fa-info-circle" style="color: #000000;"></i>
                                                                </span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text" style="color: #000000; font-weight: 600;">Informasi Peminjaman</span>
                                                                    <small style="color: #000000;"><strong>Kode:</strong> {{ $peminjaman->kode_peminjaman }}</small><br>
                                                                    <small style="color: #000000;"><strong>Peminjam:</strong> {{ $peminjaman->user->name }}</small><br>
                                                                    <small style="color: #000000;"><strong>Alat:</strong> {{ $peminjaman->alat->nama_alat }}</small><br>
                                                                    <small style="color: #000000;"><strong>Jumlah:</strong> {{ $peminjaman->jumlah }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="info-box mb-3" style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-radius: 8px; padding: 15px;">
                                                                <span class="info-box-icon" style="background: rgba(0,0,0,0.1); border-radius: 8px;">
                                                                    <i class="fas fa-calculator" style="color: #000000;"></i>
                                                                </span>
                                                                <div class="info-box-content">
                                                                    <span class="info-box-text" style="color: #000000; font-weight: 600;">Perhitungan Sewa</span>
                                                                    @php
                                                                        $harga = $peminjaman->alat->harga_sewa_perhari;
                                                                        $tglKembali = $peminjaman->tanggal_kembali;
                                                                        $lama = $peminjaman->tanggal_pinjam->diffInDays($tglKembali);
                                                                        $totalSewa = $harga * $lama * $peminjaman->jumlah;
                                                                        $hariTerlambat = now()->gt($tglKembali) ? $tglKembali->diffInDays(now()) : 0;
                                                                        $dendaTerlambat = $hariTerlambat * 5000;
                                                                    @endphp
                                                                    <small style="color: #000000;"><strong>Harga/Hari:</strong> Rp {{ number_format($harga,0,',','.') }}</small><br>
                                                                    <small style="color: #000000;"><strong>Lama Sewa:</strong> {{ $lama }} Hari</small><br>
                                                                    <small style="color: #000000;"><strong>Total Sewa:</strong> Rp {{ number_format($totalSewa,0,',','.') }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr style="border-top-color: #FFD700;">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label style="color: #000000; font-weight: 500;">Tanggal Kembali *</label>
                                                                <input type="date" class="form-control" name="tanggal_kembali"
                                                                       value="{{ date('Y-m-d') }}" required
                                                                       style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label style="color: #000000; font-weight: 500;">Jumlah Kembali *</label>
                                                                <input type="number" class="form-control" name="jumlah_kembali"
                                                                       value="{{ $peminjaman->jumlah }}"
                                                                       min="1" max="{{ $peminjaman->jumlah }}" required
                                                                       style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label style="color: #000000; font-weight: 500;">Kondisi Alat *</label>
                                                                <select class="form-control" name="kondisi" required
                                                                        style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;">
                                                                    <option value="baik" style="color: #000000;">Baik</option>
                                                                    <option value="rusak_ringan" style="color: #000000;">Rusak Ringan</option>
                                                                    <option value="rusak_berat" style="color: #000000;">Rusak Berat</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label style="color: #000000; font-weight: 500;">Denda Keterlambatan</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: none;">Rp</span>
                                                                    </div>
                                                                    <input type="number" class="form-control" name="denda_terlambat"
                                                                           value="{{ $dendaTerlambat }}"
                                                                           style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label style="color: #000000; font-weight: 500;">Denda Kerusakan</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: none;">Rp</span>
                                                                    </div>
                                                                    <input type="number" class="form-control" name="denda_kerusakan"
                                                                           value="0"
                                                                           style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label style="color: #000000; font-weight: 500;">Total Denda</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: none;">Rp</span>
                                                                    </div>
                                                                    <input type="text" class="form-control" id="total_denda_{{ $peminjaman->id }}"
                                                                           value="0" readonly
                                                                           style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px; background: #FFF9E6;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label style="color: #000000; font-weight: 500;">Keterangan</label>
                                                        <textarea class="form-control" name="keterangan" rows="3"
                                                                  style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%); border-top: 1px solid #FFE69C;">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; padding: 10px 20px;">Batal</button>
                                                    <button type="submit" class="btn" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 500;">
                                                        <i class="fas fa-save me-1"></i> Simpan Pengembalian
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                // Auto calculate total denda
                                document.addEventListener('DOMContentLoaded', function() {
                                    const dendaTerlambatInput = document.querySelector('#returnModal{{ $peminjaman->id }} input[name="denda_terlambat"]');
                                    const dendaKerusakanInput = document.querySelector('#returnModal{{ $peminjaman->id }} input[name="denda_kerusakan"]');
                                    const totalDendaInput = document.querySelector('#total_denda_{{ $peminjaman->id }}');
                                    
                                    function calculateTotal() {
                                        let dendaTerlambat = parseInt(dendaTerlambatInput.value) || 0;
                                        let dendaKerusakan = parseInt(dendaKerusakanInput.value) || 0;
                                        let total = dendaTerlambat + dendaKerusakan;
                                        totalDendaInput.value = total.toLocaleString('id-ID');
                                    }
                                    
                                    dendaTerlambatInput.addEventListener('input', calculateTotal);
                                    dendaKerusakanInput.addEventListener('input', calculateTotal);
                                    calculateTotal();
                                });
                                </script>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 4px solid #28a745; color: #000000;">
                        <i class="fas fa-check-circle me-2"></i> Semua peminjaman telah dikembalikan.
                    </div>
                    @endif
                </div>
                <div class="card-footer" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-top: 1px solid #FFE69C;">
                    <small style="color: #000000;"><i class="fas fa-chart-line me-1"></i> Total: {{ $peminjamans->total() }} peminjaman aktif</small>
                </div>
            </div>
        </div>

        <!-- Riwayat Pengembalian -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                    <h3 class="card-title" style="color: #000000 !important; font-weight: 600;">
                        <i class="fas fa-history me-2"></i> Riwayat Pengembalian
                    </h3>
                </div>
                <div class="card-body">
                    @if($pengembalians->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover" style="border-collapse: separate; border-spacing: 0;">
                            <thead style="background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);">
                                32
                                    <th style="color: #000000; border: none; padding: 12px;">Peminjaman</th>
                                    <th style="color: #000000; border: none; padding: 12px;">Tanggal</th>
                                    <th style="color: #000000; border: none; padding: 12px;">Kondisi</th>
                                    <th style="color: #000000; border: none; padding: 12px;">Denda</th>
                                    <th style="color: #000000; border: none; padding: 12px;">Aksi</th>
                                 </tr>
                            </thead>
                            <tbody>
                                @foreach($pengembalians as $pengembalian)
                                <tr style="border-bottom: 1px solid #FFE69C;">
                                    <td style="color: #000000; padding: 12px;">
                                        <strong>{{ $pengembalian->peminjaman->kode_peminjaman }}</strong><br>
                                        <small style="color: #666;">{{ $pengembalian->peminjaman->user->name }}</small>
                                    </td>
                                    <td style="color: #000000; padding: 12px;">
                                        {{ $pengembalian->tanggal_kembali->format('d/m/Y') }}<br>
                                        <small style="color: #666;">{{ $pengembalian->created_at->format('H:i') }}</small>
                                    </td>
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
                                    <td style="color: #000000; padding: 12px;">
                                        <strong>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</strong>
                                    </td>
                                    <td style="padding: 12px;">
                                        <a href="{{ route('petugas.pengembalian.struk', $pengembalian->id) }}"
                                           class="btn btn-sm"
                                           target="_blank"
                                           style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 8px 16px; transition: all 0.3s ease;">
                                            <i class="fas fa-print me-1"></i> Cetak Struk
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 4px solid #17a2b8; color: #000000;">
                        <i class="fas fa-info-circle me-2"></i> Belum ada riwayat pengembalian.
                    </div>
                    @endif
                </div>
                <div class="card-footer" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-top: 1px solid #FFE69C;">
                    <small style="color: #000000;"><i class="fas fa-chart-line me-1"></i> Total: {{ $pengembalians->total() }} pengembalian</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Card styling */
.card {
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(255, 215, 0, 0.2) !important;
}

/* Button hover effects */
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.btn:active {
    transform: translateY(0);
}

/* Form control styling */
.form-control:focus {
    border-color: #FDB931;
    box-shadow: 0 0 0 0.2rem rgba(253, 185, 49, 0.25);
}

/* Table hover effect */
.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFF3CD 100%);
    transition: all 0.3s ease;
}

/* Modal styling */
.modal-content {
    border-radius: 12px;
    overflow: hidden;
}

.modal-header {
    padding: 15px 20px;
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    padding: 15px 20px;
}

/* Info box styling */
.info-box {
    transition: all 0.3s ease;
}

.info-box:hover {
    transform: scale(1.02);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .btn-sm {
        padding: 6px 12px !important;
        font-size: 12px;
    }
    
    .table td, .table th {
        padding: 8px !important;
    }
    
    .modal-dialog {
        margin: 10px;
    }
}

/* Badge styling */
.badge {
    font-weight: 500;
}

/* Alert styling */
.alert {
    border-radius: 8px;
    padding: 15px;
}

/* Scrollbar styling */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #FFF9E6;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #FDB931 0%, #FFD700 100%);
}
</style>

<script>
// Auto calculate total denda for all modals
document.addEventListener('DOMContentLoaded', function() {
    // Find all modals and set up auto calculation
    const modals = document.querySelectorAll('[id^="returnModal"]');
    modals.forEach(modal => {
        const dendaTerlambatInput = modal.querySelector('input[name="denda_terlambat"]');
        const dendaKerusakanInput = modal.querySelector('input[name="denda_kerusakan"]');
        const totalDendaInput = modal.querySelector('[id^="total_denda_"]');
        
        if (dendaTerlambatInput && dendaKerusakanInput && totalDendaInput) {
            function calculateTotal() {
                let dendaTerlambat = parseInt(dendaTerlambatInput.value) || 0;
                let dendaKerusakan = parseInt(dendaKerusakanInput.value) || 0;
                let total = dendaTerlambat + dendaKerusakan;
                totalDendaInput.value = total.toLocaleString('id-ID');
            }
            
            dendaTerlambatInput.addEventListener('input', calculateTotal);
            dendaKerusakanInput.addEventListener('input', calculateTotal);
            calculateTotal();
        }
    });
});
</script>
@endsection