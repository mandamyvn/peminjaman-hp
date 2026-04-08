@extends('layouts.app')

@section('title', 'Daftar Alat')


<link rel="stylesheet" href="{{ asset('css/peminjam.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-laptop me-2"></i> Daftar Alat Tersedia
            </h3>
            <div class="card-tools">
                <button class="btn-yellow btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Filter Modal -->
            <div class="modal fade" id="filterModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 12px; overflow: hidden;">
                        <div class="modal-header" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); border-bottom: 2px solid rgba(0,0,0,0.1);">
                            <h5 class="modal-title" style="color: #000000; font-weight: 600;">
                                <i class="fas fa-filter me-2"></i> Filter Alat
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" style="color: #000000;">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form method="GET" action="{{ route('peminjam.alat.index') }}">
                            <div class="modal-body" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);">
                                <div class="form-group">
                                    <label style="color: #000000; font-weight: 500;">Kategori</label>
                                    <select class="form-control-yellow" id="kategori_id" name="kategori_id">
                                        <option value="">Semua Kategori</option>
                                        @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="color: #000000; font-weight: 500;">Pencarian</label>
                                    <input type="text" class="form-control-yellow" id="search" name="search" 
                                           value="{{ request('search') }}" placeholder="Cari nama alat, merk...">
                                </div>
                            </div>
                            <div class="modal-footer" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%); border-top: 1px solid #FFE69C;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                                <button type="submit" class="btn-yellow">Terapkan Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if($alats->count() > 0)
            <div class="row">
                @foreach($alats as $alat)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card-alat h-100">
                        @if($alat->gambar)
                        <img src="{{ asset('img/' . $alat->gambar) }}" 
                             class="card-img-top" alt="{{ $alat->nama_alat }}"
                             style="height: 200px; object-fit: cover;">
                        @else
                        <div class="text-center py-4" style="height: 200px; background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%);">
                            <i class="fas fa-laptop fa-4x" style="color: #FDB931;"></i>
                        </div>
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title" style="color: #000000; font-weight: 600;">{{ $alat->nama_alat }}</h5>
                            <p class="card-text">
                                <span class="badge" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000; padding: 4px 10px; border-radius: 6px;">
                                    <i class="fas fa-tag me-1"></i> {{ $alat->kategori->nama_kategori }}
                                </span>
                            </p>
                            <div class="mt-3">
                                <div class="info-item">
                                    <i class="fas fa-barcode" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Kode:</strong> {{ $alat->kode_alat }}
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-cube" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Stok:</strong> 
                                    <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; padding: 4px 8px;">
                                        {{ $alat->stok }} Tersedia
                                    </span>
                                </div>
                                @if($alat->merk)
                                <div class="info-item">
                                    <i class="fas fa-industry" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Merk:</strong> {{ $alat->merk }}
                                </div>
                                @endif
                                @if($alat->harga_sewa_perhari)
                                <div class="info-item">
                                    <i class="fas fa-money-bill" style="color: #FDB931; width: 25px;"></i>
                                    <strong>Sewa/Hari:</strong> 
                                    <span class="text-success fw-bold">Rp {{ number_format($alat->harga_sewa_perhari,0,',','.') }}</span>
                                </div>
                                @endif
                            </div>
                            @if($alat->deskripsi)
                            <p class="card-text mt-2" style="color: #666;">
                                {{ Str::limit($alat->deskripsi, 80) }}
                            </p>
                            @endif
                        </div>
                        <div class="card-footer" style="background: transparent; border-top: 1px solid #FFE69C;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; padding: 6px 12px;">
                                    <i class="fas fa-check-circle me-1"></i> Tersedia
                                </span>
                                <a href="{{ route('peminjam.alat.show', $alat) }}" class="btn-yellow btn-sm">
                                    <i class="fas fa-info-circle me-1"></i> Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-4 d-flex justify-content-center">
                {{ $alats->links() }}
            </div>
            @else
            <div class="alert-yellow text-center py-5">
                <i class="fas fa-inbox fa-4x mb-3" style="color: #FDB931;"></i>
                <h4 style="color: #000000;">Tidak ada alat tersedia</h4>
                <p style="color: #666;">Semua alat sedang dipinjam atau dalam perbaikan.</p>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection

