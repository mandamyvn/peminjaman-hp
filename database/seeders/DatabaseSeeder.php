<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Alat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create users
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'petugas'
        ]);

        User::create([
            'name' => 'Peminjam',
            'email' => 'peminjam@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'peminjam',
            'nim' => '12345678',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Contoh No. 123'
        ]);

        // Create kategoris
        $kategoris = [
            ['nama_kategori' => 'Laptop', 'deskripsi' => 'Perangkat laptop'],
            ['nama_kategori' => 'Smartphone', 'deskripsi' => 'Perangkat smartphone'],
            ['nama_kategori' => 'Tablet', 'deskripsi' => 'Perangkat tablet'],
            ['nama_kategori' => 'Projector', 'deskripsi' => 'Alat proyektor'],
            ['nama_kategori' => 'Kamera', 'deskripsi' => 'Alat kamera digital'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }

        // Create alats
        $alats = [
            [
                'kode_alat' => 'LAP001',
                'nama_alat' => 'Laptop Asus',
                'kategori_id' => 1,
                'merk' => 'Asus',
                'spesifikasi' => 'i5, 8GB RAM, 512GB SSD',
                'stok' => 5,
                'status' => 'tersedia'
            ],
            [
                'kode_alat' => 'HP001',
                'nama_alat' => 'Samsung Galaxy S21',
                'kategori_id' => 2,
                'merk' => 'Samsung',
                'spesifikasi' => '128GB, 8GB RAM',
                'stok' => 3,
                'status' => 'tersedia'
            ],
            [
                'kode_alat' => 'TAB001',
                'nama_alat' => 'iPad Air',
                'kategori_id' => 3,
                'merk' => 'Apple',
                'spesifikasi' => '64GB, 10.9 inch',
                'stok' => 2,
                'status' => 'tersedia'
            ],
        ];

        foreach ($alats as $alat) {
            Alat::create($alat);
        }
    }
}