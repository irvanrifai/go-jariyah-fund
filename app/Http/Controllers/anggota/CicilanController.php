<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CicilanModel;
use App\Models\jf_pinjam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CicilanController extends Controller
{
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

            // store to local system
            // $request->file('bukti_cicil')->move(public_path().'/img/bukti-cicilan', $request->file('bukti_cicil')->store('bukti-cicilan'));

            // store to DB storage server
            Storage::disk('digitalocean')->put('jariyah-fund/bukti-cicilan/'. $request->file('bukti_cicil')->store($request->pinjam_id), 'public');

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

        CicilanModel::create($validatedData);

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
