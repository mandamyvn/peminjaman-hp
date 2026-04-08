@extends('layouts.app')

@section('title', 'Manajemen Pengembalian')

<link rel="stylesheet" href="{{ asset('css/petugas.css') }}">

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
                                        <button type="button" class="btn btn-sm btn-return" 
                                                data-id="{{ $peminjaman->id }}"
                                                data-kode="{{ $peminjaman->kode_peminjaman }}"
                                                data-peminjam="{{ $peminjaman->user->name }}"
                                                data-alat="{{ $peminjaman->alat->nama_alat }}"
                                                data-jumlah="{{ $peminjaman->jumlah }}"
                                                data-harga="{{ $peminjaman->alat->harga_sewa_perhari }}"
                                                data-tanggal_kembali="{{ $peminjaman->tanggal_kembali }}"
                                                data-tanggal_pinjam="{{ $peminjaman->tanggal_pinjam }}"
                                                data-lama_sewa="{{ $peminjaman->tanggal_pinjam->diffInDays($peminjaman->tanggal_kembali) }}"
                                                data-total_sewa="{{ $peminjaman->alat->harga_sewa_perhari * $peminjaman->tanggal_pinjam->diffInDays($peminjaman->tanggal_kembali) * $peminjaman->jumlah }}"
                                                style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: none; border-radius: 8px; padding: 8px 16px; font-weight: 500; transition: all 0.3s ease;">
                                            <i class="fas fa-undo me-1"></i> Kembalikan
                                        </button>
                                    </td>
                                </tr>
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
                                <tr>
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

<!-- Modal Container -->
<div id="modalContainer"></div>



<script>
// Script final yang sudah diperbaiki
(function() {
    'use strict';
    
    // Fungsi untuk membuat modal HTML dengan route yang benar
    function createModal(data) {
        const now = new Date().toISOString().split('T')[0];
        const tanggalKembali = new Date(data.tanggal_kembali);
        const hariTerlambat = new Date() > tanggalKembali ? 
            Math.floor((new Date() - tanggalKembali) / (1000 * 60 * 60 * 24)) : 0;
        const dendaTerlambat = hariTerlambat * 5000;
        
        // URL route yang benar dengan parameter peminjaman
        const storeUrl = "{{ route('petugas.pengembalian.store', ':id') }}".replace(':id', data.id);
        
        return `
            <div class="modal fade" id="returnModal${data.id}" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel${data.id}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
                        <div class="modal-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                            <h5 class="modal-title" style="color: #000000; font-weight: 600;" id="returnModalLabel${data.id}">
                                <i class="fas fa-undo me-2"></i> Proses Pengembalian
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #000000;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="${storeUrl}" method="POST" id="formReturn${data.id}">
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
                                                <small style="color: #000000;"><strong>Kode:</strong> ${data.kode}</small><br>
                                                <small style="color: #000000;"><strong>Peminjam:</strong> ${data.peminjam}</small><br>
                                                <small style="color: #000000;"><strong>Alat:</strong> ${data.alat}</small><br>
                                                <small style="color: #000000;"><strong>Jumlah:</strong> ${data.jumlah}</small>
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
                                                <small style="color: #000000;"><strong>Harga/Hari:</strong> Rp ${new Intl.NumberFormat('id-ID').format(data.harga)}</small><br>
                                                <small style="color: #000000;"><strong>Lama Sewa:</strong> ${data.lama_sewa} Hari</small><br>
                                                <small style="color: #000000;"><strong>Total Sewa:</strong> Rp ${new Intl.NumberFormat('id-ID').format(data.total_sewa)}</small>
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
                                                   value="${now}" required
                                                   style="border: 1px solid #FFD700; border-radius: 8px; padding: 10px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="color: #000000; font-weight: 500;">Jumlah Kembali *</label>
                                            <input type="number" class="form-control" name="jumlah_kembali"
                                                   value="${data.jumlah}"
                                                   min="1" max="${data.jumlah}" required
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
                                                <input type="number" class="form-control denda-terlambat" 
                                                       name="denda_terlambat"
                                                       value="${dendaTerlambat}"
                                                       data-id="${data.id}"
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
                                                <input type="number" class="form-control denda-kerusakan" 
                                                       name="denda_kerusakan"
                                                       value="0"
                                                       data-id="${data.id}"
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
                                                <input type="text" class="form-control total-denda" 
                                                       id="total_denda_${data.id}"
                                                       value="${dendaTerlambat}" readonly
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
        `;
    }
    
    // Fungsi untuk update total denda dengan debounce
    let timeoutId = null;
    function updateTotalDenda(id) {
        if (timeoutId) clearTimeout(timeoutId);
        
        timeoutId = setTimeout(() => {
            const modal = document.getElementById(`returnModal${id}`);
            if (!modal) return;
            
            const dendaTerlambat = modal.querySelector('.denda-terlambat');
            const dendaKerusakan = modal.querySelector('.denda-kerusakan');
            const totalDenda = modal.querySelector(`#total_denda_${id}`);
            
            if (dendaTerlambat && dendaKerusakan && totalDenda) {
                const terlambat = parseInt(dendaTerlambat.value) || 0;
                const kerusakan = parseInt(dendaKerusakan.value) || 0;
                totalDenda.value = terlambat + kerusakan;
            }
        }, 50);
    }
    
    // Event handler untuk tombol return
    function setupReturnButtons() {
        document.querySelectorAll('.btn-return').forEach(button => {
            button.removeEventListener('click', handleReturnClick);
            button.addEventListener('click', handleReturnClick);
        });
    }
    
    function handleReturnClick(e) {
        const button = e.currentTarget;
        
        // Ambil data dari atribut data-*
        const data = {
            id: button.getAttribute('data-id'),
            kode: button.getAttribute('data-kode'),
            peminjam: button.getAttribute('data-peminjam'),
            alat: button.getAttribute('data-alat'),
            jumlah: button.getAttribute('data-jumlah'),
            harga: button.getAttribute('data-harga'),
            tanggal_kembali: button.getAttribute('data-tanggal_kembali'),
            tanggal_pinjam: button.getAttribute('data-tanggal_pinjam'),
            lama_sewa: button.getAttribute('data-lama_sewa'),
            total_sewa: button.getAttribute('data-total_sewa')
        };
        
        if (!data.id) return;
        
        // Cek apakah modal sudah ada
        let modal = document.getElementById(`returnModal${data.id}`);
        const modalContainer = document.getElementById('modalContainer');
        
        if (!modal && modalContainer) {
            // Buat modal baru
            modalContainer.insertAdjacentHTML('beforeend', createModal(data));
            modal = document.getElementById(`returnModal${data.id}`);
            
            // Setup event listeners untuk input denda
            if (modal) {
                const dendaTerlambat = modal.querySelector('.denda-terlambat');
                const dendaKerusakan = modal.querySelector('.denda-kerusakan');
                
                if (dendaTerlambat) {
                    dendaTerlambat.addEventListener('input', () => updateTotalDenda(data.id));
                }
                if (dendaKerusakan) {
                    dendaKerusakan.addEventListener('input', () => updateTotalDenda(data.id));
                }
            }
        }
        
        // Tampilkan modal
        if (modal) {
            $(modal).modal('show');
        }
    }
    
    // Cleanup modal saat ditutup
    function cleanupModals() {
        $(document).on('hidden.bs.modal', '.modal', function() {
            // Hapus modal dari DOM setelah ditutup untuk mencegah memory leak
            $(this).remove();
        });
    }
    
    // Inisialisasi
    document.addEventListener('DOMContentLoaded', function() {
        setupReturnButtons();
        cleanupModals();
        
        // Observer untuk tombol yang ditambahkan secara dinamis
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length) {
                    setupReturnButtons();
                }
            });
        });
        
        observer.observe(document.body, { childList: true, subtree: true });
    });
})();
</script>
@endsection