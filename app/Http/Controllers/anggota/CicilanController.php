<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CicilanModel;
use App\Models\jf_pinjam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CicilanController extends Controller
{
    public function index($id){
        $data= CicilanModel::findOrFail($id);
        return view ('backoffice/pengajuanpinjam/detailajuanpinjam')->with(['data' => $data,'id'=>$id]);
    }

    public function edit($id){
        $data = CicilanModel::find($id);
        return view('backoffice/riwayatpeminjaman/editdata')->with(['editcicil' => $data,'id'=>$id]);
    }

    public function update($id, Request $request){
        $editcicil = CicilanModel::find($id);

        $editcicil->nominal   = $request->input('nominal');

        $editcicil->update();
        return view('backoffice/pengajuanpinjam/pengajuanpinjam');
        return back()->with('succes','Data Berhasil Di Edit');
    }

    public function detail($id){
        $data= CicilanModel::findOrFail($id);
        //dd($data);
       return view('backoffice/riwayatpeminjaman/detailcicil')->with(['data' => $data,'id'=>$id]);
    }

    public function addCicil(){
        $ket=jf_pinjam::all();
        return view('backoffice/riwayatpeminjaman/tambahCicilan', compact('ket'));
    }

    public function createCicilan(Request $request){
        // NEED MANY ADJUSTMENT IN BE-FE, on BE simplify code, on FE change with modal and current bayar cicil is strict depend on pinjaman selected
        $cicilan = Validator::make($request->all(), [
            'nominal' => 'required',
            'note' => 'required',
            'bukti_cicil' => 'file|max:1024',
        ]);

        // return $request->all();

        if ($cicilan->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'Bad request',
                'errors' => $cicilan->errors()
            ]);
        }

        $validatedData = $request->validate([
            'nominal' => 'required',
            'note' => 'required',
            'bukti_cicil' => 'file|max:1024',
        ]);

        if ($request->file('bukti_cicil')) {
            $validatedData['file'] = $request->file('bukti_cicil')->store('/');
            $request->file('bukti_cicil')->move(public_path().'/img/bukti-cicilan', $request->file('bukti_cicil')->store('bukti-cicilan'));
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Bad request',
                'errors' => $cicilan->errors()->add('bukti_cicil', 'Bukti cicil wajib diisi!')
            ]);
        }

        $validatedData['nominal'] = (int)str_replace(['Rp. ', '.', ','], '', $request->nominal);
        $validatedData['pinjam_id'] = $request->pinjam_id;
        $validatedData['note_internal'] = $request->note;
        $validatedData['is_valid'] = 2; //default valid:1, invalid:0, else:request

        // $file = $request->bukti_cicil;
        // $name_file = $file->getClientOriginalName();
        // $validatedData['file'] = $request->file('bukti_cicil')->store('bukti-cicilan');

        CicilanModel::create($validatedData);


        // $cicil = new CicilanModel;
        // $cicil->pinjam_id =  $request->pinjam_id;
        // $cicil->nominal =  $request->nominal;
        // $cicil->is_valid =  2; //default valid:1, invalid:0, else:request
        // $cicil->note_internal =  $request->note;
        // $cicil->bukti_cicil =  $name_file;
        // $file->move(public_path().'/img/bukti-cicilan', $name_file);
        // $cicil->save();

        return response()->json([
            'status' => 200,
            'message' => 'Data success stored'
        ]);
    }

    public function dataListCicilan(Request $request, $id){
        $data = DB::table('jf_cicilan')
        ->where('jf_cicilan.pinjam_id', $id)
        ->select(
            'jf_cicilan.id',
            'jf_cicilan.nominal',
            'jf_cicilan.note_internal as desc_cicilan',
            'jf_cicilan.created_at',
            'jf_cicilan.is_valid as status',
            'jf_cicilan.note_admin',
            'jf_cicilan.approval_at'
        )
        ->get();

        // dd($data);

        if ($request->ajax()) {

            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-info detail-cicilan' title='Detail' data-id='$key->id' style='color:white;'>
                    <i class='fas fa-eye'></i></a>
                    </button>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function detailCicilan($id){
        $data = DB::table('jf_cicilan')->where('id', $id)
        // ->join('jf_pinjam', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
        ->select(
            'jf_cicilan.id',
            'jf_cicilan.nominal',
            'jf_cicilan.note_internal',
            'jf_cicilan.created_at',
            'jf_cicilan.is_valid as status',
            'jf_cicilan.note_admin',
            'jf_cicilan.approval_at',
            'jf_cicilan.file'
        )
        ->first();

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Data fetched',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found'
            ]);
        }
    }

}
