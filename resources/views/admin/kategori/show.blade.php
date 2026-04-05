@extends('layouts.app')

@section('title', 'Detail Kategori')

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

/* Alat List Card */
.alat-list-card {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #FFE69C;
    height: 100%;
}

.alat-list-header {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    padding: 12px 20px;
    border-bottom: 2px solid #FFD700;
    font-weight: 600;
    color: #000000;
    display: flex;
    align-items: center;
}

.alat-list-body {
    padding: 20px;
    max-height: 500px;
    overflow-y: auto;
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

/* List Group Styling */
.list-group {
    margin: 0;
    padding: 0;
}

.list-group-item {
    background: linear-gradient(135deg, #FFF9E6 0%, #FFFFFF 100%);
    border: 1px solid #FFE69C;
    border-radius: 8px;
    margin-bottom: 10px;
    transition: all 0.3s ease;
    padding: 12px 15px;
}

.list-group-item:hover {
    background: linear-gradient(135deg, #FFF3CD 0%, #FFE69C 100%);
    transform: translateX(5px);
    border-color: #FFD700;
    text-decoration: none;
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

.mx-2 {
    margin-left: 8px;
    margin-right: 8px;
}

.mb-1 {
    margin-bottom: 4px;
}

.mb-4 {
    margin-bottom: 20px;
}

.mt-2 {
    margin-top: 8px;
}

.py-5 {
    padding-top: 40px;
    padding-bottom: 40px;
}

/* Scrollbar untuk list alat */
.alat-list-body::-webkit-scrollbar {
    width: 6px;
}

.alat-list-body::-webkit-scrollbar-track {
    background: #FFF9E6;
    border-radius: 10px;
}

.alat-list-body::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%);
    border-radius: 10px;
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
    
    .list-group-item .d-flex {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .alat-icon {
        display: none;
    }
    
    .alat-list-header {
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
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