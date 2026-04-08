@extends('layouts.app')

@section('title', 'Tambah User')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-user-plus me-2"></i> Tambah User Baru
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-user me-1" style="color: #FDB931;"></i> Nama Lengkap *
                            </label>
                            <input type="text" class="form-control-yellow @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Masukkan nama lengkap" required>
                            @error('name')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-envelope me-1" style="color: #FDB931;"></i> Email *
                            </label>
                            <input type="email" class="form-control-yellow @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="contoh@email.com" required>
                            @error('email')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-lock me-1" style="color: #FDB931;"></i> Password *
                            </label>
                            <input type="password" class="form-control-yellow @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Minimal 8 karakter" required>
                            @error('password')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-check-circle me-1" style="color: #FDB931;"></i> Konfirmasi Password *
                            </label>
                            <input type="password" class="form-control-yellow" 
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Ketik ulang password" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="role" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-user-tag me-1" style="color: #FDB931;"></i> Role *
                            </label>
                            <select class="form-control-yellow @error('role') is-invalid @enderror" 
                                    id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                    <i class="fas fa-shield-alt"></i> Admin
                                </option>
                                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>
                                    <i class="fas fa-user-tie"></i> Petugas
                                </option>
                                <option value="peminjam" {{ old('role') == 'peminjam' ? 'selected' : '' }}>
                                    <i class="fas fa-user-graduate"></i> Peminjam
                                </option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nim" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-id-card me-1" style="color: #FDB931;"></i> NIM
                            </label>
                            <input type="text" class="form-control-yellow @error('nim') is-invalid @enderror" 
                                   id="nim" name="nim" value="{{ old('nim') }}" 
                                   placeholder="Nomor Induk Mahasiswa">
                            @error('nim')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                            <small class="form-text text-muted">Khusus untuk role Peminjam</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-phone me-1" style="color: #FDB931;"></i> No HP
                            </label>
                            <input type="text" class="form-control-yellow @error('no_hp') is-invalid @enderror" 
                                   id="no_hp" name="no_hp" value="{{ old('no_hp') }}" 
                                   placeholder="081234567890">
                            @error('no_hp')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat" style="color: #000000; font-weight: 500;">
                        <i class="fas fa-map-marker-alt me-1" style="color: #FDB931;"></i> Alamat
                    </label>
                    <textarea class="form-control-yellow @error('alamat') is-invalid @enderror" 
                              id="alamat" name="alamat" rows="3" 
                              placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="alert-yellow mt-3 mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Field yang ditandai * wajib diisi.
                </div>

                <div class="form-group d-flex gap-2">
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-save me-1"></i> Simpan User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn-yellow btn-secondary-custom">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

