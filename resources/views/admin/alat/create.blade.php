@extends('layouts.app')

@section('title', 'Tambah Alat')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-plus-circle me-2"></i> Tambah Alat Baru
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.alat.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.alat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_alat" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-barcode me-1" style="color: #FDB931;"></i> Kode Alat *
                            </label>
                            <input type="text" name="kode_alat"
                                   class="form-control-yellow @error('kode_alat') is-invalid @enderror"
                                   id="kode_alat"
                                   value="{{ old('kode_alat') }}" 
                                   placeholder="Contoh: LAP-001"
                                   required>
                            @error('kode_alat')<div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</div>@enderror
                            <small class="form-text text-muted">Kode unik untuk mengidentifikasi alat</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_alat" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-tag me-1" style="color: #FDB931;"></i> Nama Alat *
                            </label>
                            <input type="text" name="nama_alat"
                                   class="form-control-yellow @error('nama_alat') is-invalid @enderror"
                                   id="nama_alat"
                                   value="{{ old('nama_alat') }}" 
                                   placeholder="Contoh: Laptop Asus ROG"
                                   required>
                            @error('nama_alat')<div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori_id" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-folder me-1" style="color: #FDB931;"></i> Kategori *
                            </label>
                            <select name="kategori_id"
                                    id="kategori_id"
                                    class="form-control-yellow @error('kategori_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')<div class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="merk" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-industry me-1" style="color: #FDB931;"></i> Merk
                            </label>
                            <input type="text" name="merk" 
                                   id="merk"
                                   class="form-control-yellow" 
                                   value="{{ old('merk') }}"
                                   placeholder="Contoh: Asus, Acer, Dell">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stok" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-cube me-1" style="color: #FDB931;"></i> Stok *
                            </label>
                            <input type="number" name="stok" 
                                   id="stok"
                                   class="form-control-yellow" 
                                   value="{{ old('stok', 1) }}" 
                                   min="1" required>
                            <small class="form-text text-muted">Jumlah unit yang tersedia</small>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="harga_sewa_perhari" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-money-bill me-1" style="color: #FDB931;"></i> Harga Sewa / Hari *
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; border: none;">Rp</span>
                                </div>
                                <input type="number" name="harga_sewa_perhari"
                                       id="harga_sewa_perhari"
                                       class="form-control-yellow"
                                       min="0"
                                       placeholder="0"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-info-circle me-1" style="color: #FDB931;"></i> Status
                            </label>
                            <select name="status" id="status" class="form-control-yellow">
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>
                                    <i class="fas fa-check-circle"></i> Tersedia
                                </option>
                                <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>
                                    <i class="fas fa-clock"></i> Dipinjam
                                </option>
                                <option value="rusak" {{ old('status') == 'rusak' ? 'selected' : '' }}>
                                    <i class="fas fa-exclamation-triangle"></i> Rusak
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="gambar" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-image me-1" style="color: #FDB931;"></i> Gambar Alat
                            </label>
                            <input type="file" name="gambar" id="gambar"
                                   class="form-control-file @error('gambar') is-invalid @enderror"
                                   accept="image/*"
                                   style="border: 1px solid #FFD700; border-radius: 8px; padding: 8px;">
                            @error('gambar')<div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>@enderror
                            
                            <!-- PREVIEW -->
                            <div class="mt-3 text-center">
                                <img id="preview-gambar"
                                     src="{{ asset('img/no-image.png') }}"
                                     class="img-thumbnail"
                                     width="120"
                                     style="border: 2px solid #FFD700; border-radius: 8px; padding: 5px;">
                                <br>
                                <small class="text-muted">Preview gambar</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="spesifikasi" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-microchip me-1" style="color: #FDB931;"></i> Spesifikasi
                    </label>
                    <textarea name="spesifikasi" id="spesifikasi" class="form-control-yellow" rows="2" 
                              placeholder="Contoh: RAM 8GB, SSD 256GB, Intel Core i5">{{ old('spesifikasi') }}</textarea>
                    <small class="form-text text-muted">Detail spesifikasi teknis alat</small>
                </div>

                <div class="form-group">
                    <label for="deskripsi" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-align-left me-1" style="color: #FDB931;"></i> Deskripsi
                    </label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control-yellow" rows="3" 
                              placeholder="Deskripsi lengkap tentang alat">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="alert-yellow mt-3 mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Field yang ditandai * wajib diisi. Pastikan data yang dimasukkan sudah benar.
                </div>

                <div class="form-group d-flex gap-2">
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-save me-1"></i> Simpan Alat
                    </button>
                    <a href="{{ route('admin.alat.index') }}" class="btn-yellow btn-secondary-custom">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
// Preview gambar
document.getElementById('gambar').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-gambar').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush

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