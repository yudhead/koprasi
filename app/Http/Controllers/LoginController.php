<?php

namespace App\Http\Controllers;

use App\Models\Role; // Import Role model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ensure Auth facade is imported

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');  // Mengarahkan ke view login
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to login with the credentials provided
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();  // Get the authenticated user

            // Check the role_id to redirect to the appropriate dashboard
            switch ($user->role_id) {
                case Role::SEKERTARIS:
                    return redirect()->route('sekertaris.dashboard')->with('success', 'Login successful!');
                case Role::ANGGOTA:
                    return redirect()->route('anggota.dashboard')->with('success', 'Login successful!');
                case Role::KETUA:
                    return redirect()->route('ketua.dashboard')->with('success', 'Login successful!');
                case Role::WAKIL_KETUA:
                    return redirect()->route('wakil_ketua.dashboard')->with('success', 'Login successful!');
                case Role::PENGAWAS:
                    return redirect()->route('pengawas.dashboard')->with('success', 'Login successful!');
                case Role::BENDAHARA:
                    return redirect()->route('bendahara.dashboard')->with('success', 'Login successful!');
                default:
                    Auth::logout(); // Log the user out if the role is not recognized
                    return redirect()->route('login')->withErrors(['role' => 'Role not recognized.']);
            }
        }

        // Jika gagal login, redirect back dengan error message
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
