@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-plus-circle me-2"></i> Tambah Peminjaman Baru
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.peminjaman.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.peminjaman.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-user me-1" style="color: #FDB931;"></i> Peminjam *
                            </label>
                            <select class="form-control-yellow @error('user_id') is-invalid @enderror" 
                                    id="user_id" name="user_id" required>
                                <option value="">-- Pilih Peminjam --</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alat_id" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-laptop me-1" style="color: #FDB931;"></i> Alat *
                            </label>
                            <select class="form-control-yellow @error('alat_id') is-invalid @enderror" 
                                    id="alat_id" name="alat_id" required>
                                <option value="">-- Pilih Alat --</option>
                                @foreach($alats as $alat)
                                <option value="{{ $alat->id }}" {{ old('alat_id') == $alat->id ? 'selected' : '' }}
                                        data-stok="{{ $alat->stok }}">
                                    {{ $alat->nama_alat }} (Stok: {{ $alat->stok }})
                                </option>
                                @endforeach
                            </select>
                            @error('alat_id')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tanggal_pinjam" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i> Tanggal Pinjam *
                            </label>
                            <input type="date" class="form-control-yellow @error('tanggal_pinjam') is-invalid @enderror" 
                                   id="tanggal_pinjam" name="tanggal_pinjam" 
                                   value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                            @error('tanggal_pinjam')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tanggal_kembali" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i> Tanggal Kembali *
                            </label>
                            <input type="date" class="form-control-yellow @error('tanggal_kembali') is-invalid @enderror" 
                                   id="tanggal_kembali" name="tanggal_kembali" 
                                   value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}" required>
                            @error('tanggal_kembali')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jumlah" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-cube me-1" style="color: #FDB931;"></i> Jumlah *
                            </label>
                            <input type="number" class="form-control-yellow @error('jumlah') is-invalid @enderror" 
                                   id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1" required>
                            @error('jumlah')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted" id="stok_info">Stok tersedia: -</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="keperluan" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-comment me-1" style="color: #FDB931;"></i> Keperluan *
                    </label>
                    <textarea class="form-control-yellow @error('keperluan') is-invalid @enderror" 
                              id="keperluan" name="keperluan" rows="3" 
                              placeholder="Jelaskan keperluan peminjaman..." required>{{ old('keperluan') }}</textarea>
                    @error('keperluan')
                        <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                    <small class="form-text text-muted">Minimal 10 karakter</small>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-info-circle me-1" style="color: #FDB931;"></i> Status
                            </label>
                            <select class="form-control-yellow @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="catatan_admin" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-sticky-note me-1" style="color: #FDB931;"></i> Catatan Admin
                            </label>
                            <textarea class="form-control-yellow @error('catatan_admin') is-invalid @enderror" 
                                      id="catatan_admin" name="catatan_admin" rows="2" 
                                      placeholder="Catatan internal untuk admin (opsional)">{{ old('catatan_admin') }}</textarea>
                            @error('catatan_admin')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="alert-yellow mt-3 mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Field yang ditandai * wajib diisi. Pastikan stok alat mencukupi untuk peminjaman.
                </div>

                <div class="form-group d-flex gap-2">
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-save me-1"></i> Simpan Peminjaman
                    </button>
                    <a href="{{ route('admin.peminjaman.index') }}" class="btn-yellow btn-secondary-custom">
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
// Auto-set tanggal kembali berdasarkan tanggal pinjam
document.getElementById('tanggal_pinjam').addEventListener('change', function() {
    var pinjamDate = new Date(this.value);
    var kembaliDate = new Date(pinjamDate);
    kembaliDate.setDate(kembaliDate.getDate() + 7);
    
    var year = kembaliDate.getFullYear();
    var month = String(kembaliDate.getMonth() + 1).padStart(2, '0');
    var day = String(kembaliDate.getDate()).padStart(2, '0');
    
    document.getElementById('tanggal_kembali').value = year + '-' + month + '-' + day;
});

// Menampilkan stok info ketika memilih alat
document.getElementById('alat_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var stok = selectedOption.getAttribute('data-stok');
    var stokInfo = document.getElementById('stok_info');
    
    if (stok) {
        stokInfo.innerHTML = 'Stok tersedia: ' + stok + ' unit';
        stokInfo.style.color = '#28a745';
        
        // Set max jumlah berdasarkan stok
        var jumlahInput = document.getElementById('jumlah');
        jumlahInput.max = stok;
        
        if (parseInt(jumlahInput.value) > parseInt(stok)) {
            jumlahInput.value = stok;
        }
    } else {
        stokInfo.innerHTML = 'Stok tersedia: -';
        stokInfo.style.color = '#6c757d';
    }
});

// Trigger change event on page load if alat is selected
document.addEventListener('DOMContentLoaded', function() {
    var alatSelect = document.getElementById('alat_id');
    if (alatSelect.value) {
        alatSelect.dispatchEvent(new Event('change'));
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