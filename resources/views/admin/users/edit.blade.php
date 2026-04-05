@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-user-edit me-2"></i> Edit User: {{ $user->name }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.index') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-user me-1" style="color: #FDB931;"></i> Nama Lengkap *
                            </label>
                            <input type="text" class="form-control-yellow @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $user->name) }}" 
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
                                   id="email" name="email" value="{{ old('email', $user->email) }}" 
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
                                <i class="fas fa-lock me-1" style="color: #FDB931;"></i> Password 
                                <small class="text-muted">(Kosongkan jika tidak diubah)</small>
                            </label>
                            <input type="password" class="form-control-yellow @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Minimal 8 karakter">
                            @error('password')
                                <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-check-circle me-1" style="color: #FDB931;"></i> Konfirmasi Password
                            </label>
                            <input type="password" class="form-control-yellow" 
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Ketik ulang password">
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
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    <i class="fas fa-shield-alt"></i> Admin
                                </option>
                                <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>
                                    <i class="fas fa-user-tie"></i> Petugas
                                </option>
                                <option value="peminjam" {{ old('role', $user->role) == 'peminjam' ? 'selected' : '' }}>
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
                                   id="nim" name="nim" value="{{ old('nim', $user->nim) }}" 
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
                                   id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" 
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
                              placeholder="Masukkan alamat lengkap">{{ old('alamat', $user->alamat) }}</textarea>
                    @error('alamat')
                        <span class="invalid-feedback" style="color: #dc3545; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="alert-yellow mt-3 mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Informasi:</strong> Field yang ditandai * wajib diisi. Biarkan password kosong jika tidak ingin mengubahnya.
                </div>

                <div class="form-group d-flex gap-2">
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-save me-1"></i> Update User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn-yellow btn-secondary-custom">
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

/* Text muted */
.text-muted {
    color: #6c757d !important;
    font-size: 12px;
    margin-left: 5px;
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
    
    .text-muted {
        display: block;
        margin-left: 0;
        margin-top: 5px;
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
</style>
@endpush