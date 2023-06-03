<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\jf_pinjam;
use App\Models\group_anggota;
use App\Models\GroupModel;
use App\Models\Jf_pendampingModel;
use App\Models\JfPinjamApprovalByPendampingModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\JfTrackingPinjamanAnggota;

class PendampingController extends Controller
{
    public function index(){
        return view('admin.content.approval-pendamping');
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

        // init get data from setting value of max approve by pendamping
        $max_approval = DB::table('jf_setting')->where('key', 'amount_approval_pendamping')->first()->value;

        // init empty array for item filtered
        $data_filtered = [];

        // for loop to check is request still can approved by pendamping (req done approval & status request)
        for ($i = 0; $i < count($data); $i++){
            if (count(DB::table('jf_pinjam_approval_by_pendamping')->where('pinjam_id', $data[$i]->id)->get()) < $max_approval && DB::table('jf_pinjam_approval_by_nazhir')->where('pinjam_id', $data[$i]->id)->get()->isEmpty() && $data[$i]->status == 'request'){
                array_push($data_filtered, $data[$i]);
            }
        }

        // dd($data);
        // dd($data_filtered);

        if ($request->ajax()) {
            return datatables()->of($data_filtered)
                ->addColumn('action', function ($data_filtered) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-info detail-ajuan' data-id='$data_filtered->id' style='color:white;' title='Perijinan Anda'>
                    <i class='fas fa-user-plus'></i></a>
                    <a role='button' class='btn-sm btn-primary' style='color:white;' title='Semua Perijinan' href='/admin/detail-request-pinjam/" . $data_filtered->id . "'>
                    <i class='fas fa-users'></i></a>
                    ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
                // <a role='button' class='btn-sm btn-danger hapus' data-id='$data_filtered->id' style='color:white;' title='Hapus'>
                // <i class='fas fa-trash'></i></a>
        }
    }

    public function select2Pendamping(Request $request){
        $data      = Jf_pendampingModel::query();
        $data      = $data->orderBy('name', 'ASC');
        $last_page = null;

        if ($request->has('search') && $request->search != '') {
            // Apply search param
            $data = $data->where('name', 'like', '%' . $request->search . '%');
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

        $data_pinjam_approval_pendamping = DB::table('jf_pinjam')->where('jf_pinjam.id', $id)
        ->join('jf_pinjam_approval_by_pendamping', 'jf_pinjam.id', '=', 'jf_pinjam_approval_by_pendamping.pinjam_id')
        ->join('jf_pendamping', 'jf_pinjam_approval_by_pendamping.pendamping_id', '=', 'jf_pendamping.id')
        ->select('jf_pendamping.name', 'jf_pinjam_approval_by_pendamping.status', 'jf_pinjam_approval_by_pendamping.note', 'jf_pinjam_approval_by_pendamping.accepted_at')
        ->get();

        $data['data_pinjam'] = $data_pinjam;
        $data['data_tracking_pinjam'] = $data_tracking_pinjam;
        $data['data_pinjam_approval_pendamping'] = $data_pinjam_approval_pendamping;

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
        $data = DB::table('jf_pinjam_approval_by_pendamping')->where('id', $id)->first();
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

        //  get data approval_by_pendamping only by pinjam id
         $approval_pendamping = DB::table('jf_pinjam_approval_by_pendamping')->where('pinjam_id', $request->pinjam_id)->get();

         // init get data from setting value of max approve by pendamping
         $max_approval = DB::table('jf_setting')->where('key', 'amount_approval_pendamping')->first()->value;

         if ($request->pendamping_id == '' || $request->pendamping_id == null){
            return response()->json([
                'status' => 400,
                'message' => 'Bad request',
                'errors' => 'Pendamping tidak boleh kosong'
            ]);
         }

         if ($approval_pendamping){
             //  check if approval is >= 3 cannot add anymore, if < can add
             if (count($approval_pendamping) >= $max_approval){
                 return response()->json([
                     'status' => 400,
                     'message' => 'Kuota Approval sudah terisi penuh'
                 ]);
             }

             //  check if that selected(option) to be approval this pinjam is do approve on not yet, if done cannot, if not yet can
             if (count($approval_pendamping->where('pendamping_id', $request->pendamping_id)) > 0){
                 return response()->json([
                     'status' => 400,
                     'message' => 'Pendamping terpilih sudah melakukan Approval'
                 ]);
             }
         }


         // set if note is null or filled
         $note = null;
         if ($request->note){
             $note = $request->note;
         }

         // set if note is filled or null(set value 'draft')
         $status = 'draft';
         if ($request->status_next){
             $status = $request->status_next;
         }

         JfPinjamApprovalByPendampingModel::updateOrCreate(
             [
                 // init if pinjam_id from request is exist in db do update, if doesn't exist do create new (pivot)
                 'pinjam_id' => $request->pinjam_id,
                 'pendamping_id' => $request->pendamping_id,
             ],
             [
                 // data that be update/create
                //  'pinjam_id' => $request->pinjam_id,
                //  'pendamping_id' => $request->pendamping_id,
                 'status' => $status,
                 'note' => $note,
                 'accepted_at' => Carbon::now()
             ]
         );

         // add log to tracking
        app('App\Http\Controllers\TrackingPinjamanAnggotaController')->addUpdateTrackingPinjam($request->pinjam_id, null, null, Carbon::now());

         return response()->json([
            'status' => 200,
            'message' => 'Data success stored'
         ]);

    }

    public function removeApprovalPinjam($id){
        $data_approval = DB::table('jf_pinjam_approval_by_pendamping')->where('íd', $id)->first();

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
