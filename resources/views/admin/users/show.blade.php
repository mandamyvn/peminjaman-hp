@extends('layouts.app')

@section('title', 'Detail User')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

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


@endsection

