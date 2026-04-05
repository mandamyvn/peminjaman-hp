<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'kategori_id',
        'merk',
        'spesifikasi',
        'stok',
        'harga_sewa_perhari',
        'status',
        'deskripsi',
        'gambar'
    ];

    protected $casts = [
        'stok' => 'integer'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function getStokTersediaAttribute()
    {
        $dipinjam = $this->peminjamans()
            ->whereIn('status', ['disetujui', 'dipinjam'])
            ->sum('jumlah');
        
        return $this->stok - $dipinjam;
    }
}