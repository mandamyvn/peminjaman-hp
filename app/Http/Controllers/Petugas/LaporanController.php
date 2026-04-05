<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Alat;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->start_date ?? date('Y-m-01');
        $end_date = $request->end_date ?? date('Y-m-t');
        
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->whereBetween('tanggal_pinjam', [$start_date, $end_date])
            ->latest()
            ->paginate(20);
            
        $pengembalians = Pengembalian::with(['peminjaman', 'diterimaOleh'])
            ->whereBetween('tanggal_kembali', [$start_date, $end_date])
            ->latest()
            ->paginate(20);
            
        $total_peminjaman = Peminjaman::whereBetween('tanggal_pinjam', [$start_date, $end_date])->count();
        $total_pengembalian = Pengembalian::whereBetween('tanggal_kembali', [$start_date, $end_date])->count();
        $total_denda = Pengembalian::whereBetween('tanggal_kembali', [$start_date, $end_date])->sum('denda');
        
        return view('petugas.laporan.index', compact(
            'peminjamans',
            'pengembalians',
            'total_peminjaman',
            'total_pengembalian',
            'total_denda',
            'start_date',
            'end_date'
        ));
    }

    public function cetak(Request $request)
    {
        $start_date = $request->start_date ?? date('Y-m-01');
        $end_date = $request->end_date ?? date('Y-m-t');
        $type = $request->type ?? 'peminjaman';
        
        if ($type === 'peminjaman') {
            $data = Peminjaman::with(['user', 'alat'])
                ->whereBetween('tanggal_pinjam', [$start_date, $end_date])
                ->latest()
                ->get();
                
            $title = "Laporan Peminjaman HP";
            $view = 'petugas.laporan.cetak-peminjaman';
        } else {
            $data = Pengembalian::with(['peminjaman', 'diterimaOleh'])
                ->whereBetween('tanggal_kembali', [$start_date, $end_date])
                ->latest()
                ->get();
                
            $title = "Laporan Pengembalian HP";
            $view = 'petugas.laporan.cetak-pengembalian';
        }
        
        $total_denda = Pengembalian::whereBetween('tanggal_kembali', [$start_date, $end_date])->sum('denda');
        
        return view($view, compact('data', 'title', 'start_date', 'end_date', 'total_denda'));
    }
}