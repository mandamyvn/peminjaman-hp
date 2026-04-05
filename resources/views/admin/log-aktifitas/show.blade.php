@extends('layouts.app')

@section('title', 'Detail Log Aktifitas')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-info-circle me-2"></i> Detail Log Aktifitas #{{ $logAktifitas->id }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.log-aktifitas.index') }}" class="btn-yellow btn-sm" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: #FFFFFF;">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="info-detail-card">
                        <div class="info-detail-header">
                            <i class="fas fa-info-circle me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Log</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-hashtag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>ID Log</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">#{{ $logAktifitas->id }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-user" style="color: #FDB931; width: 30px;"></i>
                                    <strong>User</strong>
                                </div>
                                <div class="info-value-detail">
                                    @if($logAktifitas->user)
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2">
                                            <i class="fas fa-user-circle fa-2x" style="color: #FDB931;"></i>
                                        </div>
                                        <div>
                                            <strong style="color: #000000;">{{ $logAktifitas->user->name }}</strong><br>
                                            <small class="text-muted">
                                                <i class="fas fa-envelope me-1"></i> {{ $logAktifitas->user->email }}
                                            </small><br>
                                            <small class="text-muted">
                                                <i class="fas fa-tag me-1"></i> Role: {{ ucfirst($logAktifitas->user->role) }}
                                            </small>
                                        </div>
                                    </div>
                                    @else
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle me-1"></i> User tidak ditemukan (mungkin sudah dihapus)
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-tag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Aksi</strong>
                                </div>
                                <div class="info-value-detail">
                                    @php
                                        $actionColors = [
                                            'CREATE' => '#28a745',
                                            'UPDATE' => '#FFD700',
                                            'DELETE' => '#dc3545',
                                            'LOGIN' => '#17a2b8',
                                            'LOGOUT' => '#6c757d'
                                        ];
                                        $actionTextColors = [
                                            'CREATE' => '#FFFFFF',
                                            'UPDATE' => '#000000',
                                            'DELETE' => '#FFFFFF',
                                            'LOGIN' => '#FFFFFF',
                                            'LOGOUT' => '#FFFFFF'
                                        ];
                                        $actionIcons = [
                                            'CREATE' => 'fa-plus-circle',
                                            'UPDATE' => 'fa-edit',
                                            'DELETE' => 'fa-trash-alt',
                                            'LOGIN' => 'fa-sign-in-alt',
                                            'LOGOUT' => 'fa-sign-out-alt'
                                        ];
                                    @endphp
                                    <span class="badge" style="background-color: {{ $actionColors[$logAktifitas->aksi] ?? '#6c757d' }}; color: {{ $actionTextColors[$logAktifitas->aksi] ?? '#FFFFFF' }}; padding: 6px 12px; border-radius: 6px;">
                                        <i class="fas {{ $actionIcons[$logAktifitas->aksi] ?? 'fa-info-circle' }} me-1"></i>
                                        {{ $logAktifitas->aksi }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-align-left" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Deskripsi</strong>
                                </div>
                                <div class="info-value-detail">
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                        {{ $logAktifitas->deskripsi ?? '-' }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-network-wired" style="color: #FDB931; width: 30px;"></i>
                                    <strong>IP Address</strong>
                                </div>
                                <div class="info-value-detail">
                                    <code style="background: #FFF3CD; padding: 5px 10px; border-radius: 6px; color: #000000;">
                                        <i class="fas fa-network-wired me-1"></i> {{ $logAktifitas->ip_address ?? '-' }}
                                    </code>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-plus" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Dibuat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                    {{ $logAktifitas->created_at ? $logAktifitas->created_at->format('d/m/Y H:i:s') : '-' }}
                                    @if($logAktifitas->created_at)
                                    <small class="text-muted ms-2">({{ $logAktifitas->created_at->diffForHumans() }})</small>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-edit" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Diperbarui</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                    {{ $logAktifitas->updated_at ? $logAktifitas->updated_at->format('d/m/Y H:i:s') : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="info-detail-card">
                        <div class="info-detail-header">
                            <i class="fas fa-laptop-code me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi Teknis</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-globe" style="color: #FDB931; width: 30px;"></i>
                                    <strong>User Agent</strong>
                                </div>
                                <div class="info-value-detail">
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 3px solid #FFD700; font-size: 12px; word-break: break-all;">
                                        {{ $logAktifitas->user_agent ?? '-' }}
                                    </div>
                                </div>
                            </div>
                            
                            @php
                                $browser = 'Unknown';
                                $os = 'Unknown';
                                $userAgent = $logAktifitas->user_agent ?? '';
                                
                                if (strpos($userAgent, 'Chrome') !== false) $browser = 'Google Chrome';
                                elseif (strpos($userAgent, 'Firefox') !== false) $browser = 'Mozilla Firefox';
                                elseif (strpos($userAgent, 'Safari') !== false) $browser = 'Apple Safari';
                                elseif (strpos($userAgent, 'Edge') !== false) $browser = 'Microsoft Edge';
                                elseif (strpos($userAgent, 'Opera') !== false) $browser = 'Opera';
                                
                                if (strpos($userAgent, 'Windows') !== false) $os = 'Windows';
                                elseif (strpos($userAgent, 'Mac') !== false) $os = 'macOS';
                                elseif (strpos($userAgent, 'Linux') !== false) $os = 'Linux';
                                elseif (strpos($userAgent, 'Android') !== false) $os = 'Android';
                                elseif (strpos($userAgent, 'iPhone') !== false) $os = 'iOS';
                            @endphp
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-chrome" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Browser</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 4px 10px;">
                                        <i class="fas fa-globe me-1"></i> {{ $browser }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-desktop" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Sistem Operasi</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 4px 10px;">
                                        <i class="fas fa-desktop me-1"></i> {{ $os }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-detail-card mt-4">
                        <div class="info-detail-header">
                            <i class="fas fa-user-circle me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Informasi User</span>
                        </div>
                        <div class="info-detail-body">
                            @if($logAktifitas->user)
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-user" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Nama Lengkap</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-user-circle me-1" style="color: #FDB931;"></i>
                                    {{ $logAktifitas->user->name }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-envelope" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Email</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-envelope me-1" style="color: #FDB931;"></i>
                                    {{ $logAktifitas->user->email }}
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-tag" style="color: #FDB931; width: 30px;"></i>
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
                                    @endphp
                                    <span class="badge" style="background-color: {{ $roleColors[$logAktifitas->user->role] ?? '#6c757d' }}; color: {{ $roleTextColors[$logAktifitas->user->role] ?? '#FFFFFF' }}; padding: 6px 12px;">
                                        <i class="fas {{ $roleIcons[$logAktifitas->user->role] ?? 'fa-user' }} me-1"></i>
                                        {{ ucfirst($logAktifitas->user->role) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-plus" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Bergabung</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                    {{ $logAktifitas->user->created_at ? $logAktifitas->user->created_at->format('d/m/Y') : '-' }}
                                    @if($logAktifitas->user->created_at)
                                    <small class="text-muted ms-2">({{ $logAktifitas->user->created_at->diffForHumans() }})</small>
                                    @endif
                                </div>
                            </div>
                            
                            @if($logAktifitas->user->nim)
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-id-card" style="color: #FDB931; width: 30px;"></i>
                                    <strong>NIM</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $logAktifitas->user->nim }}
                                </div>
                            </div>
                            @endif
                            
                            @if($logAktifitas->user->no_hp)
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-phone" style="color: #FDB931; width: 30px;"></i>
                                    <strong>No HP</strong>
                                </div>
                                <div class="info-value-detail">
                                    {{ $logAktifitas->user->no_hp }}
                                </div>
                            </div>
                            @endif
                            @else
                            <div class="alert-yellow text-center py-4">
                                <i class="fas fa-exclamation-triangle fa-2x mb-2" style="color: #FDB931;"></i>
                                <p style="color: #000000; margin: 0;">Data user tidak tersedia (mungkin sudah dihapus)</p>
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
    height: 100%;
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

/* Alert styling */
.alert-yellow {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    border-left: 4px solid #FFD700;
    color: #000000;
    border-radius: 8px;
    padding: 20px;
}

/* User avatar */
.user-avatar {
    width: 45px;
    text-align: center;
}

/* Text utilities */
.text-muted {
    color: #6c757d !important;
    font-size: 12px;
}

.text-danger {
    color: #dc3545 !important;
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

.mb-4 {
    margin-bottom: 20px;
}

.mt-4 {
    margin-top: 20px;
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
    
    .d-flex.align-items-center {
        flex-direction: column;
        text-align: center;
    }
    
    .user-avatar {
        margin-bottom: 10px;
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