<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\User;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
   public function index()
{
    $peminjamans = Peminjaman::with(['user','alat','disetujuiOleh'])
        ->latest()
        ->paginate(10);

    return view('admin.peminjaman.index', compact('peminjamans'));
}

    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::where('status', 'tersedia')->get();

        return view('admin.peminjaman.create', compact('users', 'alats'));
    }

    public function store(Request $request)
{
    $request->validate([
        'alat_id' => 'required|exists:alats,id',
        'tanggal_pinjam' => 'required|date|after_or_equal:today',
        'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        'jumlah' => 'required|integer|min:1',
        'keperluan' => 'required|string|min:10',
    ]);

    DB::beginTransaction();

    try {

        $alat = Alat::lockForUpdate()->findOrFail($request->alat_id);

        if ($alat->stok_tersedia < $request->jumlah) {
            return back()->with('error','Stok tidak mencukupi')->withInput();
        }

        $kode = 'PMJ-' . now()->format('YmdHis');

        Peminjaman::create([
            'kode_peminjaman' => $kode,
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah' => $request->jumlah,
            'keperluan' => $request->keperluan,
            'status' => 'pending'
        ]);

        DB::commit();

        return redirect()->route('peminjam.peminjaman.index')
            ->with('success','Peminjaman berhasil diajukan');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error',$e->getMessage());
    }
}

    public function show(Peminjaman $peminjaman)
    {
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::all();

        return view('admin.peminjaman.edit', compact('peminjaman', 'users', 'alats'));
    }

   public function update(Request $request, Peminjaman $peminjaman)
{
    $request->validate([
        'user_id'          => 'required|exists:users,id',
        'alat_id'          => 'required|exists:alats,id',
        'tanggal_pinjam'   => 'required|date',
        'tanggal_kembali'  => 'required|date|after:tanggal_pinjam',
        'jumlah'           => 'required|integer|min:1',
        'keperluan'        => 'required|string',
        'status'           => 'required|in:pending,disetujui,ditolak,dipinjam,selesai',
        'catatan_admin'    => 'nullable|string',
    ]);

    DB::transaction(function () use ($request, $peminjaman) {
        $statusLama = $peminjaman->status;
        $alatLamaId = $peminjaman->alat_id;
        $alatBaruId = $request->alat_id;

        // Kembalikan status alat lama jika perlu
        if ($alatLamaId != $alatBaruId) {
            // Kembalikan alat lama ke tersedia
            Alat::where('id', $alatLamaId)->update(['status' => 'tersedia']);
        }

        // Update data peminjaman
        $peminjaman->update([
            'user_id'         => $request->user_id,
            'alat_id'         => $alatBaruId,
            'tanggal_pinjam'  => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah'          => $request->jumlah,
            'keperluan'       => $request->keperluan,
            'status'          => $request->status,
            'disetujui_oleh'  => in_array($request->status, ['disetujui','dipinjam']) ? Auth::id() : $peminjaman->disetujui_oleh,
            'catatan_admin'   => $request->catatan_admin,
        ]);

        // Update status alat baru berdasarkan status peminjaman
        if (in_array($request->status, ['disetujui', 'dipinjam'])) {
            Alat::where('id', $alatBaruId)->update(['status' => 'dipinjam']);
        } elseif (in_array($request->status, ['ditolak', 'selesai', 'pending'])) {
            // Jika status ditolak/selesai/pending, kembalikan alat ke tersedia
            // Tapi hanya jika tidak ada peminjaman lain yang sedang menggunakan alat ini
            $cekPeminjamanLain = Peminjaman::where('alat_id', $alatBaruId)
                ->whereIn('status', ['disetujui', 'dipinjam'])
                ->where('id', '!=', $peminjaman->id)
                ->exists();
                
            if (!$cekPeminjamanLain) {
                Alat::where('id', $alatBaruId)->update(['status' => 'tersedia']);
            }
        }

        LogAktifitas::create([
            'user_id'    => Auth::id(),
            'aksi'       => 'UPDATE',
            'deskripsi'  => 'Update peminjaman: ' . $peminjaman->kode_peminjaman,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    });

    return redirect()
        ->route('admin.peminjaman.index')
        ->with('success', 'Peminjaman berhasil diperbarui');
}
    public function destroy(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {

            if (in_array($peminjaman->status, ['disetujui','dipinjam'])) {
                $peminjaman->alat->update(['status' => 'tersedia']);
            }

            $kode = $peminjaman->kode_peminjaman;
            $peminjaman->delete();

            LogAktifitas::create([
                'user_id'    => Auth::id(),
                'aksi'       => 'DELETE',
                'deskripsi'  => 'Menghapus peminjaman: ' . $kode,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        });

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus');
    }
}
