<?php

namespace App\Http\Controllers\anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SimulasiPinjamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->RiwayatPeminjaman = new RiwayatPeminjamanController();
    }

    public function index()
    {
        return view('template.development-anggota');
    }
}
