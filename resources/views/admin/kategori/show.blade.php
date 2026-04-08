@extends('layouts.app')

@section('title', 'Detail Kategori')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-folder-open me-2"></i> Detail Kategori: {{ $kategori->nama_kategori }}
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn-yellow btn-sm" style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="btn-yellow btn-sm ms-1" style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); color: #FFFFFF;">
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
                            <span style="color: #000000; font-weight: 600;">Informasi Kategori</span>
                        </div>
                        <div class="info-detail-body">
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-hashtag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>ID Kategori</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge-yellow">#{{ $kategori->id }}</span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-tag" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Nama Kategori</strong>
                                </div>
                                <div class="info-value-detail">
                                    <strong>{{ $kategori->nama_kategori }}</strong>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-align-left" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Deskripsi</strong>
                                </div>
                                <div class="info-value-detail">
                                    @if($kategori->deskripsi)
                                    <div class="p-2 rounded" style="background: linear-gradient(135deg, #FFF9E6 0%, #FFE69C 100%); border-left: 3px solid #FFD700;">
                                        {{ $kategori->deskripsi }}
                                    </div>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-box" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Jumlah Alat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <span class="badge" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: #FFFFFF; padding: 6px 12px;">
                                        <i class="fas fa-laptop me-1"></i> {{ $kategori->alats->count() }} Alat
                                    </span>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-plus" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Dibuat</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-alt me-1" style="color: #FDB931;"></i>
                                    {{ $kategori->created_at->format('d/m/Y H:i') }}
                                    <small class="text-muted ms-2">({{ $kategori->created_at->diffForHumans() }})</small>
                                </div>
                            </div>
                            
                            <div class="info-row-detail">
                                <div class="info-label-detail">
                                    <i class="fas fa-calendar-edit" style="color: #FDB931; width: 30px;"></i>
                                    <strong>Diperbarui</strong>
                                </div>
                                <div class="info-value-detail">
                                    <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                    {{ $kategori->updated_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="alat-list-card">
                        <div class="alat-list-header">
                            <i class="fas fa-list me-2" style="color: #FDB931;"></i>
                            <span style="color: #000000; font-weight: 600;">Alat dalam Kategori Ini</span>
                            <span class="badge-yellow ms-2">{{ $kategori->alats->count() }} Alat</span>
                        </div>
                        <div class="alat-list-body">
                            @if($kategori->alats->count() > 0)
                            <div class="list-group">
                                @foreach($kategori->alats as $alat)
                                <a href="{{ route('admin.alat.show', $alat) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="alat-icon me-3">
                                                <i class="fas fa-laptop" style="color: #FDB931; font-size: 1.2rem;"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1" style="color: #000000; font-weight: 600;">{{ $alat->nama_alat }}</h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-barcode me-1"></i> {{ $alat->kode_alat }}
                                                    <span class="mx-2">|</span>
                                                    <i class="fas fa-cube me-1"></i> Stok: {{ $alat->stok }}
                                                </small>
                                            </div>
                                        </div>
                                        <div>
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
                                            @endphp
                                            <span class="badge" style="background-color: {{ $statusColors[$alat->status] ?? '#6c757d' }}; color: {{ $statusTextColors[$alat->status] ?? '#FFFFFF' }}; padding: 5px 10px;">
                                                <i class="fas {{ $alat->status == 'tersedia' ? 'fa-check-circle' : ($alat->status == 'dipinjam' ? 'fa-clock' : 'fa-exclamation-triangle') }} me-1"></i>
                                                {{ ucfirst($alat->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                            @else
                            <div class="alert-yellow text-center py-5">
                                <i class="fas fa-inbox fa-3x mb-3" style="color: #FDB931;"></i>
                                <h5 style="color: #000000;">Belum ada alat</h5>
                                <p style="color: #666;">Belum ada alat dalam kategori ini.</p>
                                <a href="{{ route('admin.alat.create') }}" class="btn-yellow btn-sm mt-2">
                                    <i class="fas fa-plus me-1"></i> Tambah Alat
                                </a>
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

