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

    public function cicilan($id){
        //$cicil  = CicilanModel::get();
        $data=DB::table('jf_pinjam')->select(
            'jf_pinjam.*',
            'jf_cicilan.nominal',
            'jf_cicilan.is_valid',
            'jf_cicilan.note_internal',
        )->where('jf_pinjam.id', $id);
        $data=$data
        ->join('jf_cicilan','jf_pinjam.id', '=', 'jf_cicilan.pinjam_id')->get();
      dd($data);
       if ($request->ajax()) { 
            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a class='btn btn-link btn-sm text-primary' title='Detail' href='/anggota/detailcicil/" . $key->id . "'>
                    <i class='fas fa-eye'></i>&nbsp;</a>
                    <a class='btn btn-link btn-sm text-primary' title='Edit' href='/anggota/editcicil/" . $key->id . "'>
                    <i class='fas fa-pen-fancy'></i>
                </button>";
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                ->toJson();
            }
    }

    public function approve(Request $request){
        $data  = jf_pinjam_approval::get();
        //dd($data);
        if ($request->ajax()) {
            //dd($data);
            return datatables()->of($data)
                ->addColumn('action', function () {})
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    /*public function detaildataajuan(Request $request, $id){
        $data  = DB::table('jf_pinjam')->find(3);
        //dd($data);
        if ($request->ajax()) {
           
            //dd($data);
            return datatables()->of($data)
                ->addColumn('detail1', function($id){
                    $detail1 = DB::table('jf_pinjam')->find(3);
                    //dd($detail);
                    return $detail1;
                })
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    </a> <a class='btn btn-link btn-sm text-primary' title='Detail' href='/anggota/detailajuanpinjam/" . $key->id . "'>
                    <i class='fas fa-eye'></i>&nbsp;</a>
                    <a class='btn btn-link btn-sm text-primary' title='Edit' href='/anggota/editajuanpinjam/" . $key->id . "'>
                    <i class='fas fa-pen-fancy'></i>&nbsp;&nbsp;</br>
                    </a> <a class='btn btn-link btn-sm text-danger' title='Hapus' href='/anggota/hapusajuanpinjam/" . $key->id . "'>
                    <i class='fas fa-trash'></i>&nbsp;</a>
                </button>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }*/

    public function totaldata(){
       // $data = jf_pinjam::count();
        //return view('backoffice/dashboard');
        //return response()->json(array($data), 200);
        //dd($data);
        $pinjam = jf_pinjam::count();
       
        return view('backoffice/dashboard')->with(['data' => $pinjam]);
    }
}