<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\jf_pinjam;
use App\Models\group_anggota;
use App\Models\GroupModel;
use App\Models\JfPinjamApprovalByNazhir;
use App\Models\NazhirModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\JfTrackingPinjamanAnggota;
class NazhirController extends Controller
{
    public function index(){
        return view('admin.approval-nazhir');
    }

    public function dataApprove(Request $request)
    {
        $data = DB::table('jf_pinjam')->select(
            'jf_pinjam.*',
            'jf_pinjam.created_at',
            'jf_group.name',
            'pa_duta_wakaf.duta_name'
        )
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->join('jf_group', 'jf_group_anggota.group_id', '=', 'jf_group.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')->get();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-info detail-ajuan' data-id='$data->id' style='color:white;' title='Perijinan Anda'>
                    <i class='fas fa-user-plus'></i></a>
                    <a role='button' class='btn-sm btn-primary' style='color:white;' title='Semua Perijinan' href='/admin/detail-request-pinjam/" . $data->id . "'>
                    <i class='fas fa-users'></i></a>
                    ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
                // <a role='button' class='btn-sm btn-danger hapus' data-id='$data->id' style='color:white;' title='Hapus'>
                // <i class='fas fa-trash'></i></a>
        }
    }

    public function select2Nazhir(Request $request){
        $data      = NazhirModel::query();
        $data      = $data->orderBy('nazhir_name', 'ASC');
        $last_page = null;

        if ($request->has('search') && $request->search != '') {
            // Apply search param
            $data = $data->where('nazhir_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('page')) {
            // If request has page parameter, add paginate to eloquent
            $data->paginate(10);
            // Get last page
            $last_page = $data->paginate(10)->lastPage();
        }

        return response()->json([
            'status'    => 200,
            'message'   => 'Data Fetched',
            'last_page' => $last_page,
            'data'      => $data->get(),
        ]);
    }

    public function detailRequestPinjamAnggota($id)
    {
        // new query
        $data_pinjam = DB::table('jf_pinjam')->where('jf_pinjam.id', $id)
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->select('pa_duta_wakaf.duta_name as name_requester', 'jf_pinjam.*')->first();

        $data_tracking_pinjam = JfTrackingPinjamanAnggota::where('pinjam_id', $id)->first();

        $data_pinjam_approval_nazhir = DB::table('jf_pinjam')->where('jf_pinjam.id', $id)
        ->join('jf_pinjam_approval_by_nazhir', 'jf_pinjam.id', '=', 'jf_pinjam_approval_by_nazhir.pinjam_id')
        ->join('pa_nazhir', 'jf_pinjam_approval_by_nazhir.nazhir_id', '=', 'pa_nazhir.id')
        ->select('pa_nazhir.nazhir_name as name', 'jf_pinjam_approval_by_nazhir.status', 'jf_pinjam_approval_by_nazhir.note', 'jf_pinjam_approval_by_nazhir.accepted_at')
        ->get();

        $data['data_pinjam'] = $data_pinjam;
        $data['data_tracking_pinjam'] = $data_tracking_pinjam;
        $data['data_pinjam_approval_nazhir'] = $data_pinjam_approval_nazhir;

        // dd($data);

        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data,
                'message' => 'Data Fetched',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'data' => null,
                'message' => 'Data Not Found',
            ]);
        }
    }

    public function editApprovalPinjam($id){
        $data = DB::table('jf_pinjam_approval_by_nazhir')->where('id', $id)->first();
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

    public function createUpdateApprovalPinjam(Request $request){

        if ($request->nazhir_id == '' || $request->nazhir_id == null){
            return response()->json([
                'status' => 400,
                'message' => 'Nama nazhir tidak boleh kosong',
            ]);
        }

        if ($request->status_next == '' || $request->status_next == null){
            return response()->json([
                'status' => 400,
                'message' => 'Status tidak boleh kosong',
            ]);
        }

        // checking if has approved by nazhir
        $has_approved_by_nazhir = DB::table('jf_pinjam_approval_by_nazhir')->where('pinjam_id', $request->pinjam_id)->first();
        if ($has_approved_by_nazhir){
            return response()->json([
                'status' => 400,
                'message' => 'Pinjaman ini sudah approved by nazhir',
            ]);

            // checking if pinjam is approved nazhir or not yet
            $pinjam = DB::table('jf_pinjam_approval_by_nazhir')->where('pinjam_id', $request->pinjam_id)->where('nazhir_id', $request->nazhir_id)->first();
            if ($pinjam){
                return response()->json([
                    'status' => 400,
                    'message' => 'Nazhir sudah melakukan approval',
                ]);
            }
        }


        // set if note is null or filled
        $note = null;
        if ($request->note){
            $note = $request->note;
        }

        JfPinjamApprovalByNazhir::updateOrCreate(
            [
                'pinjam_id' => $request->pinjam_id,
            ],
            [
                'nazhir_id' => $request->nazhir_id,
                'status' => $request->status_next,
                'note' => $note,
                'accepted_at' => Carbon::now()
            ]
        );

        // add log to tracking
        app('App\Http\Controllers\TrackingPinjamanAnggotaController')->addUpdateTrackingPinjam($request->pinjam_id, null, null, null, Carbon::now());

        return response()->json([
            'status' => 200,
            'message' => 'Data success stored'
        ]);

    }

    public function removeApprovalPinjam($id){
        $data_approval = DB::table('jf_pinjam_approval_by_nazhir')->where('íd', $id)->first();

        if ($data_approval) {
            $data_approval->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data deleted'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Bad request'
            ]);
        }
    }
}
