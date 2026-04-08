@extends('layouts.app')

@section('title', 'Manajemen Pengembalian')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@section('content')
<div class="container-fluid">
    <div class="card-yellow">
        <div class="card-header-yellow">
            <h3 class="card-title">
                <i class="fas fa-undo-alt me-2"></i> Daftar Pengembalian
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.pengembalian.create') }}" class="btn-yellow btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Pengembalian
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($pengembalians->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover-yellow" id="pengembalianTable">
                    <thead class="table-header-yellow">
                        <tr>
                            <th style="color: #000000; padding: 12px;">ID</th>
                            <th style="color: #000000; padding: 12px;">Kode Peminjaman</th>
                            <th style="color: #000000; padding: 12px;">Tanggal Kembali</th>
                            <th style="color: #000000; padding: 12px;">Jumlah</th>
                            <th style="color: #000000; padding: 12px;">Kondisi</th>
                            <th style="color: #000000; padding: 12px;">Denda</th>
                            <th style="color: #000000; padding: 12px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengembalians as $pengembalian)
                        <tr style="border-bottom: 1px solid #FFE69C;">
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge-yellow">#{{ $pengembalian->id }}</span>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-qrcode me-1" style="color: #FDB931;"></i>
                                <strong>{{ $pengembalian->peminjaman->kode_peminjaman }}</strong>
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i> {{ $pengembalian->peminjaman->user->name }}
                                </small>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <i class="fas fa-calendar-check me-1" style="color: #FDB931;"></i>
                                {{ $pengembalian->tanggal_kembali->format('d/m/Y') }}
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i> {{ $pengembalian->tanggal_kembali->format('H:i') }}
                                </small>
                            </td>
                            <td style="color: #000000; padding: 12px;">
                                <span class="badge-yellow">
                                    <i class="fas fa-box me-1"></i> {{ $pengembalian->jumlah_kembali }}
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                @php
                                    $kondisiColors = [
                                        'baik' => '#28a745',
                                        'rusak_ringan' => '#FFD700',
                                        'rusak_berat' => '#dc3545'
                                    ];
                                    $kondisiTextColors = [
                                        'baik' => '#FFFFFF',
                                        'rusak_ringan' => '#000000',
                                        'rusak_berat' => '#FFFFFF'
                                    ];
                                    $kondisiIcons = [
                                        'baik' => 'fa-check-circle',
                                        'rusak_ringan' => 'fa-exclamation-triangle',
                                        'rusak_berat' => 'fa-times-circle'
                                    ];
                                @endphp
                                <span class="badge" style="background-color: {{ $kondisiColors[$pengembalian->kondisi] ?? '#6c757d' }}; color: {{ $kondisiTextColors[$pengembalian->kondisi] ?? '#FFFFFF' }}; padding: 6px 12px; border-radius: 6px;">
                                    <i class="fas {{ $kondisiIcons[$pengembalian->kondisi] ?? 'fa-info-circle' }} me-1"></i>
                                    {{ ucfirst(str_replace('_', ' ', $pengembalian->kondisi)) }}
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                @if($pengembalian->denda > 0)
                                <span class="text-danger">
                                    <i class="fas fa-money-bill me-1"></i>
                                    <strong>Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}</strong>
                                </span>
                                @else
                                <span class="text-success">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Tidak Ada Denda
                                </span>
                                @endif
                            </td>
                            <td style="padding: 12px;">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.pengembalian.show', $pengembalian) }}" class="btn-yellow btn-sm" 
                                       style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: #FFFFFF;">
                                        <i class="fas fa-eye me-1"></i>
                                    </a>
                                    <a href="{{ route('admin.pengembalian.edit', $pengembalian) }}" class="btn-yellow btn-sm ms-1"
                                       style="background: linear-gradient(135deg, #FFD700 0%, #FDB931 100%); color: #000000;">
                                        <i class="fas fa-edit me-1"></i>
                                    </a>
                                    <form action="{{ route('admin.pengembalian.destroy', $pengembalian) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data pengembalian untuk peminjaman {{ $pengembalian->peminjaman->kode_peminjaman }}?')"
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
                {{ $pengembalians->links() }}
            </div>
            @else
            <div class="alert-yellow text-center py-5">
                <i class="fas fa-inbox fa-4x mb-3" style="color: #FDB931;"></i>
                <h4 style="color: #000000;">Tidak ada data pengembalian</h4>
                <p style="color: #666;">Belum ada pengembalian yang terdaftar dalam sistem.</p>
                <a href="{{ route('admin.pengembalian.create') }}" class="btn-yellow mt-2">
                    <i class="fas fa-plus me-1"></i> Tambah Pengembalian Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection

