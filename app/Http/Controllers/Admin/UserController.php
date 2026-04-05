<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,petugas,peminjam',
            'nim' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nim' => $request->nim,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ]);

        // Log aktivitas
        LogAktifitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'CREATE',
            'deskripsi' => 'Menambahkan user baru: ' . $request->name . ' (' . $request->role . ')',
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,petugas,peminjam',
            'nim' => 'nullable|string|max:20',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string'
        ]);

        $data = $request->only(['name', 'email', 'role', 'nim', 'no_hp', 'alamat']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Log aktivitas
        LogAktifitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'UPDATE',
            'deskripsi' => 'Memperbarui user: ' . $user->name,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $nama_user = $user->name;
        $user->delete();

        // Log aktivitas
        LogAktifitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'DELETE',
            'deskripsi' => 'Menghapus user: ' . $nama_user,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent')
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}