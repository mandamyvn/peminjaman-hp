<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
   public function index()
{
    // 🔥 INI YANG WAJIB
    $peminjamans = Peminjaman::with(['user', 'alat'])
        ->where('status', 'menunggu_pengembalian')
        ->latest()
        ->paginate(10);

    $pengembalians = Pengembalian::with(['peminjaman', 'diterimaOleh'])
        ->latest()
        ->paginate(10);

    return view('petugas.pengembalian.index', compact(
        'peminjamans',
        'pengembalians'
    ));
}



 public function store(Request $request, Peminjaman $peminjaman)
{
    $request->validate([
        'tanggal_kembali' => 'required|date',
        'jumlah_kembali' => 'required|integer|min:1|max:' . $peminjaman->jumlah,
        'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
        'denda_terlambat' => 'nullable|numeric|min:0',
        'denda_kerusakan' => 'nullable|numeric|min:0',
        'keterangan' => 'nullable|string'
    ]);

    $dendaTotal =
        ($request->denda_terlambat ?? 0) +
        ($request->denda_kerusakan ?? 0);

    Pengembalian::create([
        'peminjaman_id' => $peminjaman->id,
        'tanggal_kembali' => $request->tanggal_kembali,
        'jumlah_kembali' => $request->jumlah_kembali,
        'kondisi' => $request->kondisi,
        'denda' => $dendaTotal,
        'keterangan' => $request->keterangan,
        'diterima_oleh' => Auth::id()
    ]);

    $peminjaman->update([
        'status' => 'selesai'
    ]);

    return redirect()->route('petugas.pengembalian.index')
        ->with('success', 'Pengembalian berhasil diproses');
}

public function struk(Pengembalian $pengembalian)
{
    $pengembalian->load(
        'peminjaman.user',
        'peminjaman.alat'
    );

    return view(
        'petugas.pengembalian.struk',
        compact('pengembalian')
    );
}

}