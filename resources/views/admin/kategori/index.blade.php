@extends('layouts.app')

@section('title', 'Kategori Alat')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-tags me-2"></i> Daftar Kategori
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.kategori.create') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Kategori
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($kategoris->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover-yellow">
                    <thead class="table-header-yellow">
                        
                            <th style="color: #000000; padding: 12px;">ID</th>
                            <th style="color: #000000; padding: 12px;">Nama Kategori</th>
                            <th style="color: #000000; padding: 12px;">Deskripsi</th>
                            <th style="color: #000000; padding: 12px;">Jumlah Alat</th>
                            <th style="color: #000000; padding: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoris as $kategori)
                        <tr style="border-bottom: 1px solid #FFE69C;">
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge-yellow">#{{ $kategori->id }}</span>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-folder me-1" style="color: #FDB931;"></i>
                                <strong>{{ $kategori->nama_kategori }}</strong>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                @if($kategori->deskripsi)
                                <div class="deskripsi-cell">
                                    <i class="fas fa-align-left me-1" style="color: #FDB931;"></i>
                                    {{ Str::limit($kategori->deskripsi, 60) }}
                                </div>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">
                                <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; padding: 6px 12px; border-radius: 6px;">
                                    <i class="fas fa-box me-1"></i> {{ $kategori->alats->count() }} Alat
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.kategori.show', $kategori) }}" class="btn-yellow btn-sm" 
                                       style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF;">
                                        <i class="fas fa-eye me-1"></i> Detail
                                    </a>
                                    <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn-yellow btn-sm ms-1"
                                       style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $kategori->nama_kategori }}?')"
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
                {{ $kategoris->links() }}
            </div>
            @else
            <div class="alert-yellow text-center py-5">
                <i class="fas fa-folder-open fa-4x mb-3" style="color: #FDB931;"></i>
                <h4 style="color: #000000;">Tidak ada data kategori</h4>
                <p style="color: #666;">Belum ada kategori alat yang terdaftar dalam sistem.</p>
                <a href="{{ route('admin.kategori.create') }}" class="btn-yellow mt-2">
                    <i class="fas fa-plus me-1"></i> Tambah Kategori Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection

