<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->latest()
            ->get();
            
        $peminjaman_selesai = Peminjaman::with(['alat', 'pengembalian'])
            ->where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->latest()
            ->paginate(10);
            
        return view('peminjam.pengembalian.index', compact('peminjamans', 'peminjaman_selesai'));
    }

   // App\Http\Controllers\Peminjam\PengembalianController.php

public function store(Request $request, Peminjaman $peminjaman)
{
    if ($peminjaman->user_id !== Auth::id()) {
        return back()->with('error', 'Tidak berhak');
    }

    if ($peminjaman->status !== 'dipinjam') {
        return back()->with('error', 'Status tidak valid');
    }

    // ⬇️ INI KUNCI UTAMANYA
    $peminjaman->update([
        'status' => 'menunggu_pengembalian'
    ]);

    return redirect()->route('peminjam.pengembalian.index')
        ->with('success', 'Pengembalian diajukan. Menunggu konfirmasi petugas.');
}

}