@extends('layouts.app')

@section('title', 'Log Aktifitas')


<link rel="stylesheet" href="{{ asset('css/admin.css') }}">


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


@endsection

