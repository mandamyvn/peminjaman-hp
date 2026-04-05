<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;

class LogAktifitasController extends Controller
{
    public function index(Request $request)
    {
        $query = LogAktifitas::with('user')->latest();
        
        // Filter berdasarkan user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        // Filter berdasarkan tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        // Filter berdasarkan aksi
        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }

        $logs = $query->paginate(20);
        
        return view('admin.log-aktifitas.index', compact('logs'));
    }

    public function show(LogAktifitas $logAktifitas)
    {
        return view('admin.log-aktifitas.show', compact('logAktifitas'));
    }
}