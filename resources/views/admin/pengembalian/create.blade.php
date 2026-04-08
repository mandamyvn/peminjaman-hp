@extends('layouts.app')

@section('title', 'Tambah Pengembalian')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-plus-circle me-2"></i> Tambah Pengembalian Baru
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.pengembalian.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pengembalian.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="peminjaman_id" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-handshake me-1" style="color: #FDB931;"></i> Pilih Peminjaman *
                    </label>
                    <select class="form-control-yellow @error('peminjaman_id') is-invalid @enderror" 
                            id="peminjaman_id" name="peminjaman_id" required>
                        <option value="">-- Pilih Peminjaman --</option>
                        @foreach($peminjamans as $peminjaman)
                        <option value="{{ $peminjaman->id }}" {{ old('peminjaman_id') == $peminjaman->id ? 'selected' : '' }}
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
                                   value="{{ old('tanggal_kembali', date('Y-m-d')) }}" required>
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
                                   value="{{ old('jumlah_kembali', 1) }}" min="1" required>
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
                                <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="rusak_ringan" {{ old('kondisi') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="rusak_berat" {{ old('kondisi') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
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
                                       id="denda" name="denda" value="{{ old('denda', 0) }}" min="0" step="1000">
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
                                      placeholder="Tambahan informasi tentang pengembalian...">{{ old('keterangan') }}</textarea>
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
                        <i class="fas fa-save me-1"></i> Simpan Pengembalian
                    </button>
                    <a href="{{ route('admin.pengembalian.index') }}" class="btn-yellow btn-secondary-custom">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
// Auto-fill informasi berdasarkan peminjaman yang dipilih
document.getElementById('peminjaman_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var tanggalKembali = selectedOption.getAttribute('data-tanggal-kembali');
    var jumlahPinjam = selectedOption.getAttribute('data-jumlah');
    
    // Set jumlah kembali default
    var jumlahInput = document.getElementById('jumlah_kembali');
    if (jumlahPinjam) {
        jumlahInput.value = jumlahPinjam;
        jumlahInput.max = jumlahPinjam;
        document.getElementById('info_jumlah').innerHTML = 'Maksimal: ' + jumlahPinjam + ' unit';
        document.getElementById('info_jumlah').style.color = '#28a745';
    }
    
    // Hitung denda otomatis
    var tanggalKembaliInput = document.getElementById('tanggal_kembali');
    var dendaInput = document.getElementById('denda');
    var infoTelat = document.getElementById('info_telat');
    var infoDenda = document.getElementById('info_denda_otomatis');
    
    function hitungDenda() {
        var tglKembaliSesuai = new Date(tanggalKembali);
        var tglKembaliReal = new Date(tanggalKembaliInput.value);
        
        if (tglKembaliReal > tglKembaliSesuai) {
            var hariTerlambat = Math.ceil((tglKembaliReal - tglKembaliSesuai) / (1000 * 60 * 60 * 24));
            var denda = hariTerlambat * 5000;
            dendaInput.value = denda;
            infoTelat.innerHTML = '<span class="text-danger"><i class="fas fa-exclamation-triangle me-1"></i> Terlambat ' + hariTerlambat + ' hari</span>';
            infoDenda.innerHTML = '<span class="text-danger">Denda otomatis: Rp ' + denda.toLocaleString('id-ID') + ' (Rp 5.000/hari)</span>';
        } else {
            dendaInput.value = 0;
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

