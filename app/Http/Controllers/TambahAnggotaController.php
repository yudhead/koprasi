<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Untuk mengenkripsi password
use App\Models\Role;
class TambahAnggotaController extends Controller
{
    public function index() {
        // Ambil semua data anggota dari database
        $anggota = User::all(); // Dapatkan data anggota dari model

        // Kirim data ke view
        return view('LayoutSekertaris.anggota', compact('anggota'));
    }

    public function create()
    {
        // Fetch all roles from the roles table
        $roles = Role::all();

        return view('LayoutSekertaris.anggota-create', compact('roles'));
    }

    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role_id' => 'required|exists:roles,id',  // Ensure the role_id exists in the roles table
    ]);

    // Create a new user with the role
    User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'role_id' => $request->input('role_id'),  // Store the role_id
    ]);

    return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan');
}

    public function edit($id) {
        // Menampilkan form edit user
        $anggota = user::findOrFail($id); // Menangani jika ID tidak ditemukan
        return view('LayoutSekertaris.anggota-edit', compact('anggota'));
    }

    public function update(Request $request, $id) {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,id,' . $id, // Mengabaikan email anggota ini sendiri
            'password' => 'nullable|string|min:8', // Password opsional saat update
            'role' => 'required|string',
        ]);

        $anggota = user::findOrFail($id);

        // Update data anggota
        $anggota->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $anggota->password, // Jika password diisi, enkripsi, jika tidak biarkan tetap
            'role' => $request->role,
        ]);

        return redirect('LayoutSekertaris.anggota')->with('success', 'user berhasil diperbarui.');
    }

    public function destroy($id) {
        // Hapus anggota
        $anggota = user::findOrFail($id); // Menangani jika ID tidak ditemukan
        $anggota->delete();

        return redirect('LayoutSekertaris.anggota')->with('success', 'Anggota berhasil dihapus.');
    }
}
