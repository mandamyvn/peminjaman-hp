@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-edit me-2"></i> Edit Alat: {{ $alat->nama_alat }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.alat.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.alat.update', $alat) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_alat" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-barcode me-1" style="color: #FDB931;"></i> Kode Alat *
                            </label>
                            <input type="text" class="form-control-yellow @error('kode_alat') is-invalid @enderror" 
                                   id="kode_alat" name="kode_alat" 
                                   value="{{ old('kode_alat', $alat->kode_alat) }}" 
                                   placeholder="Contoh: LAP-001"
                                   required>
                            @error('kode_alat')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Kode unik untuk mengidentifikasi alat</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_alat" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-tag me-1" style="color: #FDB931;"></i> Nama Alat *
                            </label>
                            <input type="text" class="form-control-yellow @error('nama_alat') is-invalid @enderror" 
                                   id="nama_alat" name="nama_alat" 
                                   value="{{ old('nama_alat', $alat->nama_alat) }}" 
                                   placeholder="Contoh: Laptop Asus ROG"
                                   required>
                            @error('nama_alat')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori_id" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-folder me-1" style="color: #FDB931;"></i> Kategori *
                            </label>
                            <select class="form-control-yellow @error('kategori_id') is-invalid @enderror" 
                                    id="kategori_id" name="kategori_id" required>
                                @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="merk" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-industry me-1" style="color: #FDB931;"></i> Merk
                            </label>
                            <input type="text" class="form-control-yellow @error('merk') is-invalid @enderror" 
                                   id="merk" name="merk" value="{{ old('merk', $alat->merk) }}"
                                   placeholder="Contoh: Asus, Acer, Dell">
                            @error('merk')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stok" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-cube me-1" style="color: #FDB931;"></i> Stok *
                            </label>
                            <input type="number" class="form-control-yellow @error('stok') is-invalid @enderror" 
                                   id="stok" name="stok" value="{{ old('stok', $alat->stok) }}" min="1" required>
                            @error('stok')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
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
                                       class="form-control-yellow"
                                       value="{{ old('harga_sewa_perhari', $alat->harga_sewa_perhari) }}"
                                       min="0"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-info-circle me-1" style="color: #FDB931;"></i> Status
                            </label>
                            <select class="form-control-yellow @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="tersedia" {{ old('status', $alat->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="dipinjam" {{ old('status', $alat->status) == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="rusak" {{ old('status', $alat->status) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
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
                                   style="border: 1px solid #FFD700; border-radius: 8px; padding: 8px; width: 100%;">
                            @error('gambar')
                                <div class="text-danger" style="font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                            @enderror
                            
                            @if($alat->gambar)
                            <div class="mt-3 text-center">
                                <img id="preview-gambar"
                                     src="{{ asset('img/' . $alat->gambar) }}"
                                     class="img-thumbnail"
                                     width="120"
                                     style="border: 2px solid #FFD700; border-radius: 8px; padding: 5px;">
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-image me-1"></i> 
                                    <a href="{{ asset('img/' . $alat->gambar) }}" target="_blank" style="color: #FDB931;">Lihat gambar saat ini</a>
                                </small>
                            </div>
                            @else
                            <div class="mt-3 text-center">
                                <img id="preview-gambar"
                                     src="{{ asset('img/no-image.png') }}"
                                     class="img-thumbnail"
                                     width="120"
                                     style="border: 2px solid #FFD700; border-radius: 8px; padding: 5px;">
                                <br>
                                <small class="text-muted">Preview gambar baru</small>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="spesifikasi" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-microchip me-1" style="color: #FDB931;"></i> Spesifikasi
                    </label>
                    <textarea class="form-control-yellow @error('spesifikasi') is-invalid @enderror" 
                              id="spesifikasi" name="spesifikasi" rows="2" 
                              placeholder="Contoh: RAM 8GB, SSD 256GB, Intel Core i5">{{ old('spesifikasi', $alat->spesifikasi) }}</textarea>
                    @error('spesifikasi')
                        <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                    <small class="form-text text-muted">Detail spesifikasi teknis alat</small>
                </div>

                <div class="form-group">
                    <label for="deskripsi" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-align-left me-1" style="color: #FDB931;"></i> Deskripsi
                    </label>
                    <textarea class="form-control-yellow @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="3" 
                              placeholder="Deskripsi lengkap tentang alat">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="alert-yellow mt-3 mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Field yang ditandai * wajib diisi. Biarkan gambar kosong jika tidak ingin mengubahnya.
                </div>

                <div class="form-group d-flex gap-2">
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-save me-1"></i> Update Alat
                    </button>
                    <a href="{{ route('admin.alat.index') }}" class="btn-yellow btn-secondary-custom">
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

/* File input styling */
input[type="file"] {
    background-color: #FFF9E6;
}

input[type="file"]::file-selector-button {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    color: #000000;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    margin-right: 10px;
    cursor: pointer;
}

input[type="file"]::file-selector-button:hover {
    transform: translateY(-1px);
}

/* Image thumbnail */
.img-thumbnail {
    background-color: #FFF9E6;
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
@endsection

@push('scripts')
<script>
// Preview gambar ketika memilih file baru
document.getElementById('gambar').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
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