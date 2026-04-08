@extends('layouts.app')

@section('title', 'Manajemen User')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-users me-2"></i> Daftar User
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.users.create') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah User
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($users->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover-yellow">
                    <thead class="table-header-yellow">
                    
                            <th style="color: #000000; padding: 12px;">ID</th>
                            <th style="color: #000000; padding: 12px;">Nama</th>
                            <th style="color: #000000; padding: 12px;">Email</th>
                            <th style="color: #000000; padding: 12px;">Role</th>
                            <th style="color: #000000; padding: 12px;">NIM</th>
                            <th style="color: #000000; padding: 12px;">No HP</th>
                            <th style="color: #000000; padding: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr style="border-bottom: 1px solid #FFE69C;">
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge-yellow">{{ $user->id }}</span>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-user-circle me-1" style="color: #FDB931;"></i>
                                <strong>{{ $user->name }}</strong>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-envelope me-1" style="color: #FDB931;"></i>
                                {{ $user->email }}
                            </td>
                            <td style="padding: 12px;">
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
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                @if($user->nim)
                                <i class="fas fa-id-card me-1" style="color: #FDB931;"></i>
                                {{ $user->nim }}
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                @if($user->no_hp)
                                <i class="fas fa-phone me-1" style="color: #FDB931;"></i>
                                {{ $user->no_hp }}
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn-yellow btn-sm" 
                                       style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF;">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn-yellow btn-sm ms-1"
                                       style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?')"
                                                style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 6px 12px;">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 d-flex justify-content-center">
                {{ $users->links() }}
            </div>
            @else
            <div class="alert-yellow text-center py-5">
                <i class="fas fa-users-slash fa-4x mb-3" style="color: #FDB931;"></i>
                <h4 style="color: #000000;">Tidak ada data user</h4>
                <p style="color: #666;">Belum ada user yang terdaftar dalam sistem.</p>
                <a href="{{ route('admin.users.create') }}" class="btn-yellow mt-2">
                    <i class="fas fa-plus me-1"></i> Tambah User Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

