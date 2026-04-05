<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    // 🔴 WAJIB TAMBAHKAN INI
    protected $table = 'peminjamans';

    protected $fillable = [
        'kode_peminjaman',
        'user_id',
        'alat_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'jumlah',
        'keperluan',
        'status',
        'disetujui_oleh',
        'catatan_admin'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'jumlah' => 'integer'
    ];

    // ✅ RELASI BENAR (SINGULAR)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

      public function disetujuiOleh()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }
}
