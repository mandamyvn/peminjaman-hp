@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-user-circle me-2"></i> Detail User
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn-yellow btn-sm" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn-yellow btn-sm ms-1" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: #FFFFFF;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="info-detail-card">
                        <div class="info-detail-header">
                            <i class="fas fa-info-circle me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Lengkap User</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-hashtag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>ID User</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">#{{ $user->id }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-user" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Nama Lengkap</strong>
                                </div>
                                <div class="info-value-detail">
                                    <strong>{{ $user->name }}</strong>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-envelope" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Email</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-envelope me-1" style="color: #FDB931;"></i>
                                    {{ $user->email }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-user-tag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Role</strong>
                                </div>
                                <div class="info-value-detail">
                                    @php
                                        $roleColors = [
                                            'admin' => '#dc3545',
                                            'petugas' => '#FFD700',
                                            'peminjam' => '#28a745'
                                        ];
                                        $roleTextColors = [
                                            'admin' => '#FFFFFF',
                                            'petugas' => '#000000',
                                            'peminjam' => '#FFFFFF'
                                        ];
                                        $roleIcons = [
                                            'admin' => 'fa-shield-alt',
                                            'petugas' => 'fa-user-tie',
                                            'peminjam' => 'fa-user-graduate'
                                        ];
                                        $badgeColor = $roleColors[$user->role] ?? '#6c757d';
                                        $textColor = $roleTextColors[$user->role] ?? '#FFFFFF';
                                        $icon = $roleIcons[$user->role] ?? 'fa-user';
                                    @endphp
                                    <span class="badge" style="background-color: {{ $badgeColor }}; color: {{ $textColor }}; padding: 6px 12px; border-radius: 6px;">
                                        <i class="fas {{ $icon }} me-1"></i>
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-id-card" style="color: #FDB931; width: 30px;"></i>
                                    <strong>NIM</strong>
                                </div>
                                <div class="info-value-detail">
                                    @if($user->nim)
                                    <i class="fas fa-id-card me-1" style="color: #FDB931;"></i>
                                    {{ $user->nim }}
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-phone" style="color: #FDB931; width: 30px;"></i>
                                    <strong>No HP</strong>
                                </div>
                                <div class="info-value-detail">
                                    @if($user->no_hp)
                                    <i class="fas fa-phone me-1" style="color: #FDB931;"></i>
                                    {{ $user->no_hp }}
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-map-marker-alt" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Alamat</strong>
                                </div>
                                <div class="info-value-detail">
                                    @if($user->alamat)
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                        {{ $user->alamat }}
                                    </div>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-plus" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Dibuat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                    <small class="text-muted ms-2">({{ $user->created_at->diffForHumans() }})</small>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-edit" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Diperbarui</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                    {{ $user->updated_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="profile-card">
                        <div class="profile-header">
                            <div class="user-initials-circle">
                                <span class="initials">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                            </div>
                        </div>
                        <div class="profile-body text-center">
                            <h4 style="color: #000000; font-weight: 600; margin-top: 15px;">{{ $user->name }}</h4>
                            <p class="text-muted mb-2">
                                <i class="fas fa-envelope me-1" style="color: #FDB931;"></i> {{ $user->email }}
                            </p>
                            <p class="mb-3">
                                <span class="badge" style="background-color: {{ $badgeColor ?? '#6c757d' }}; color: {{ $textColor ?? '#FFFFFF' }}; padding: 8px 16px;">
                                    <i class="fas {{ $icon ?? 'fa-user' }} me-1"></i>
                                    {{ ucfirst($user->role) }}
                                </span>
                            </p>
                            
                            @if($user->nim || $user->no_hp)
                            <div class="contact-info mt-3 pt-3" style="border-top: 1px solid #FFE69C;">
                                @if($user->nim)
                                <p class="mb-2">
                                    <i class="fas fa-id-card me-2" style="color: #FDB931;"></i>
                                    <strong>NIM:</strong> {{ $user->nim }}
                                </p>
                                @endif
                                @if($user->no_hp)
                                <p class="mb-0">
                                    <i class="fas fa-phone me-2" style="color: #FDB931;"></i>
                                    <strong>No HP:</strong> {{ $user->no_hp }}
                                </p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Info Detail Card */
.info-detail-card {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #FFE69C;
}

.info-detail-header {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    padding: 12px 20px;
    border-bottom: 2px solid #FFD700;
    font-weight: 600;
    color: #000000;
}

.info-detail-body {
    padding: 20px;
}

/* Info Row Styling */
.info-row-detail {
    display: flex;
    padding: 12px 0;
    border-bottom: 1px solid #FFE69C;
}

.info-row-detail:last-child {
    border-bottom: none;
}

.info-label-detail {
    width: 35%;
    font-weight: 500;
    color: #000000;
    display: flex;
    align-items: center;
}

.info-value-detail {
    width: 65%;
    color: #000000;
}

/* Profile Card */
.profile-card {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #FFE69C;
    text-align: center;
}

.profile-header {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    padding: 30px 20px;
    text-align: center;
}

.user-initials-circle {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #FFFFFF 0%, #FFF9E6 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.initials {
    color: #FDB931;
    font-size: 36px;
    font-weight: bold;
    text-transform: uppercase;
}

.profile-body {
    padding: 20px;
}

.contact-info {
    text-align: left;
    padding: 15px;
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    border-radius: 8px;
}

/* Badge styling */
.badge-yellow {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    color: #000000;
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Text utilities */
.text-muted {
    color: #6c757d !important;
}

.ms-2 {
    margin-left: 8px;
}

.me-1 {
    margin-right: 4px;
}

.me-2 {
    margin-right: 8px;
}

.mb-2 {
    margin-bottom: 8px;
}

.mb-3 {
    margin-bottom: 15px;
}

.mt-3 {
    margin-top: 15px;
}

.pt-3 {
    padding-top: 15px;
}

/* Responsive */
@media (max-width: 768px) {
    .info-row-detail {
        flex-direction: column;
    }
    
    .info-label-detail {
        width: 100%;
        margin-bottom: 8px;
    }
    
    .info-value-detail {
        width: 100%;
    }
    
    .card-header-yellow {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .card-tools {
        justify-content: center;
    }
    
    .user-initials-circle {
        width: 80px;
        height: 80px;
    }
    
    .initials {
        font-size: 28px;
    }
    
    .profile-header {
        padding: 20px;
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

/* Button hover effects */
.btn-yellow {
    transition: all 0.3s ease;
}

.btn-yellow:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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