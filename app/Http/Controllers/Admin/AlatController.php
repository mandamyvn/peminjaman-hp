<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->latest()->paginate(10);
        return view('admin.alat.index', compact('alats'));
    }

    public function show(Alat $alat)
{
    return view('admin.alat.show', compact('alat'));
}

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_alat'   => 'required|unique:alats,kode_alat',
            'nama_alat'   => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'merk'        => 'nullable|string|max:100',
            'spesifikasi' => 'nullable|string',
            'stok'        => 'required|integer|min:1',
            'harga_sewa_perhari' => 'required|numeric|min:0',
            'status'      => 'required|in:tersedia,dipinjam,rusak',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // upload ke public/img
        if ($request->hasFile('gambar')) {
            $namaFile = time() . '_' . $request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('img'), $namaFile);
            $data['gambar'] = $namaFile; // SIMPAN NAMA FILE SAJA
        }

        Alat::create($data);

        LogAktifitas::create([
            'user_id'    => Auth::id(),
            'aksi'       => 'CREATE',
            'deskripsi'  => 'Menambahkan alat: ' . $request->nama_alat,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'kode_alat'   => 'required|unique:alats,kode_alat,' . $alat->id,
            'nama_alat'   => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'merk'        => 'nullable|string|max:100',
            'spesifikasi' => 'nullable|string',
            'stok'        => 'required|integer|min:1',
            'harga_sewa_perhari' => 'required|numeric|min:0',
            'status'      => 'required|in:tersedia,dipinjam,rusak',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            if ($alat->gambar && File::exists(public_path('img/' . $alat->gambar))) {
                File::delete(public_path('img/' . $alat->gambar));
            }

            $namaFile = time() . '_' . $request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('img'), $namaFile);
            $data['gambar'] = $namaFile;
        }

        $alat->update($data);

        LogAktifitas::create([
            'user_id'    => Auth::id(),
            'aksi'       => 'UPDATE',
            'deskripsi'  => 'Memperbarui alat: ' . $alat->nama_alat,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil diperbarui');
    }

    public function destroy(Alat $alat)
    {
        if ($alat->gambar && File::exists(public_path('img/' . $alat->gambar))) {
            File::delete(public_path('img/' . $alat->gambar));
        }

        $nama = $alat->nama_alat;
        $alat->delete();

        LogAktifitas::create([
            'user_id'    => Auth::id(),
            'aksi'       => 'DELETE',
            'deskripsi'  => 'Menghapus alat: ' . $nama,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}
