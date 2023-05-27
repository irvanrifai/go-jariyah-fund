<?php

namespace App\Http\Controllers;

use App\Models\StatistikModel;
use Illuminate\Http\Request;

class StatistikController extends Controller
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
