<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori',
            'deskripsi' => 'nullable|string'
        ]);

        $kategori = Kategori::create($request->all());

        // Log aktivitas
        LogAktifitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'CREATE',
            'deskripsi' => 'Menambahkan kategori baru: ' . $request->nama_kategori,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Kategori $kategori)
    {
        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategoris,nama_kategori,' . $kategori->id,
            'deskripsi' => 'nullable|string'
        ]);

        $kategori->update($request->all());

        // Log aktivitas
        LogAktifitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'UPDATE',
            'deskripsi' => 'Memperbarui kategori: ' . $kategori->nama_kategori,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        $nama_kategori = $kategori->nama_kategori;
        
        // Cek apakah kategori sedang digunakan
        if ($kategori->alats()->count() > 0) {
            return redirect()->route('admin.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh alat');
        }

        $kategori->delete();

        // Log aktivitas
        LogAktifitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'DELETE',
            'deskripsi' => 'Menghapus kategori: ' . $nama_kategori,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent')
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}