<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index(Request $request)
    {
        $query = Alat::with('kategori')->where('status', 'tersedia');
        
        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        
        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_alat', 'like', "%{$search}%")
                  ->orWhere('merk', 'like', "%{$search}%")
                  ->orWhere('kode_alat', 'like', "%{$search}%");
            });
        }
        
        $alats = $query->latest()->paginate(12);
        $kategoris = Kategori::all();
        
        return view('peminjam.alat.index', compact('alats', 'kategoris'));
    }

    public function show(Alat $alat)
    {
        // Hanya tampilkan alat yang tersedia
        if ($alat->status !== 'tersedia') {
            return redirect()->route('peminjam.alat.index')
                ->with('error', 'Alat tidak tersedia untuk dipinjam');
        }
        
        return view('peminjam.alat.show', compact('alat'));
    }
}