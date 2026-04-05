<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /* ===== DEFAULT AGAR BLADE TIDAK ERROR ===== */
        $chart_bulan = [];
        $chart_total = [];

        $data = [];

        /* ================= ADMIN ================= */
        if ($user->isAdmin()) {

            // ================= CHART PEMINJAMAN 6 BULAN =================
            $peminjamanBulanan = Peminjaman::select(
                    DB::raw('MONTH(created_at) as bulan'),
                    DB::raw('COUNT(*) as total')
                )
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $chart_bulan[] = $month->format('M');
                $chart_total[] = $peminjamanBulanan
                    ->where('bulan', $month->month)
                    ->first()
                    ->total ?? 0;
            }

            $data = [
                // INFO BOX
                'total_alat' => Alat::count(),
                'total_peminjam' => User::where('role', 'peminjam')->count(),
                'total_peminjaman' => Peminjaman::count(),
                'peminjaman_pending' => Peminjaman::where('status', 'menunggu')->count(),

                // TABLE
                'recent_peminjaman' => Peminjaman::with(['user', 'alat'])
                    ->latest()
                    ->take(5)
                    ->get(),

                // STATUS ALAT
                'alat_tersedia' => Alat::where('status', 'tersedia')->count(),
                'alat_dipinjam' => Alat::where('status', 'dipinjam')->count(),
                'alat_rusak'    => Alat::where('status', 'rusak')->count(),

                // CHART
                'chart_bulan' => $chart_bulan,
                'chart_total' => $chart_total,
            ];
        }

        /* ================= PETUGAS ================= */
        elseif ($user->isPetugas()) {

            $data = [
    'total_peminjaman' => Peminjaman::count(),

    'peminjaman_pending' => Peminjaman::where('status', 'menunggu')->count(),

    'peminjaman_aktif' => Peminjaman::whereIn('status', ['disetujui', 'dipinjam'])->count(),

    'pengembalian_belum' => Peminjaman::where('status', 'dipinjam')->count(),

    'recent_peminjaman' => Peminjaman::with(['user', 'alat'])
        ->where('status', 'menunggu')
        ->latest()
        ->take(5)
        ->get(),

];
        }

        /* ================= PEMINJAM ================= */
        else {

            $data = [
                'total_peminjaman' => Peminjaman::where('user_id', $user->id)->count(),

                'peminjaman_aktif' => Peminjaman::where('user_id', $user->id)
                    ->whereIn('status', ['disetujui', 'dipinjam'])
                    ->count(),

                'peminjaman_selesai' => Peminjaman::where('user_id', $user->id)
                    ->where('status', 'selesai')
                    ->count(),

                'jatuh_tempo' => Peminjaman::where('user_id', $user->id)
                    ->where('status', 'dipinjam')
                    ->whereDate('tanggal_kembali', '<', now())
                    ->count(),

                'total_denda' => Pengembalian::whereHas('peminjaman', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->sum('denda'),

                'recent_peminjaman' => Peminjaman::with('alat')
                    ->where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get(),

                // 🔑 KIRIM DEFAULT CHART
                'chart_bulan' => $chart_bulan,
                'chart_total' => $chart_total,
            ];
        }

        return view('dashboard', $data);
    }
}
