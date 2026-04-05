<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjamans');
            $table->date('tanggal_kembali');
            $table->integer('jumlah_kembali');
            $table->enum('kondisi', ['baik', 'rusak_ringan', 'rusak_berat']);
            $table->text('keterangan')->nullable();
            $table->decimal('denda', 10, 2)->default(0);
            $table->foreignId('diterima_oleh')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};