<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogAktifitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktifitas';

    protected $fillable = [
        'user_id',
        'aksi',
        'deskripsi',
        'ip_address',
        'user_agent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}