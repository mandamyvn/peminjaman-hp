@extends('layouts.app')

@section('title', 'Tambah Peminjaman')


<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

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

