<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('alat_id')->constrained('alats');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->integer('jumlah');
            $table->text('keperluan');
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'dipinjam', 'selesai']);
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};