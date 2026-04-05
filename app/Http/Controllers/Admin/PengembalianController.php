<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
   public function index()
{
    $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])
        ->latest()
        ->paginate(10);

    return view('admin.pengembalian.index', compact('pengembalians'));
}

    public function create()
    {
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        return view('admin.pengembalian.create', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_kembali' => 'required|date',
            'jumlah_kembali' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'keterangan' => 'nullable|string',
            'denda' => 'nullable|numeric|min:0'
        ]);

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah_kembali' => $request->jumlah_kembali,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
            'denda' => $request->denda ?? 0,
            'diterima_oleh' => Auth::id()
        ]);

        // Update status peminjaman
        $peminjaman = Peminjaman::find($request->peminjaman_id);
        $peminjaman->update(['status' => 'selesai']);

        // Update status alat
        $alat = $peminjaman->alat;
        if ($request->kondisi === 'rusak_berat') {
            $alat->update(['status' => 'rusak']);
        } else {
            $alat->update(['status' => 'tersedia']);
        }

        // Log aktivitas
        LogAktifitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'CREATE',
            'deskripsi' => 'Mencatat pengembalian untuk peminjaman: ' . $peminjaman->kode_peminjaman,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        return redirect()->route('admin.pengembalian.index')
            ->with('success', 'Pengembalian berhasil dicatat');
    }

    public function show(Pengembalian $pengembalian)
    {
        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    public function edit(Pengembalian $pengembalian)
    {
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        return view('admin.pengembalian.edit', compact('pengembalian', 'peminjamans'));
    }

    public function update(Request $request, Pengembalian $pengembalian)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_kembali' => 'required|date',
            'jumlah_kembali' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'keterangan' => 'nullable|string',
            'denda' => 'nullable|numeric|min:0'
        ]);

        $pengembalian->update([
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah_kembali' => $request->jumlah_kembali,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
            'denda' => $request->denda ?? 0
        ]);

        // Update status alat berdasarkan kondisi baru
        $peminjaman = Peminjaman::find($request->peminjaman_id);
        $alat = $peminjaman->alat;
        
        if ($request->kondisi === 'rusak_berat') {
            $alat->update(['status' => 'rusak']);
        } else {
            $alat->update(['status' => 'tersedia']);
        }

        // Log aktivitas
        LogAktifitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'UPDATE',
            'deskripsi' => 'Memperbarui data pengembalian untuk peminjaman: ' . $peminjaman->kode_peminjaman,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        return redirect()->route('admin.pengembalian.index')
            ->with('success', 'Pengembalian berhasil diperbarui');
    }

    public function destroy(Pengembalian $pengembalian)
    {
        $peminjaman = $pengembalian->peminjaman;
        $kode_peminjaman = $peminjaman->kode_peminjaman;
        
        // Kembalikan status peminjaman dan alat
        $peminjaman->update(['status' => 'dipinjam']);
        $alat = $peminjaman->alat;
        $alat->update(['status' => 'dipinjam']);

        $pengembalian->delete();

        // Log aktivitas
        LogAktifitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'DELETE',
            'deskripsi' => 'Menghapus data pengembalian untuk peminjaman: ' . $kode_peminjaman,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent')
        ]);

        return redirect()->route('admin.pengembalian.index')
            ->with('success', 'Pengembalian berhasil dihapus');
    }
}