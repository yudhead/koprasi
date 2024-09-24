<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahDataPenggunaController extends Controller
{
    public function DataPengguna(){
        return view('LayoutBendahara.DataPengguna');
    }
}
