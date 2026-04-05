@extends('layouts.app')

@section('title', 'Log Aktifitas')

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-history me-2"></i> Log Aktifitas Sistem
            </h3>
        </div>
        <div class="card-body">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('admin.log-aktifitas.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user_id" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-user me-1" style="color: #FDB931;"></i> User
                            </label>
                            <select class="form-control-yellow" id="user_id" name="user_id">
                                <option value="">Semua User</option>
                                @foreach(App\Models\User::all() as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->role }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="aksi" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-tag me-1" style="color: #FDB931;"></i> Aksi
                            </label>
                            <select class="form-control-yellow" id="aksi" name="aksi">
                                <option value="">Semua Aksi</option>
                                <option value="CREATE" {{ request('aksi') == 'CREATE' ? 'selected' : '' }}>CREATE</option>
                                <option value="UPDATE" {{ request('aksi') == 'UPDATE' ? 'selected' : '' }}>UPDATE</option>
                                <option value="DELETE" {{ request('aksi') == 'DELETE' ? 'selected' : '' }}>DELETE</option>
                                <option value="LOGIN" {{ request('aksi') == 'LOGIN' ? 'selected' : '' }}>LOGIN</option>
                                <option value="LOGOUT" {{ request('aksi') == 'LOGOUT' ? 'selected' : '' }}>LOGOUT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="start_date" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i> Tanggal Mulai
                            </label>
                            <input type="date" class="form-control-yellow" id="start_date" name="start_date" 
                                   value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="end_date" style="color: #000000; font-weight: 500;">
                                <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i> Tanggal Akhir
                            </label>
                            <input type="date" class="form-control-yellow" id="end_date" name="end_date" 
                                   value="{{ request('end_date') }}">
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-yellow">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.log-aktifitas.index') }}" class="btn-yellow btn-secondary-custom">
                        <i class="fas fa-redo me-1"></i> Reset
                    </a>
                </div>
            </form>

            @if($logs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover-yellow">
                    <thead class="table-header-yellow">
                        <tr>
                            <th style="color: #000000; padding: 12px;">ID</th>
                            <th style="color: #000000; padding: 12px;">User</th>
                            <th style="color: #000000; padding: 12px;">Aksi</th>
                            <th style="color: #000000; padding: 12px;">Deskripsi</th>
                            <th style="color: #000000; padding: 12px;">IP Address</th>
                            <th style="color: #000000; padding: 12px;">Tanggal</th>
                            <th style="color: #000000; padding: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        <tr style="border-bottom: 1px solid #FFE69C;">
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge-yellow">#{{ $log->id }}</span>
                            </td>
                            <td style="padding: 12px;">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar-sm me-2">
                                        <i class="fas fa-user-circle fa-2x" style="color: #FDB931;"></i>
                                    </div>
                                    <div>
                                        <strong style="color: #000000;">{{ $log->user->name }}</strong><br>
                                        <small class="text-muted">
                                            <i class="fas fa-tag me-1"></i> {{ ucfirst($log->user->role) }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 12px;">
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
                                <span class="badge" style="background-color: {{ $actionColors[$log->aksi] ?? '#6c757d' }}; color: {{ $actionTextColors[$log->aksi] ?? '#FFFFFF' }}; padding: 6px 12px; border-radius: 6px;">
                                    <i class="fas {{ $actionIcons[$log->aksi] ?? 'fa-info-circle' }} me-1"></i>
                                    {{ $log->aksi }}
                                </span>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <div class="deskripsi-cell">
                                    <i class="fas fa-align-left me-1" style="color: #FDB931;"></i>
                                    {{ Str::limit($log->deskripsi, 80) }}
                                </div>
                            </td>
                            <td style="padding: 12px;">
                                <code style="background: #FFF3CD; padding: 4px 8px; border-radius: 6px; color: #000000;">
                                    <i class="fas fa-network-wired me-1"></i> {{ $log->ip_address }}
                                </code>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                {{ $log->created_at->format('d/m/Y') }}
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i> {{ $log->created_at->format('H:i:s') }}
                                </small>
                            </td>
                            <td style="padding: 12px;">
                                <a href="{{ route('admin.log-aktifitas.show', $log) }}" class="btn-yellow btn-sm" 
                                   style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF;">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 d-flex justify-content-center">
                {{ $logs->links() }}
            </div>
            @else
            <div class="alert-yellow text-center py-5">
                <i class="fas fa-history fa-4x mb-3" style="color: #FDB931;"></i>
                <h4 style="color: #000000;">Tidak ada data log aktifitas</h4>
                <p style="color: #666;">Belum ada aktifitas yang tercatat dalam sistem.</p>
            </div>
            @endif
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

/* Table hover effect */
.table-hover-yellow tbody tr:hover {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFF3CD 100%);
    transition: all 0.3s ease;
    cursor: pointer;
}

/* Table header styling */
.table-header-yellow {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
}

.table-header-yellow th {
    color: #000000;
    border: none;
    padding: 12px;
    font-weight: 600;
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

/* Alert styling */
.alert-yellow {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    border-left: 4px solid #FFD700;
    color: #000000;
    border-radius: 12px;
    padding: 40px 20px;
}

/* Pagination styling */
.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    border-color: #FFD700;
    color: #000000;
}

.pagination .page-link {
    color: #FDB931;
}

.pagination .page-link:hover {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    color: #000000;
}

/* User avatar */
.user-avatar-sm {
    width: 35px;
    text-align: center;
}

/* Deskripsi cell */
.deskripsi-cell {
    max-width: 300px;
    word-wrap: break-word;
}

/* Text utilities */
.text-muted {
    color: #6c757d !important;
    font-size: 11px;
}

/* Gap utilities */
.gap-2 {
    gap: 10px;
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
    .table-responsive {
        font-size: 13px;
    }
    
    .card-header-yellow {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .deskripsi-cell {
        max-width: 200px;
    }
    
    .d-flex.align-items-center {
        flex-direction: column;
        text-align: center;
    }
    
    .user-avatar-sm {
        margin-bottom: 5px;
    }
    
    .btn-yellow {
        padding: 8px 16px;
        font-size: 14px;
    }
    
    .table-header-yellow th {
        padding: 8px;
        font-size: 12px;
    }
    
    td {
        padding: 8px !important;
        font-size: 12px;
    }
    
    .badge {
        font-size: 11px;
        padding: 4px 8px;
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

/* Badge animation */
.badge {
    transition: all 0.3s ease;
}

.badge:hover {
    transform: scale(1.05);
}

/* Scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #FFF9E6;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #FDB931 0%, #FFD700 100%);
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

/* Table hover effect */
.table-hover-yellow tbody tr:hover {
    background: linear-gradient(135deg, var(--yellow-light) 0%, var(--yellow-soft) 100%);
    transition: all 0.3s ease;
}
</style>
@endpush