@extends('layouts.app')

@section('title', 'Manajemen Alat')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-laptop me-2"></i> Daftar Alat
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.alat.create') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Alat
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($alats->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover-yellow">
                    <thead class="table-header-yellow">
                        <tr>
                            <th style="color: #000000; padding: 12px;">Gambar</th>
                            <th style="color: #000000; padding: 12px;">Kode</th>
                            <th style="color: #000000; padding: 12px;">Nama Alat</th>
                            <th style="color: #000000; padding: 12px;">Kategori</th>
                            <th style="color: #000000; padding: 12px;">Merk</th>
                            <th style="color: #000000; padding: 12px;">Stok</th>
                            <th style="color: #000000; padding: 12px;">Harga Sewa</th>
                            <th style="color: #000000; padding: 12px;">Status</th>
                            <th style="color: #000000; padding: 12px; width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alats as $alat)
                        <tr style="border-bottom: 1px solid #FFE69C;">
                            <!-- GAMBAR -->
                            <td class="text-center" style="padding: 12px;">
                                @if($alat->gambar)
                                    <img src="{{ asset('img/'.$alat->gambar) }}"
                                         width="50" height="50"
                                         style="object-fit: cover; border-radius: 8px; border: 2px solid #FFD700;"
                                         class="img-thumbnail"
                                         onerror="this.onerror=null; this.src='{{ asset('img/no-image.png') }}'">
                                @else
                                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                                        <i class="fas fa-image" style="color: #FDB931;"></i>
                                    </div>
                                @endif
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge-yellow">{{ $alat->kode_alat }}</span>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-laptop me-1" style="color: #FDB931;"></i>
                                <strong>{{ $alat->nama_alat }}</strong>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 4px 10px;">
                                    <i class="fas fa-folder me-1"></i> {{ $alat->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                @if($alat->merk)
                                <i class="fas fa-industry me-1" style="color: #FDB931;"></i>
                                {{ $alat->merk }}
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">
                                <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; padding: 6px 12px;">
                                    <i class="fas fa-box me-1"></i> {{ $alat->stok }}
                                </span>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <strong class="text-success">
                                    Rp {{ number_format($alat->harga_sewa_perhari,0,',','.') }}
                                </strong>
                                <small class="text-muted">/hari</small>
                            </td>
                            <td style="padding: 12px;">
                                @php
                                    $statusColors = [
                                        'tersedia' => '#28a745',
                                        'dipinjam' => '#FFD700',
                                        'rusak' => '#dc3545'
                                    ];
                                    $statusTextColors = [
                                        'tersedia' => '#FFFFFF',
                                        'dipinjam' => '#000000',
                                        'rusak' => '#FFFFFF'
                                    ];
                                    $statusIcons = [
                                        'tersedia' => 'fa-check-circle',
                                        'dipinjam' => 'fa-clock',
                                        'rusak' => 'fa-exclamation-triangle'
                                    ];
                                @endphp
                                <span class="badge" style="background-color: {{ $statusColors[$alat->status] ?? '#6c757d' }}; color: {{ $statusTextColors[$alat->status] ?? '#FFFFFF' }}; padding: 6px 12px; border-radius: 6px;">
                                    <i class="fas {{ $statusIcons[$alat->status] ?? 'fa-info-circle' }} me-1"></i>
                                    {{ ucfirst($alat->status) }}
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.alat.show', $alat) }}" class="btn-yellow btn-sm" 
                                       style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF;">
                                        <i class="fas fa-eye me-1"></i>
                                    </a>
                                    <a href="{{ route('admin.alat.edit', $alat) }}" class="btn-yellow btn-sm ms-1"
                                       style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                                        <i class="fas fa-edit me-1"></i>
                                    </a>
                                    <form action="{{ route('admin.alat.destroy', $alat) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus alat {{ $alat->nama_alat }}?')"
                                                style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: #FFFFFF; border: none; border-radius: 8px; padding: 6px 12px;">
                                            <i class="fas fa-trash me-1"></i>
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
                {{ $alats->links() }}
            </div>
            @else
            <div class="alert-yellow text-center py-5">
                <i class="fas fa-laptop-slash fa-4x mb-3" style="color: #FDB931;"></i>
                <h4 style="color: #000000;">Tidak ada data alat</h4>
                <p style="color: #666;">Belum ada alat yang terdaftar dalam sistem.</p>
                <a href="{{ route('admin.alat.create') }}" class="btn-yellow mt-2">
                    <i class="fas fa-plus me-1"></i> Tambah Alat Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection

@push('styles')

@endpush