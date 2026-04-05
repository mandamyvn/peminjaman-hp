@extends('layouts.app')

@section('title', 'Edit Pengembalian')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-edit me-2"></i> Edit Pengembalian #{{ $pengembalian->id }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.pengembalian.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pengembalian.update', $pengembalian) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="peminjaman_id" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-handshake me-1" style="color: #FDB931;"></i> Peminjaman *
                    </label>
                    <select class="form-control-yellow @error('peminjaman_id') is-invalid @enderror" 
                            id="peminjaman_id" name="peminjaman_id" required
                            data-tanggal-kembali-asli="{{ $pengembalian->peminjaman->tanggal_kembali->format('Y-m-d') }}"
                            data-jumlah-pinjam="{{ $pengembalian->peminjaman->jumlah }}">
                        @foreach($peminjamans as $peminjaman)
                        <option value="{{ $peminjaman->id }}" {{ old('peminjaman_id', $pengembalian->peminjaman_id) == $peminjaman->id ? 'selected' : '' }}
                                data-tanggal-kembali="{{ $peminjaman->tanggal_kembali->format('Y-m-d') }}"
                                data-jumlah="{{ $peminjaman->jumlah }}">
                            {{ $peminjaman->kode_peminjaman }} - {{ $peminjaman->user->name }} - {{ $peminjaman->alat->nama_alat }}
                        </option>
                        @endforeach
                    </select>
                    @error('peminjaman_id')
                        <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                    <small class="form-text text-muted">Pilih peminjaman yang akan dikembalikan</small>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tanggal_kembali" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i> Tanggal Kembali *
                            </label>
                            <input type="date" class="form-control-yellow @error('tanggal_kembali') is-invalid @enderror" 
                                   id="tanggal_kembali" name="tanggal_kembali" 
                                   value="{{ old('tanggal_kembali', $pengembalian->tanggal_kembali->format('Y-m-d')) }}" required>
                            @error('tanggal_kembali')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted" id="info_telat"></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jumlah_kembali" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-cube me-1" style="color: #FDB931;"></i> Jumlah Kembali *
                            </label>
                            <input type="number" class="form-control-yellow @error('jumlah_kembali') is-invalid @enderror" 
                                   id="jumlah_kembali" name="jumlah_kembali" 
                                   value="{{ old('jumlah_kembali', $pengembalian->jumlah_kembali) }}" min="1" required>
                            @error('jumlah_kembali')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted" id="info_jumlah"></small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kondisi" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-clipboard-list me-1" style="color: #FDB931;"></i> Kondisi *
                            </label>
                            <select class="form-control-yellow @error('kondisi') is-invalid @enderror" 
                                    id="kondisi" name="kondisi" required>
                                <option value="baik" {{ old('kondisi', $pengembalian->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="rusak_ringan" {{ old('kondisi', $pengembalian->kondisi) == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="rusak_berat" {{ old('kondisi', $pengembalian->kondisi) == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>
                            @error('kondisi')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="denda" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-money-bill me-1" style="color: #FDB931;"></i> Denda (Rp)
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: none;">Rp</span>
                                </div>
                                <input type="number" class="form-control-yellow @error('denda') is-invalid @enderror" 
                                       id="denda" name="denda" value="{{ old('denda', $pengembalian->denda) }}" min="0" step="1000">
                            </div>
                            @error('denda')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted" id="info_denda_otomatis"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keterangan" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-comment me-1" style="color: #FDB931;"></i> Keterangan (Opsional)
                            </label>
                            <textarea class="form-control-yellow @error('keterangan') is-invalid @enderror" 
                                      id="keterangan" name="keterangan" rows="2" 
                                      placeholder="Tambahan informasi tentang pengembalian...">{{ old('keterangan', $pengembalian->keterangan) }}</textarea>
                            @error('keterangan')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="alert-yellow mt-3 mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Field yang ditandai * wajib diisi. Denda akan dihitung otomatis berdasarkan keterlambatan (Rp 5.000/hari).
                </div>

                <div class="form-group d-flex gap-2">
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-save me-1"></i> Update Pengembalian
                    </button>
                    <a href="{{ route('admin.pengembalian.index') }}" class="btn-yellow btn-secondary-custom">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Form control styling */
.form-control-yellow {
    border: 1px solid #FFD700;
    border-radius: 8px;
    padding: 10px;
    width: 100%;
    transition: all 0.3s ease;
    background-color: #FFFFFF;
}

.form-control-yellow:focus {
    border-color: #FDB931;
    box-shadow: 0 0 0 0.2rem rgba(253, 185, 49, 0.25);
    outline: none;
}

.form-control-yellow.is-invalid {
    border-color: #dc3545;
    background-image: none;
}

.form-control-yellow.is-invalid:focus {
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

/* Label styling */
label {
    margin-bottom: 8px;
    display: block;
}

/* Textarea styling */
textarea.form-control-yellow {
    resize: vertical;
    min-height: 80px;
}

/* Input group styling */
.input-group-text {
    border-radius: 8px 0 0 8px;
}

.input-group .form-control-yellow {
    border-radius: 0 8px 8px 0;
}

/* Alert styling */
.alert-yellow {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    border-left: 4px solid #FFD700;
    color: #000000;
    border-radius: 8px;
    padding: 12px 15px;
}

/* Button styling */
.btn-yellow {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    color: #000000;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    cursor: pointer;
}

.btn-yellow:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    color: #000000;
    text-decoration: none;
}

.btn-secondary-custom {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: #FFFFFF;
}

.btn-secondary-custom:hover {
    color: #FFFFFF;
}

/* Gap utility */
.gap-2 {
    gap: 10px;
}

/* Text utilities */
.text-muted {
    color: #6c757d !important;
    font-size: 12px;
    margin-top: 5px;
    display: block;
}

.text-danger {
    color: #dc3545 !important;
}

.text-success {
    color: #28a745 !important;
}

/* Responsive */
@media (max-width: 768px) {
    .card-header-yellow {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .card-tools {
        justify-content: center;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .btn-yellow {
        padding: 8px 16px;
        font-size: 14px;
    }
    
    .d-flex {
        flex-direction: column;
    }
    
    .gap-2 {
        gap: 8px;
    }
}

/* Animation */
.card-yellow {
    animation: fadeInUp 0.5s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Invalid feedback styling */
.invalid-feedback {
    display: block;
    margin-top: 5px;
}
</style>

<script>
// Auto-fill informasi berdasarkan peminjaman yang dipilih
document.getElementById('peminjaman_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var tanggalKembaliScheduled = selectedOption.getAttribute('data-tanggal-kembali');
    var jumlahPinjam = selectedOption.getAttribute('data-jumlah');
    
    // Set jumlah kembali default
    var jumlahInput = document.getElementById('jumlah_kembali');
    if (jumlahPinjam) {
        jumlahInput.max = jumlahPinjam;
        document.getElementById('info_jumlah').innerHTML = 'Maksimal: ' + jumlahPinjam + ' unit';
        document.getElementById('info_jumlah').style.color = '#28a745';
        
        // Jika jumlah saat ini melebihi maksimal
        if (parseInt(jumlahInput.value) > parseInt(jumlahPinjam)) {
            jumlahInput.value = jumlahPinjam;
        }
    }
    
    // Hitung denda otomatis
    var tanggalKembaliInput = document.getElementById('tanggal_kembali');
    var dendaInput = document.getElementById('denda');
    var infoTelat = document.getElementById('info_telat');
    var infoDenda = document.getElementById('info_denda_otomatis');
    
    function hitungDenda() {
        var tglKembaliSesuai = new Date(tanggalKembaliScheduled);
        var tglKembaliReal = new Date(tanggalKembaliInput.value);
        
        if (tglKembaliReal > tglKembaliSesuai) {
            var hariTerlambat = Math.ceil((tglKembaliReal - tglKembaliSesuai) / (1000 * 60 * 60 * 24));
            var denda = hariTerlambat * 5000;
            dendaInput.value = denda;
            infoTelat.innerHTML = '<span class="text-danger"><i class="fas fa-exclamation-triangle me-1"></i> Terlambat ' + hariTerlambat + ' hari</span>';
            infoDenda.innerHTML = '<span class="text-danger">Denda otomatis: Rp ' + denda.toLocaleString('id-ID') + ' (Rp 5.000/hari)</span>';
        } else {
            // Jika tidak terlambat, jangan override denda yang sudah ada (bisa dari kerusakan)
            if (dendaInput.value == 0 || dendaInput.value == '0') {
                dendaInput.value = 0;
            }
            infoTelat.innerHTML = '<span class="text-success"><i class="fas fa-check-circle me-1"></i> Tepat waktu</span>';
            infoDenda.innerHTML = '<span class="text-success">Tidak ada denda keterlambatan</span>';
        }
    }
    
    tanggalKembaliInput.addEventListener('change', hitungDenda);
    hitungDenda();
});

// Trigger change event on page load
document.addEventListener('DOMContentLoaded', function() {
    var peminjamanSelect = document.getElementById('peminjaman_id');
    if (peminjamanSelect.value) {
        peminjamanSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection

@push('styles')
<style>
/* CSS Global untuk tema kuning - reusable classes */
:root {
    --yellow-primary: #FFD700;
    --yellow-secondary: #FDB931;
    --yellow-light: #FFF9E6;
    --yellow-soft: #FFF3CD;
    --yellow-medium: #FFE69C;
    --yellow-dark: #F39C12;
    --text-dark: #000000;
}

/* Card styling */
.card-yellow {
    background: linear-gradient(135deg, var(--yellow-light) 0%, #FFFFFF 100%);
    border: none;
    border-radius: 12px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-yellow:hover {
    transform: translateY(-3px);
    box-shadow: 0 1rem 2rem rgba(255, 215, 0, 0.2);
}

/* Card header styling */
.card-header-yellow {
    background: linear-gradient(135deg, var(--yellow-primary) 0%, var(--yellow-secondary) 100%);
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    padding: 1rem 1.25rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.card-header-yellow h3,
.card-header-yellow .card-title {
    color: var(--text-dark) !important;
    font-weight: 600;
    margin: 0;
}
</style>
@endpush