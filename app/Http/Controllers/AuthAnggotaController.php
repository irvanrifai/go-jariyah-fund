<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthAnggotaController extends Controller
{
    public function getLogin(){

        $data = [
            'title' => 'Login Anggota',
        ];
        return view('anggota.login.index', $data);
        }

    public function postLogin(Request $request){
        return view('backoffice.dashboard');
    }
}
