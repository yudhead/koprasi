<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index () {
        return view('LayoutAnggota.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
