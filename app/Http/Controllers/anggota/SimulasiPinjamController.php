<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SimulasiPinjamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('template.development-anggota');
    }
}
