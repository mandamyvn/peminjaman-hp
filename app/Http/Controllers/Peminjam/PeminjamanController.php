<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
            'jumlah' => 'required|integer|min:1',
            'keperluan' => 'required|string|min:10',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok < $request->jumlah) {
            return back()->with('error','Stok alat tidak mencukupi');
        }

        Peminjaman::create([
            'kode_peminjaman' => 'PMJ-'.time(),
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah' => $request->jumlah,
            'keperluan' => $request->keperluan,
            'status' => 'menunggu'
        ]);

        return redirect()->route('peminjam.peminjaman.index')
            ->with('success','Peminjaman berhasil diajukan dan menunggu persetujuan petugas');
    }

    public function cancel(Peminjaman $peminjaman)
    {
        if ($peminjaman->user_id != Auth::id()) {
            abort(403);
        }

        if ($peminjaman->status != 'menunggu') {
            return back()->with('error','Peminjaman yang sudah diproses tidak bisa dibatalkan');
        }

        $peminjaman->update([
            'status' => 'ditolak'
        ]);

        return redirect()->route('peminjam.peminjaman.index')
            ->with('success','Peminjaman berhasil dibatalkan');
    }

    public function show(Peminjaman $peminjaman)
{
    // pastikan hanya pemilik yang bisa lihat
    if ($peminjaman->user_id != Auth::id()) {
        abort(403);
    }

    $peminjaman->load('alat.kategori','user');

    return view('peminjam.peminjaman.show', compact('peminjaman'));
}
}