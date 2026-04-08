@extends('layouts.app')

@section('title', 'Edit Kategori')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-edit me-2"></i> Edit Kategori: {{ $kategori->nama_kategori }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.kategori.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="nama_kategori" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-tag me-1" style="color: #FDB931;"></i> Nama Kategori *
                    </label>
                    <input type="text" class="form-control-yellow @error('nama_kategori') is-invalid @enderror" 
                           id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
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
                              placeholder="Masukkan deskripsi kategori (opsional)">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                    <small class="form-text text-muted">Jelaskan tentang kategori ini, misalnya jenis alat yang termasuk, spesifikasi umum, dll.</small>
                </div>

                @if($kategori->alats->count() > 0)
                <div class="alert-warning mt-3 mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian:</strong> Kategori ini memiliki <strong>{{ $kategori->alats->count() }} alat</strong> yang terdaftar. Perubahan nama kategori akan berpengaruh pada semua alat tersebut.
                </div>
                @endif

                <div class="alert-yellow mt-3 mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Field yang ditandai * wajib diisi. Kategori akan digunakan untuk mengelompokkan alat-alat yang tersedia.
                </div>

                <div class="form-group d-flex gap-2">
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-save me-1"></i> Update Kategori
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn-yellow btn-secondary-custom">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

