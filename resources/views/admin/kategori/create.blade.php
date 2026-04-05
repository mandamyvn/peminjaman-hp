@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-plus-circle me-2"></i> Tambah Kategori Baru
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.kategori.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nama_kategori" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-tag me-1" style="color: #FDB931;"></i> Nama Kategori *
                    </label>
                    <input type="text" class="form-control-yellow @error('nama_kategori') is-invalid @enderror" 
                           id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}" 
                           placeholder="Masukkan nama kategori" required>
                    @error('nama_kategori')
                        <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                    <small class="form-text text-muted">Contoh: Laptop, Smartphone, Tablet, dll.</small>
                </div>

                <div class="form-group">
                    <label for="deskripsi" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-align-left me-1" style="color: #FDB931;"></i> Deskripsi
                    </label>
                    <textarea class="form-control-yellow @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="4" 
                              placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                    <small class="form-text text-muted">Jelaskan tentang kategori ini, misalnya jenis alat yang termasuk, spesifikasi umum, dll.</small>
                </div>

                <div class="alert-yellow mt-3 mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Field yang ditandai * wajib diisi. Kategori akan digunakan untuk mengelompokkan alat-alat yang tersedia.
                </div>

                <div class="form-group d-flex gap-2">
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-save me-1"></i> Simpan Kategori
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn-yellow btn-secondary-custom">
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
    min-height: 100px;
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

/* Button styling */
.btn-yellow {
    background: linear-gradient(135deg, var(--yellow-primary) 0%, var(--yellow-secondary) 100%);
    color: var(--text-dark);
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
}

.btn-yellow:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    color: var(--text-dark);
    text-decoration: none;
}
</style>
@endpush