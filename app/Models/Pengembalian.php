<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengembalian extends Model
{
    use HasFactory;

    // HAPUS atau COMMENT baris ini jika ada:
    // protected $table = 'pengembalian';
    
    // Biarkan Laravel otomatis menggunakan 'pengembalians'
       protected $table = 'pengembalians'; 

    protected $fillable = [
        'peminjaman_id',
        'tanggal_kembali',
        'jumlah_kembali',
        'kondisi',
        'keterangan',
        'denda',
        'diterima_oleh'
    ];

    protected $casts = [
        'tanggal_kembali' => 'date',
        'jumlah_kembali' => 'integer',
        'denda' => 'decimal:2'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function diterimaOleh()
    {
        return $this->belongsTo(User::class, 'diterima_oleh');
    }
}