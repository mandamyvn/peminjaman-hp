@extends('layouts.app')

@section('title', 'Detail Alat')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-laptop me-2"></i> Detail Alat: {{ $alat->nama_alat }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('peminjam.alat.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <button type="button" class="btn-yellow btn-sm ms-2" data-toggle="modal" data-target="#borrowModal">
                    <i class="fas fa-handshake me-1"></i> Ajukan Peminjaman
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    @if($alat->gambar)
                    <img src="{{ asset('img/' . $alat->gambar) }}" 
                         class="img-fluid rounded mb-3" 
                         alt="{{ $alat->nama_alat }}"
                         style="max-height: 300px; width: 100%; object-fit: cover; border: 3px solid #FFD700;">
                    @else
                    <div class="text-center py-5" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-radius: 12px;">
                        <i class="fas fa-laptop fa-5x mb-3" style="color: #FDB931;"></i>
                        <p style="color: #000000;">Tidak ada gambar</p>
                    </div>
                    @endif
                    
                    <div class="card mt-3" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%); border: none; border-radius: 12px; overflow: hidden;">
                        <div class="card-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                            <h6 class="card-title mb-0" style="color: #000000; font-weight: 600;">
                                <i class="fas fa-chart-line me-2"></i> Status Alat
                            </h6>
                        </div>
                        <div class="card-body text-center py-4">
                            <h2 style="color: #28a745; font-weight: bold; font-size: 3rem;">{{ $alat->stok }}</h2>
                            <p style="color: #000000;">Tersedia dari {{ $alat->stok }} stok</p>
                            <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; padding: 8px 20px; font-size: 14px; border-radius: 8px;">
                                <i class="fas fa-check-circle me-1"></i> Tersedia untuk Dipinjam
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-7">
                    <h4 style="color: #000000; font-weight: 600;">{{ $alat->nama_alat }}</h4>
                    <p class="mb-3">
                        <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 5px 12px;">
                            <i class="fas fa-tag me-1"></i> {{ $alat->kategori->nama_kategori }}
                        </span>
                    </p>
                    
                    <div class="row mb-4">
                        <div class="col-6">
                            <div class="info-box" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-radius: 12px; padding: 15px;">
                                <span class="info-box-icon" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-radius: 10px;">
                                    <i class="fas fa-barcode" style="color: #000000;"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text" style="color: #000000;">Kode Alat</span>
                                    <span class="info-box-number" style="color: #000000; font-weight: bold;">{{ $alat->kode_alat }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-box" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-radius: 12px; padding: 15px;">
                                <span class="info-box-icon" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-radius: 10px;">
                                    <i class="fas fa-cube" style="color: #000000;"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text" style="color: #000000;">Stok Total</span>
                                    <span class="info-box-number" style="color: #000000; font-weight: bold;">{{ $alat->stok }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-table">
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-industry" style="color: #FDB931;"></i> Merk
                            </div>
                            <div class="info-value">{{ $alat->merk ?? '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-microchip" style="color: #FDB931;"></i> Spesifikasi
                            </div>
                            <div class="info-value">{{ $alat->spesifikasi ?? '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                <i class="fas fa-align-left" style="color: #FDB931;"></i> Deskripsi
                            </div>
                            <div class="info-value">{{ $alat->deskripsi ?? '-' }}</div>
                        </div>
                        @if($alat->harga_sewa_perhari)
                        <div class="info-row highlight">
                            <div class="info-label">
                                <i class="fas fa-money-bill-wave" style="color: #28a745;"></i> Harga Sewa
                            </div>
                            <div class="info-value">
                                <strong style="color: #28a745; font-size: 1.2rem;">
                                    Rp {{ number_format($alat->harga_sewa_perhari,0,',','.') }}
                                </strong> / hari
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Peminjaman -->
<div class="modal fade" id="borrowModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                <h5 class="modal-title" style="color: #000000; font-weight: 600;">
                    <i class="fas fa-handshake me-2"></i> Ajukan Peminjaman
                </h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #000000;">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('peminjam.peminjaman.store') }}" method="POST">
                @csrf
                <div class="modal-body" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                    <input type="hidden" name="alat_id" value="{{ $alat->id }}">
                    
                    <div class="form-group">
                        <label style="color: #000000; font-weight: 500;">
                            <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i> Tanggal Pinjam *
                        </label>
                        <input type="date" class="form-control-yellow" name="tanggal_pinjam" 
                               value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
                        <small class="form-text" style="color: #666;">Minimum hari ini</small>
                    </div>
                    
                    <div class="form-group">
                        <label style="color: #000000; font-weight: 500;">
                            <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i> Tanggal Kembali *
                        </label>
                        <input type="date" class="form-control-yellow" name="tanggal_kembali" 
                               value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                        <small class="form-text" style="color: #666;">Maksimal 30 hari dari tanggal pinjam</small>
                    </div>
                    
                    <div class="form-group">
                        <label style="color: #000000; font-weight: 500;">
                            <i class="fas fa-cube me-1" style="color: #FDB931;"></i> Jumlah *
                        </label>
                        <input type="number" class="form-control-yellow" name="jumlah" 
                               value="1" min="1" max="{{ $alat->stok }}" required>
                        <small class="form-text" style="color: #666;">
                            Maksimal {{ $alat->stok }} unit (stok tersedia)
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label style="color: #000000; font-weight: 500;">
                            <i class="fas fa-comment me-1" style="color: #FDB931;"></i> Keperluan *
                        </label>
                        <textarea class="form-control-yellow" name="keperluan" rows="3" 
                                  placeholder="Jelaskan keperluan peminjaman..." required></textarea>
                        <small class="form-text" style="color: #666;">Minimal 10 karakter</small>
                    </div>
                    
                    <div class="alert-yellow mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Perhatian:</strong> Pengajuan akan diproses oleh petugas. Anda akan mendapatkan notifikasi jika disetujui atau ditolak.
                    </div>
                </div>
                <div class="modal-footer" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%); border-top: 1px solid #FFE69C;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-paper-plane me-1"></i> Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Info table styling */
.info-table {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #FFE69C;
}

.info-row {
    display: flex;
    padding: 12px 15px;
    border-bottom: 1px solid #FFE69C;
}

.info-row:last-child {
    border-bottom: none;
}

.info-row.highlight {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
}

.info-label {
    width: 35%;
    font-weight: 600;
    color: #000000;
}

.info-value {
    width: 65%;
    color: #000000;
}

/* Info box styling */
.info-box {
    display: flex;
    align-items: center;
    gap: 15px;
    transition: transform 0.3s ease;
}

.info-box:hover {
    transform: translateY(-3px);
}

.info-box-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 1.3rem;
}

.info-box-content {
    flex: 1;
}

.info-box-text {
    font-size: 12px;
    text-transform: uppercase;
    color: #666;
    margin-bottom: 5px;
}

.info-box-number {
    font-size: 18px;
    font-weight: bold;
    color: #000000;
}

/* Alert styling */
.alert-yellow {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    border-left: 4px solid #FFD700;
    color: #000000;
    border-radius: 8px;
    padding: 12px 15px;
}

/* Form control styling */
.form-control-yellow {
    border: 1px solid #FFD700;
    border-radius: 8px;
    padding: 10px;
    width: 100%;
    transition: all 0.3s ease;
}

.form-control-yellow:focus {
    border-color: #FDB931;
    box-shadow: 0 0 0 0.2rem rgba(253, 185, 49, 0.25);
    outline: none;
}

/* Card tools spacing */
.card-tools {
    display: flex;
    gap: 8px;
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

.mb-3 {
    margin-bottom: 15px;
}

.mt-3 {
    margin-top: 15px;
}

.mb-4 {
    margin-bottom: 20px;
}

.py-4 {
    padding-top: 20px;
    padding-bottom: 20px;
}

.py-5 {
    padding-top: 40px;
    padding-bottom: 40px;
}

/* Responsive */
@media (max-width: 768px) {
    .info-row {
        flex-direction: column;
    }
    
    .info-label {
        width: 100%;
        margin-bottom: 5px;
    }
    
    .info-value {
        width: 100%;
    }
    
    .info-box {
        padding: 10px !important;
    }
    
    .info-box-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
    
    .info-box-number {
        font-size: 14px;
    }
    
    .card-header-yellow {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .card-tools {
        justify-content: center;
    }
}

/* Animation */
.card-yellow {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
// Validasi tanggal
document.addEventListener('DOMContentLoaded', function() {
    const pinjamInput = document.querySelector('input[name="tanggal_pinjam"]');
    const kembaliInput = document.querySelector('input[name="tanggal_kembali"]');
    
    if (pinjamInput && kembaliInput) {
        function updateMaxKembali() {
            var pinjamDate = new Date(pinjamInput.value);
            var maxKembaliDate = new Date(pinjamDate);
            maxKembaliDate.setDate(maxKembaliDate.getDate() + 30);
            
            var year = maxKembaliDate.getFullYear();
            var month = String(maxKembaliDate.getMonth() + 1).padStart(2, '0');
            var day = String(maxKembaliDate.getDate()).padStart(2, '0');
            
            kembaliInput.max = year + '-' + month + '-' + day;
            
            // Jika tanggal kembali melebihi maksimal, reset ke maksimal
            var currentKembaliDate = new Date(kembaliInput.value);
            if (currentKembaliDate > maxKembaliDate) {
                kembaliInput.value = year + '-' + month + '-' + day;
            }
        }
        
        pinjamInput.addEventListener('change', updateMaxKembali);
        updateMaxKembali();
    }
});
</script>
@endsection