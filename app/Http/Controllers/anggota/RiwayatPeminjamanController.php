<?php

namespace App\Http\Controllers\anggota;

use App\Models\CicilanModel;
use App\Http\Controllers\Controller;
use App\Models\jf_pinjam;
use App\Models\jf_pinjam_approval;
use App\Models\group_anggota;
use Illuminate\Http\Request;
use DB;

class RiwayatPeminjamanController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        // $this->RiwayatPeminjaman = new RiwayatPeminjamanController();
    }

    public function input()
    {
        return view('backoffice/riwayatpeminjaman/');
    }

    public function index()
    {
        $duta_wakaf_id = auth()->user()->id;
        $group_anggota = group_anggota::where('duta_wakaf_id', $duta_wakaf_id)->where('status', '1')->first();
        $group_anggota_id = $group_anggota->group_id;
        $riwayat = jf_pinjam::where('group_anggota_id', $group_anggota_id)->get();
        // dd($riwayat);
        return view('backoffice.riwayatpeminjaman.index', compact('riwayat'));
    }

    public function delete($id)
    {
        $data = jf_pinjam::find($id);
        $data->delete();
        return redirect('backoffice/riwayatpeminjaman');
            return back()->with('success','berhasil');
    }

}
