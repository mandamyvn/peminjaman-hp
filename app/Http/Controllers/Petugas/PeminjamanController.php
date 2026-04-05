<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
{
    $peminjamans = Peminjaman::with(['user', 'alat'])
        ->latest()
        ->paginate(10);

    return view('petugas.peminjaman.index', compact('peminjamans'));
}

    public function show(Peminjaman $peminjaman)
    {
        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    public function approve(Request $request, Peminjaman $peminjaman)
{
    DB::transaction(function () use ($request, $peminjaman) {

        $alat = Alat::lockForUpdate()->findOrFail($peminjaman->alat_id);

      if ($alat->stok < $peminjaman->jumlah) {
            throw new \Exception('Stok tidak mencukupi');
        }

        $peminjaman->update([
            'status' => 'disetujui',
            'disetujui_oleh' => Auth::id(),
            'catatan_admin' => $request->catatan_admin
        ]);

        // 🔴 KURANGI STOK
        $alat->decrement('stok', $peminjaman->jumlah);
    });

    return redirect()->back()->with('success', 'Peminjaman disetujui');
}

   public function reject(Request $request, Peminjaman $peminjaman)
{
    $peminjaman->update([
        'status' => 'ditolak',
        'disetujui_oleh' => Auth::id(),
        'catatan_admin' => $request->catatan_admin
    ]);

    return redirect()->back()->with('success', 'Peminjaman ditolak');
}

    // PERBAIKAN: Sesuaikan nama method dengan route
  public function markAsBorrowed(Peminjaman $peminjaman)
{
    if ($peminjaman->status !== 'disetujui') {
        return back()->with('error', 'Harus disetujui dulu');
    }

    $peminjaman->update([
        'status' => 'dipinjam'
    ]);

    return back()->with('success', 'Status menjadi dipinjam');
}
}