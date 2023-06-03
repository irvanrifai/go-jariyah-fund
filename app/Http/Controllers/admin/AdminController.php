<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\duta_wakaf;
use App\Models\group_anggota;
use App\Models\GroupModel;
use App\Models\NazhirModel;
use App\Models\ProjectModel;
use App\Models\jf_setting;
use App\Models\jf_pinjam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use App\Helpers\ResponseFormatter;
use App\Models\DistrictModel;
use App\Models\VillageModel;
use App\Models\CicilanModel;
use App\Models\Jf_pendampingModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\JfTrackingPinjamanAnggota;
use App\Models\jf_pinjam_approval;
use App\Models\JfPinjamApprovalByPendampingModel;

class AdminController extends Controller
{

    public function index(){
        return view('adminlte::auth\login-admin');
    }

    public function dashboard(){

        $totalkelompok = group_anggota::count();
        $totalgroup=GroupModel::count();

        $abadi=DB::table('jf_group')->select(
            'pa_project.project_target_abadi',
        );

        $abadi=$abadi
        ->join('pa_project','jf_group.project_id','=', 'pa_project.id')
        ->get();

        $dana_project_abadi=DB::select(DB::raw("select sum(project_target_abadi) as dana_project_abadi
        from jf_group JOIN pa_project
        ON jf_group.project_id=pa_project.id"));

        $charData1="";
        foreach($dana_project_abadi as $list){
            $charData1.=$list->dana_project_abadi;
        }
        $arr=rtrim($charData1);

        $kolektif=DB::table('jf_group')->select(
            'pa_project.project_target_kolektif',
        );

        $kolektif=$kolektif
        ->join('pa_project','jf_group.project_id','=', 'pa_project.id')
        ->get();

        $dana_project_kolektif=DB::select(DB::raw("select sum(project_target_kolektif) as dana_project_kolektif
        from jf_group JOIN pa_project
        ON jf_group.project_id=pa_project.id"));

        $charData2="";
        foreach($dana_project_kolektif as $list){
            $charData2.=$list->dana_project_kolektif;
        }
        $arr=rtrim($charData2);

        $berjangka=DB::table('jf_group')->select(
            'pa_project.project_target_berjangka',
        );

        $berjangka=$berjangka
        ->join('pa_project','jf_group.project_id','=', 'pa_project.id')
        ->get();

        $dana_project_berjangka=DB::select(DB::raw("select sum(project_target_berjangka) as dana_project_berjangka
        from jf_group JOIN pa_project
        ON jf_group.project_id=pa_project.id"));
        $charData3="";
        foreach($dana_project_berjangka as $list){
            $charData3.=$list->dana_project_berjangka;
        }
        $arr=rtrim($charData3);

        $total_dana_project=((int)$charData1+(int)$charData2+(int)$charData3);

        $ddd=DB::select(DB::raw("select sum(wakaf_base) as duit
        from jf_group_anggota JOIN pa_duta_wakaf ON jf_group_anggota.duta_wakaf_id=pa_duta_wakaf.id
        JOIN pa_transaction ON pa_duta_wakaf.duta_refcode=pa_transaction.ref_code"));

        $charData="";
        foreach($ddd as $list){
            $charData.=$list->duit;
        }
        $arr=rtrim($charData);

        $total_all=(int)$total_dana_project+(int)$charData;

        $totalajuan = jf_pinjam::count();
        $tomu = DB::table('jf_pinjam')->sum('total_mudharabah');
        $req = DB::table('jf_pinjam')->sum('status', '=', 'request','&&', 'accepted');
        $acc = DB::table('jf_pinjam')->sum('nominal_accepted');//2
        // $total_wakaf = DB::table('pa_transaction')->sum('wakaf_base','*', 'wakaf_qty');//1
        $fin = $total_all-$acc;
        //dd($acc,$total_wakaf,$fin);

        $bayar_cicil=DB::table('jf_cicilan')->sum('nominal');
        $final=$fin+$bayar_cicil;

        return view('admin.content.dashboard')->with(compact('totalkelompok','total_all' ,'totalgroup','final','totalajuan', 'tomu','req', 'acc', 'fin'));
    }

    //DUTA
    public function dutaWakafList()
    {
        return view('admin.content.duta-wakaf-list');
    }

    public function addDuta()
    {
        return view('admin.tambahduta');
    }

    public function editDuta()
    {
        return view('admin.editduta');
    }

    public function detailDuta($id)
    {
        $duta = duta_wakaf::findOrFail($id);
        //dd($duta);
        return view('admin.detailduta')->with(['duta' => $duta, 'id' => $id]);
    }

    public function getDutaWakaf(Request $request)
    {
        $data  = duta_wakaf::get();
        if ($request->ajax()) {
            //dd($data);
            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-info detail-dutawakaf' style='color:white;' title='Detail' data-id='$key->id'>
                    <i class='fas fa-eye'></i></a>
                    ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function store(Request $request)
    {
        $duta = duta_wakaf::create([
            'provinsi_id' => $request->provinsi,
            'kabupaten_id' => $request->kabupaten,
            'duta_type' => $request->duta_type,
            'parent_id' => $request->parent_id,
            'nazhir_id' => $request->nazhir,
            'license_number' => $request->nik,
            'duta_name' => $request->nama_lengkap,
            'duta_username' => $request->username,
            'duta_birth_place' => $request->tempat_lahir,
            'duta_birth' => $request->tanggal_lahir,
            'duta_gender' => $request->jenis_kelamin,
            'duta_phone' => $request->nohp,
            'duta_email' => $request->email,
            'duta_password' => $request->password,
            'duta_last_education' => $request->pendidikan_terakhir,
            'duta_job' => $request->pekerjaan,
            'duta_bank_name' => $request->bank,
            'duta_bank_branch' => $request->cabang_bank,
            'duta_bank_account' => $request->norek,
            'duta_bank_account_name' => $request->nama_pengguna_bank,
            'duta_refcode' => $request->refcode,
            'duta_reason' => $request->alasan
        ]);
    }

    //NAZHIR
    public function nazhirList()
    {
        return view('admin.content.nazhir-list');
    }

    public function detailNazhir($id)
    {
        $nazhir = NazhirModel::findOrFail($id);
        //dd($duta);
        return view('admin.detailnazhir')->with(['nazhir' => $nazhir, 'id' => $id]);
    }

    public function getNazhir(Request $request)
    {
        $data  = NazhirModel::get();
        if ($request->ajax()) {
            //dd($data);
            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-info detail-nazhir' style='color:white;' title='Detail' data-id='$key->id'>
                    <i class='fas fa-eye'></i></a>
                  ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function addNazhir()
    {
        return view('admin.tambahnazir');
    }

    //PROJECT
    public function projectList()
    {
        return view('admin.content.project-list');
    }

    public function getProject(Request $request)
    {
        $data  = ProjectModel::get();
        if ($request->ajax()) {
            //dd($data);
            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-info detail-project' style='color:white;' title='Detail' data-id='$key->id'>
                    <i class='fas fa-eye'></i></a>
                ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function detailProject($id)
    {
        $project = ProjectModel::findOrFail($id);
        //dd($project);
        return view('admin.detailproject')->with(['project' => $project, 'id' => $id]);
    }

    //PENDAMPING
    public function getPendamping()
    {
        return view('admin.content.pendamping-list');
    }

    public function dataPendamping(Request $request)
    {
        $data  = Jf_pendampingModel::get();
        if ($request->ajax()) {
            //dd($data);
            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-warning edit-pendamping' style='color:white;' title='Edit' data-id='$key->id'>
                    <i class='fas fa-pen-fancy'></i></a>
                    <a role='button' class='btn-sm btn-danger hapus' data-id='$key->id' style='color:white;' title='Hapus'>
                    <i class='fas fa-trash'></i></a>
                    ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function createUpdatePendamping(Request $request){

        $pendamping = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:jf_pendamping',
            'no_hp' => 'required',
        ]);

        if ($pendamping->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'Bad request',
                'errors' => $pendamping->errors()
            ]);
        } else {
            $data = Jf_pendampingModel::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'is_active' => 1, //default is_active = 1
                    'password' => Hash::make('password') //default password
                ]
            );

            return response()->json([
                'status' => 200,
                'message' => 'Data success stored',
                'data' => $data
            ]);
        }
    }

    public function editPendamping($id){
        $data = DB::table('jf_pendamping')->where('id', $id)->first();

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Row Fetched',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
            ]);
        }
    }

    public function deletePendamping($id)
    {
        DB::table('jf_pendamping')->where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Data deleted'
        ]);
    }

    //SETTING
    public function getSetting()
    {
        return view('admin.content.setting-list');
    }

    public function dataSetting(Request $request)
    {
        $data  = jf_setting::get();
        if ($request->ajax()) {
            //dd($data);
            return datatables()->of($data)
                // ->addColumn('setting', function () {
                //     $setting = DB::table('jf_setting')->get();
                //     return $setting;
                // })
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-warning edit-setting' style='color:white;' title='Edit' data-id='$key->id'>
                    <i class='fas fa-pen-fancy'></i></a>
                    <a role='button' class='btn-sm btn-danger hapus' data-id='$key->id' style='color:white;' title='Hapus'>
                    <i class='fas fa-trash'></i></a>
                    ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function createUpdateSetting(Request $request){

        $setting = Validator::make($request->all(), [
            'key' => 'required',
            'value' => 'required',
        ]);

        if ($setting->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'Bad request',
                'errors' => $setting->errors()
            ]);
        } else {
            $data = jf_setting::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'key' => $request->key,
                    'value' => $request->value
                ]
            );

            return response()->json([
                'status' => 200,
                'message' => 'Data success stored',
                'data' => $data
            ]);
        }
    }

    public function editSetting($id){
        $data = DB::table('jf_setting')->where('id', $id)->first();

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Row Fetched',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
            ]);
        }
    }

    public function deleteSetting($id)
    {
        DB::table('jf_setting')->where('id', $id)->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Data deleted'
        ]);
    }

    //LIST ANGGOTA
    public function listAnggota()
    {
        return view('admin.listAnggota');
    }

    public function dataListAnggota(Request $request)
    {
        $data = DB::table('jf_group_anggota')->select(
            'pa_duta_wakaf.duta_name',
            'loc_districts.name as namaKecamatan',
            'loc_villages.name as namaDesa',
            'jf_group_anggota.*',
            'jf_group.name as nameGroup'
        )
        ->join('jf_group', 'jf_group_anggota.group_id', '=', 'jf_group.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->join('loc_districts', 'jf_group.district_id', '=', 'loc_districts.id')
        ->join('loc_villages', 'jf_group.viilage_id', '=', 'loc_villages.id')
        ->get();

        // dd($data);

        if ($request->ajax()) {
            //dd($data);
            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-warning edit' data-id='$key->id' style='color:white;' title='Edit'>
                    <i class='fas fa-pen-fancy'></i></a>
                    <a role='button' class='btn-sm btn-danger hapus' data-id='$key->id' style='color:white;' title='Hapus'>
                    <i class='fas fa-trash'></i></a>
                    ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function addListAnggota()
    {
        $duta_wakaf = duta_wakaf::all();
        $group = GroupModel::all();
        return view('admin/addListAnggota', compact('duta_wakaf', 'group'));
    }

    public function detailListAnggota($id)
    {
        $listAnggota = group_anggota::findOrFail($id);
        //dd($project);
        return view('admin.detailListAnggota')->with(['listAnggota' => $listAnggota, 'id' => $id]);
    }

    public function editListAnggota($id)
    {
        //$listAnggota = group_anggota::find($id);
        //$duta_wakaf=duta_wakaf::all();
        //dd($listAnggota);
        $listAnggota = DB::table('jf_group_anggota')->select(
            'jf_group_anggota.id',
            'jf_group_anggota.name',
            'loc_districts.name as namaKecamatan',
            'pa_duta_wakaf.duta_name'
        )->where('jf_group_anggota.id', $id);
        $listAnggota = $listAnggota
            ->join('jf_group', 'jf_group_anggota.group_id', '=', 'jf_group.id')
            ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
            ->join('pa_project', 'jf_group.project_id', '=', 'pa_project.id')
            ->join('loc_villages', 'jf_group.viilage_id', '=', 'loc_villages.id')
            ->join('loc_districts', 'jf_group.district_id', '=', 'loc_districts.id')->get();
        //dd($listAnggota);
        if ($listAnggota) {
            return response()->json([
                'status' => 200,
                'data' => $listAnggota
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not FOund',
            ]);
        }
        return view('admin.editListAnggota', compact('duta_wakaf'))->with(['listAnggota' => $listAnggota, 'id' => $id]);
    }

    public function updateListAnggota(Request $request)
    {
        $listAnggota = group_anggota::find($request->id);
        $listAnggota->name   = $request->input('name');
        $listAnggota->group_id   = $request->input('group_id');
        $listAnggota->duta_wakaf_id   = $request->input('duta_name');
        $listAnggota->status = $request->input('status');
        $listAnggota->update();
        return view('admin/listAnggota');
    }

    public function deleteListAnggota($id)
    {
        $listAnggota = DB::table('jf_group_anggota')->where('id', $id)->delete();
        return view('admin/listAnggota');
    }

    //GROUP
    public function group()
    {
        return view('admin.content.group-list');
    }

    public function dataGroup(Request $request)
    {
        //$data  = GroupModel::get();
        $data = DB::table('jf_group')->select(
            //'pa_duta_wakaf.duta_name',
            'loc_villages.name as namaDesa',
            'loc_districts.name as namaKecamatan',
            'pa_project.project_name',
            'jf_group.*'
        );
        $data = $data
            ->join('pa_project', 'jf_group.project_id', '=', 'pa_project.id')
            ->join('loc_villages', 'jf_group.viilage_id', '=', 'loc_villages.id')
            ->join('loc_districts', 'jf_group.district_id', '=', 'loc_districts.id')->get();

        // dd($data);

        if ($request->ajax()) {
            // dd($data);
            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <div class='d-flex justify-content-between'>
                    <a role='button' href='/admin/detail-group/" . $key->id . "' class='btn-sm btn-info detail-group' data-id='$key->id' style='color:white;' title='Detail'>
                    <i class='fas fa-info'></i></a>
                    <a role='button' class='btn-sm btn-danger hapus' data-id='$key->id' style='color:white;' title='Hapus'>
                    <i class='fas fa-trash'></i></a>
                    </div>
                   ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function dataAnggotaInGroup(Request $request, $id){
        $data = DB::table('jf_group_anggota')
        ->where('group_id', $id)
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->select('pa_duta_wakaf.duta_name as name', 'jf_group_anggota.id', 'jf_group_anggota.created_at', 'jf_group_anggota.status')
        ->get();

        // dd($data);
        if ($request->ajax()) {

            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a role='button' class='btn-sm btn-warning edit' data-id='$key->id' style='color:white;' title='Edit'>
                    <i class='fas fa-pen-fancy'></i></a>
                    <a role='button' class='btn-sm btn-danger hapus' data-id='$key->id' style='color:white;' title='Hapus'>
                    <i class='fas fa-trash'></i></a>
                   ";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
            }
    }

    public function editAnggotaInGroup($id){
        $data = DB::table('jf_group_anggota')
        ->where('jf_group_anggota.id', $id)
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->select('pa_duta_wakaf.duta_name as name', 'jf_group_anggota.created_at as join_date', 'jf_group_anggota.status', 'jf_group_anggota.id')
        ->first();

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Data Fetched!',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found!'
            ]);
        }
    }

    public function updateAnggotaInGroup(Request $request){
        $anggota_in_group = group_anggota::where('id', $request->id);
        if($anggota_in_group){
            $anggota_in_group->update([
                'status' => $request->status_anggota,
            ]);

            return response()->json([
               'status' => 200,
               'message' => 'Data success updated'
            ]);
        } else {
            return response()->json([
               'status' => 400,
               'message' => 'Data update fail'
            ]);
        }
    }

    public function detailGroup($id)
    {
        $group = DB::table('jf_group')->where('jf_group.id', $id)
        ->join('loc_villages', 'jf_group.viilage_id', '=', 'loc_villages.id')
        ->join('loc_districts', 'jf_group.district_id', '=', 'loc_districts.id')
        ->join('pa_project', 'jf_group.project_id', '=', 'pa_project.id')
        ->select('jf_group.id', 'jf_group.name as group_name', 'jf_group.created_at', 'loc_villages.name as village_name', 'loc_districts.name as district_name', 'pa_project.project_name')
        ->first();

        $amount_anggota_in_group = count(DB::table('jf_group_anggota')->where('group_id', $id)->get());

        return view('admin.content.group-detail')->with(['group' => $group, 'amount_anggota' => $amount_anggota_in_group]);
    }

    public function addAnggotaToGroup(Request $request)
    {
        $group_anggota = Validator::make($request->all(), [
            'group_id' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);

        // checking kuota anggota in group before do add anggota to group
        // init data approval by other anggota
        $amount_anggota_in_group = DB::table('jf_group_anggota')->where('group_id', $request->group_id);
        $amount_anggota_this_group = count($amount_anggota_in_group->get());
        $max_anggota_in_group = DB::table('jf_setting')->where('key', 'max_anggota_in_group')->first()->value;

        if ($amount_anggota_this_group >= $max_anggota_in_group) {
            return response()->json([
                'status' => 406,
                'message' => 'Anggota dalam grup ini telah memenuhi kuota'
            ]);

        } else {
            if ($group_anggota->fails()){
                return response()->json([
                    'status' => 400,
                    'message' => 'Bad Request',
                    'errors' => $group_anggota->errors()
                 ]);

                } else {
                    group_anggota::create([
                    'group_id' => $request->group_id,
                    'duta_wakaf_id' => $request->name,
                    'status' => $request->status,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Data success stored'
                ]);
            }
        }

    }

    public function removeAnggotaFromGroup($id){
        DB::table('jf_group_anggota')->where('id', $id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data deleted'
        ]);
    }

    public function addGroup()
    {
        $desa = VillageModel::all();
        $kec = DistrictModel::all();
        $project = ProjectModel::all();
        return view('admin/addGroup', compact('desa', 'kec', 'project'));
    }

    public function createGroup(Request $request)
    {
        $group = Validator::make($request->all(), [
            'village' => 'required',
            'kec' => 'required',
            'project' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($group->fails()){
            return response()->json([
                'status' => 400,
                'message' => 'Bad Request',
                'errors' => $group->errors()
             ]);

        } else {
            GroupModel::create([
                'viilage_id' => $request->village,
                'district_id' => $request->kec,
                'project_id' => $request->project,
                'status' => $request->status,
                'name' => $request->name
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Data success stored'
             ]);
        }
    }

    public function deleteGroup($id)
    {
        DB::table('jf_group')->where('id', $id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data deleted'
        ]);
    }

    public function editGroup($id)
    {
        $data = DB::table('jf_group')->select(
            'jf_group.id',
            'jf_group.name',
            'jf_group.status',
            'loc_villages.name as desa',
            'loc_districts.name as kecamatan',
            'pa_project.project_name'
        )->where('jf_group.id', $id)
        ->join('loc_villages', 'jf_group.viilage_id', '=', 'loc_villages.id')
        ->join('loc_districts', 'jf_group.district_id', '=', 'loc_districts.id')
        ->join('pa_project', 'jf_group.project_id', '=', 'pa_project.id')->first();

        // dd($data);
        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not FOund',
            ]);
        }
    }

    public function updateGroup(Request $request)
    {
        dd($request->all());

        $group = GroupModel::find($request->id);
        $group->viilage_id = $request->name;
        $group->viilage_id = $request->village;
        $group->district_id = $request->kec;
        $group->project_id = $request->project;
        $group->status = $request->status;

        $group->update();

        return response()->json([
            'status' => 200,
            'message' => 'Data deleted'
        ]);
    }

    //PENGAJUAN PINJAM
    public function requestPinjam()
    {
        return view('admin.content.approval-admin');
    }

    public function dataRequestPinjam(Request $request)
    {
        $data = DB::table('jf_pinjam')->select(
            'jf_pinjam.*',
            'jf_pinjam.created_at',
            'jf_group.name',
            'pa_duta_wakaf.duta_name'
        )
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->join('jf_group', 'jf_group_anggota.group_id', '=', 'jf_group.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->where('jf_pinjam.is_complete', null)
        ->get();
        // dd($data);
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    if ($data->status != 'request') {
                        $actionBtn = "
                        <a role='button' class='btn-sm btn-success detail-ajuan' data-id='$data->id' style='color:white;' title='Perijinan Anda'>
                        <i class='fas fa-check-circle'></i></a>
                        <a role='button' class='btn-sm btn-primary' style='color:white;' title='Semua Perijinan' href='/admin/detail-request-pinjam/" . $data->id . "'>
                        <i class='fas fa-users'></i></a>
                        <a role='button' class='btn-sm btn-light mark-as-done-" . $data->id . "' data-id='$data->id' style='color:grey;' title='Mark as done' onclick='markAsDone(event, $data->id)'>
                        <i class='fas fa-check'></i></a>
                        ";
                    } else {
                        $actionBtn = "
                        <a role='button' class='btn-sm btn-success detail-ajuan' data-id='$data->id' style='color:white;' title='Perijinan Anda'>
                        <i class='fas fa-check-circle'></i></a>
                        <a role='button' class='btn-sm btn-primary' style='color:white;' title='Semua Perijinan' href='/admin/detail-request-pinjam/" . $data->id . "'>
                        <i class='fas fa-users'></i></a>
                        ";
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
                // <a role='button' class='btn-sm btn-danger hapus' data-id='$data->id' style='color:white;' title='Hapus'>
                // <i class='fas fa-trash'></i></a>
        }
    }

    public function detailpengajuanpinjam($id)
    {
        $pinjam = jf_pinjam::findOrFail($id);
        return view('admin.detailpengajuanpinjam')->with(['pinjam' => $pinjam, 'id' => $id]);
    }

    public function editpengajuanpinjam($id)
    {
        //$pinjam = jf_pinjam::find($id);
        $pinjam = DB::table('jf_pinjam')->select(
            'jf_pinjam.*'
        )->where('jf_pinjam.id', $id)->get();
        if ($pinjam) {
            return response()->json([
                'status' => 200,
                'data' => $pinjam
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
            ]);
        }
        return view('admin.editpengajuanpinjam')->with(['pinjam' => $pinjam, 'id' => $id]);
    }

    public function detailRequestPinjamAnggota($id)
    {
        // new query
        $data_pinjam = DB::table('jf_pinjam')->where('jf_pinjam.id', $id)
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->select('pa_duta_wakaf.duta_name as name_requester', 'jf_pinjam.*')->first();

        $data_tracking_pinjam = JfTrackingPinjamanAnggota::where('pinjam_id', $id)->first();

        $data_pinjam_approval = DB::table('jf_pinjam')->where('jf_pinjam.id', $id)
        ->join('jf_pinjam_approval', 'jf_pinjam.id', '=', 'jf_pinjam_approval.pinjam_id')
        ->join('jf_group_anggota', 'jf_pinjam_approval.group_anggota_id', '=', 'jf_group_anggota.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->select('pa_duta_wakaf.duta_name as approved_by', 'jf_pinjam_approval.*', 'jf_pinjam_approval.status as status_approval', 'jf_pinjam_approval.id as id_approval')
        ->get();

        $data['data_pinjam'] = $data_pinjam;
        $data['data_tracking_pinjam'] = $data_tracking_pinjam;
        $data['data_pinjam_approval'] = $data_pinjam_approval;

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

    public function UpdateApprovalPinjam(Request $request){
        $request->validate([
            'nominal_accepted' => 'required',
            'status_next' => 'required',
            'pinjam_id' => 'required',
        ]);
        $nom_accepted = (int)str_replace(['Rp. ', '.', ','], '', $request->nominal_accepted);

        if ($nom_accepted == 0 || $nom_accepted == null || $nom_accepted == ''){
            return response()->json([
                'status' => 400,
                'message' => 'Nominal disetujui tidak boleh kosong',
            ]);
        }

        if ($request->status_next == '' || $request->status_next == null){
            return response()->json([
                'status' => 400,
                'message' => 'Status tidak boleh kosong',
            ]);
        }

        jf_pinjam::where('id', $request->pinjam_id)->update([
            'nominal_accepted' => $nom_accepted,
            'status' => $request->status_next,
            'accepted_at' => Carbon::now()
        ]);

        // add log to tracking (approval admin)
        app('App\Http\Controllers\TrackingPinjamanAnggotaController')->addUpdateTrackingPinjam($request->pinjam_id, null, null, null, null, Carbon::now());

        return response()->json([
            'status' => 200,
            'message' => 'Data success stored'
        ]);
    }

    public function markAsDone(Request $request){
        if ($request->id_loan){
            $data = jf_pinjam::find($request->id_loan);

            if ($data){
                $data->is_complete = 1;
                $data->update();

                // add log to tracking (ajuan pinjam mark as ready)
                app('App\Http\Controllers\TrackingPinjamanAnggotaController')->addUpdateTrackingPinjam($request->pinjam_id, null, null, null, null, null, Carbon::now());

                return response()->json([
                    'status' => 200,
                    'message' => 'Data updated!'
                ]);

            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Data not found!'
                ]);
            }

        } else {
            return response()->json([
                'status' => 400,
                'message' => 'No Data Selected!'
            ]);
        }
    }

    public function update(Request $request)
    {
        //dd($request->nominal_accepted);
        //$pinjam = jf_pinjam::find($id);
        //dd($request->status);
        $pinjam = jf_pinjam::find($request->id);
        $pinjam->nominal_accepted  = $request->input('nominal_accepted');
        $pinjam->tenor             = $request->input('tenor');
        /*$pinjam->group_anggota_id   = $request->input('group_anggota_id');
        $pinjam->nominal_request   = $request->input('nominal_request');

        $pinjam->desc_request      = $request->input('desc_request');

        $pinjam->status            = $request->input('status');*/
        //dd($pinjam->group_anggota_id);
        $conversitenor = (intval($request->input('tenor')) * 12);
        $nominal_accepted = $request->nominal_accepted;
        $cicilanpokok = $nominal_accepted / $conversitenor;
        //menghitung mudharabah
        $dbpercent = jf_setting::where('key', 'mudharabah_percent')->first()->value;
        $percent = $dbpercent / 100;
        $total_mudharabah = $cicilanpokok * $percent;
        $cicilan_modharabah = $total_mudharabah;
        $cicilan_perbulan = $cicilanpokok + $cicilan_modharabah;
        $pinjam->update([
            'group_anggota_id' => $request->group_anggota_id,
            'nominal_request' => $request->nominal_request,
            'desc_request' => $request->desc_request,
            'nominal_accepted' => $nominal_accepted,
            'total_mudharabah' => $total_mudharabah,
            'status' => $request->status,
            'tenor' => $conversitenor,
            'cicilan_perbulan' => $cicilan_perbulan,
            'cicilan_pokok' => $cicilanpokok,
            'cicilan_modharabah' => $cicilan_modharabah,
        ]);
        return view('admin/pengajuanpinjam');
        return back()->with('success', 'berhasil');
    }

    public function deletepengajuanpinjam($id)
    {
        $ajuanpinjam = DB::table('jf_pinjam')->where('id', $id)->delete();
        return view('admin/pengajuanpinjam');
    }

    //CICILAN
    public function requestCicilan()
    {
        return view('admin.content.cicilan');
    }

    public function dataCicilan(Request $request)
    {
        $data = DB::table('jf_cicilan')->select(
            'jf_pinjam.nominal_accepted',
            'jf_cicilan.*',
            'pa_duta_wakaf.duta_name'
        );

        $data = $data
            ->join('jf_pinjam', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
            ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
            ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
            ->get();

        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <div class='d-flex justify-content-between'>
                    <a role='button' class='btn-sm btn-info detail-cicilan' data-id='$key->id' style='color:white;' title='Approval'>
                    <i class='fas fa-check'></i></a>
                    </div>
                    ";
                    return $actionBtn;
                    // <a role='button' class='btn-sm btn-danger hapus' data-id='$key->id' style='color:white;' title='Hapus'>
                    // <i class='fas fa-trash'></i></a>
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function detailCicilan($id)
    {
        // $cicil = CicilanModel::findOrFail($id);
        // return view('admin.detailcicil')->with(['cicil' => $cicil, 'id' => $id]);
        $data = DB::table('jf_cicilan')
        ->where('jf_cicilan.id', $id)
        ->select(
            'jf_pinjam.*',
            'jf_pinjam.created_at as request_date',
            'jf_cicilan.*',
            'jf_cicilan.created_at as payment_date',
            'jf_cicilan.nominal as nominal_cicilan',
            'pa_duta_wakaf.duta_name'
        )
            ->join('jf_pinjam', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
            ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
            ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
            ->first();

        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
            ]);
        }

    }

    public function addcicil()
    {
        $ket = jf_pinjam::all();
        return view('admin/tambahcicilan', compact('ket'));
    }

    public function createCicil(Request $request)
    {
        $img = $request->file;
        $namaFile = $img->getClientOriginalName();

        $cicil = new CicilanModel;
        $cicil->pinjam_id =  $request->pinjam_id;
        $cicil->nominal =  $request->nominal;
        $cicil->is_valid =  $request->is_valid;
        $cicil->note_internal =  $request->note_internal;
        $cicil->fie =  $namaFile;
        $img->move(public_path() . '/img', $namaFile);
        $cicil->save();

        return view('admin/tampilcicilan');
    }

    public function editcicilan($id)
    {
        $cicil = CicilanModel::find($id);
        $ket = jf_pinjam::all();
        if ($cicil) {
            return response()->json([
                'status' => 200,
                'data' => $cicil
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
            ]);
        }
        return view('admin.editcicilan', compact('ket'))->with(['cicil' => $cicil, 'id' => $id]);
    }

    public function updatecicil(Request $request)
    {

        $approve_cicil = Validator::make($request->all(), [
            'status' => 'required',
            'note_admin' => 'required',
        ]);

        if ($approve_cicil->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Approval failed!',
                'errors' => $approve_cicil->errors()
            ]);

        } else {
            $cicilan = CicilanModel::find($request->id);

            $cicilan->is_valid = $request->input('status');
            $cicilan->note_admin = $request->input('note_admin');
            $cicilan->approval_at = Carbon::now();

            $cicilan->update();

            return response()->json([
                'status' => 200,
                'data' => 'data success stored!'
            ]);
        }
    }

    public function hapuscicil($id)
    {
        $cicil = DB::table('jf_cicilan')->where('id', $id)->delete();
        return view('admin/tampilcicilan');
    }

    //dana masuk
    public function fundIncoming()
    {
        return view('admin.content.incoming-fund');
    }

    //dana terpakai
    public function fundUsed()
    {
        return view('template.development-admin');
    }

    function select2dutaname(Request $request)
    {
        $data      = duta_wakaf::query();
        $data      = $data->where('is_approved', 1);

        // filter only anggota doesn't have group, can add to group
        $anggota_in_group = DB::table('jf_group_anggota')->get();
        for ($i = 0; $i < count($anggota_in_group); $i++){
            $data->where('id', '!=', $anggota_in_group[$i]->duta_wakaf_id);
        }

        $last_page = null;

        if ($request->has('search') && $request->search != '') {
            // Apply search param
            $data = $data->where('duta_name', 'like', '%' . $request->search . '%');
            //dd($data);
        }

        if ($request->has('page')) {
            // If request has page parameter, add paginate to eloquent
            $data->paginate(10);
            // Get last page
            $last_page = $data->paginate(10)->lastPage();
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'Data Fetched',
            'last_page' => $last_page,
            'data'      => $data->get(),
        ]);
    }

    public function select2village(Request $request)
    {
        $data      = VillageModel::query();
        $data      = $data->orderBy('name', 'ASC');
        $last_page = null;

        if ($request->has('search') && $request->search != '') {
            // Apply search param
            $data = $data->where('name', 'like', '%' . $request->search . '%');
            //dd($data);
        }

        if ($request->has('page')) {
            // If request has page parameter, add paginate to eloquent
            $data->paginate(10);
            // Get last page
            $last_page = $data->paginate(10)->lastPage();
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'Data Fetched',
            'last_page' => $last_page,
            'data'      => $data->get(),
        ]);
    }

    public function select2kec(Request $request)
    {
        $data      = DistrictModel::query();
        $data      = $data->orderBy('name', 'ASC');
        $last_page = null;

        if ($request->has('search') && $request->search != '') {
            // Apply search param
            $data = $data->where('name', 'like', '%' . $request->search . '%');
            //dd($data);
        }

        if ($request->has('page')) {
            // If request has page parameter, add paginate to eloquent
            $data->paginate(10);
            // Get last page
            $last_page = $data->paginate(10)->lastPage();
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'Data Fetched',
            'last_page' => $last_page,
            'data'      => $data->get(),
        ]);
    }

    public function select2project(Request $request)
    {
        $data      = ProjectModel::query();
        $data      = $data->orderBy('project_name', 'ASC');
        $last_page = null;

        if ($request->has('search') && $request->search != '') {
            // Apply search param
            $data = $data->where('project_name', 'like', '%' . $request->search . '%');
            //dd($data);
        }

        if ($request->has('page')) {
            // If request has page parameter, add paginate to eloquent
            $data->paginate(10);
            // Get last page
            $last_page = $data->paginate(10)->lastPage();
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'Data Fetched',
            'last_page' => $last_page,
            'data'      => $data->get(),
        ]);
    }

    public function select2group(Request $request)
    {
        $data = DB::table('jf_group')->select(
            //'pa_duta_wakaf.duta_name',
            'loc_villages.name as namaDesa',
            'loc_districts.name as namaKecamatan',
            'pa_project.project_name',
            'jf_group.id',
            'jf_group.name as nameGroup'
        )->orderBy('nameGroup', 'ASC');

        $data = $data
            //->join('jf_group', 'jf_group_anggota.group_id', '=','jf_group.id')->get();
            //->join('pa_duta_wakaf','jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
            ->join('pa_project', 'jf_group.project_id', '=', 'pa_project.id')
            ->join('loc_villages', 'jf_group.viilage_id', '=', 'loc_villages.id')
            ->join('loc_districts', 'jf_group.district_id', '=', 'loc_districts.id');
        //return $data;
        //dd($data);
        $last_page = null;

        if ($request->has('search') && $request->search != '') {
            // Apply search param
            $data = $data->where('namaGroup', 'like', '%' . $request->search . '%');
            //dd($data);
        }

        if ($request->has('page')) {
            // If request has page parameter, add paginate to eloquent
            $data->paginate(10);
            // Get last page
            $last_page = $data->paginate(10)->lastPage();
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'Data Fetched',
            'last_page' => $last_page,
            'data'      => $data->get(),
        ]);
    }


    public function lihatlistaproval($id)
    {
        $aprove = DB::table('jf_pinjam')->select(
            'jf_pinjam.desc_request as de',
            'jf_group_anggota.group_id',
            'loc_villages.name',
            'jf_pinjam_approval.id',
            'jf_pinjam_approval.created_at as dt',
            'jf_pinjam_approval.user_agent',
            'jf_pinjam_approval.status',
            'jf_pinjam_approval.accepted_at',
            'jf_pinjam_approval.group_anggota_id',
            'jf_pinjam_approval.note',
        )->where('jf_pinjam.id', $id);
        $aprove = $aprove
            ->join('jf_pinjam_approval', 'jf_pinjam.id', '=', 'jf_pinjam_approval.pinjam_id')
            ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
            ->join('jf_group', 'jf_group_anggota.group_id', '=', 'jf_group.id')
            ->join('loc_villages', 'jf_group.viilage_id', '=', 'loc_villages.id')
            ->get();
        //dd($aprove);
        return view('admin/lihatlistaproval')->with(['aprove' => $aprove, 'id' => $id]);
    }

    public function dataDanaMasuk(Request $request)
    {
        $data = DB::table('jf_pinjam')->select(
            'pa_duta_wakaf.duta_name',
            'jf_pinjam.id',
            'jf_pinjam.desc_request',
            'jf_pinjam.total_mudharabah',
            'jf_pinjam.created_at'
        )
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->get();
        // dd($data);

        if ($request->ajax()) {
            return datatables()->of($data)
                // ->addColumn('action', function ($key) {
                //     $actionBtn = "
                //     <a role='button' class='btn-sm btn-info' style='color:white;' title='Detail' href='/admin/detailcicilan/" . $key->id . "'>
                //     <i class='fas fa-eye'></i></a>
                //     <a role='button' class='btn-sm btn-warning edit' data-id='$key->id' style='color:white;' title='Edit'>
                //     <i class='fas fa-pen-fancy'></i></a>
                //     <a role='button' class='btn-sm btn-danger hapus' data-id='$key->id' style='color:white;' title='Hapus'>
                //     <i class='fas fa-trash'></i></a>
                // ";
                //     return $actionBtn;
                // })
                // ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function detailRequestPinjam($id)
    {
        $data = DB::table('jf_pinjam')->where('jf_pinjam.id', $id)
        ->select('jf_pinjam.*')
        ->first();

        $data_returned = DB::table('jf_cicilan')->where('pinjam_id', $id)->where('is_valid', 1)->sum('nominal');
        $data_acc = DB::table('jf_pinjam')->where('id', $id)->where('status', 'accepted')->sum('nominal_accepted');

        $data->data_accepted = $data_acc;
        $data->data_returned = $data_returned;
        $data->data_minus = $data_acc - $data_returned;

        // init data approval by other anggota
        $group_anggota = DB::table('jf_group_anggota')->where('id', $data->group_anggota_id)->first();

        $amount_approval = jf_pinjam_approval::where('pinjam_id', $id);
        $amount_anggota_in_group = DB::table('jf_group_anggota')->where('group_id', $group_anggota->group_id);

        $poin_approval_per_anggota = DB::table('jf_setting')->where('key', 'poin_approval_per_anggota')->first()->value;

        $data->amount_approval_other_anggota = count($amount_approval->get());
        $data->amount_anggota = count($amount_anggota_in_group->get()) - 1;
        $data->other_anggota_acc = count($amount_approval->where('status', 'accepted')->get());
        $data->other_anggota_reject = count(jf_pinjam_approval::where('pinjam_id', $id)->where('status', 'reject')->get());
        $data->poin_other_anggota_approval = $data->other_anggota_acc * $poin_approval_per_anggota;

        // init data approval by pendamping
        $amount_approval_by_pendamping = JfPinjamApprovalByPendampingModel::where('pinjam_id', $id);
        $amount_pendamping_acc = $amount_approval_by_pendamping->where('status', 'accepted')->get();
        $amount_pendamping_reject = JfPinjamApprovalByPendampingModel::where('pinjam_id', $id)->where('status', 'reject')->get();

        $max_amount_approval_by_pendamping = DB::table('jf_setting')->where('key', 'amount_approval_pendamping')->first()->value;
        $poin_approval_per_pendamping = DB::table('jf_setting')->where('key', 'poin_approval_per_pendamping')->first()->value;

        $data->amount_approval_by_pendamping = count($amount_approval_by_pendamping->get());
        $data->max_amount_approval_by_pendamping = $max_amount_approval_by_pendamping;
        $data->pendamping_acc = count($amount_pendamping_acc);
        $data->pendamping_reject = count($amount_pendamping_reject);
        // dd($data->pendamping_reject);
        $data->poin_pendamping_approval = $data->pendamping_acc * $poin_approval_per_pendamping;

        // init data approval by nazhir
        $has_approved_by_nazhir = DB::table('jf_pinjam_approval_by_nazhir')->where('pinjam_id', $id)->get();
        $max_amount_approval_by_nazhir = DB::table('jf_setting')->where('key', 'amount_approval_nazhir')->first()->value;

        $data->amount_approval_by_nazhir = count($has_approved_by_nazhir);
        $data->max_amount_approval_by_nazhir = $max_amount_approval_by_nazhir;
        $data->acc_or_reject_nazhir = $has_approved_by_nazhir->first();

        // init data approval by admin
        $amount_approval_by_admin = DB::table('jf_pinjam')->where('id', $id)->where('accepted_at', '!=', null)->get();
        $max_amount_approval_by_admin = DB::table('jf_setting')->where('key', 'amount_approval_admin')->first()->value;

        $data->amount_approval_by_admin = count($amount_approval_by_admin);
        $data->max_amount_approval_by_admin = $max_amount_approval_by_admin;
        $data->acc_or_reject_admin = $amount_approval_by_admin->first();

        // init is request pinjam owned by user auth
        $id_user_owned_by_requester = DB::table('jf_pinjam')
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->where('jf_pinjam.id', $id)
        ->select('jf_group_anggota.duta_wakaf_id')
        ->first();
        // $is_show_cicilan = false;
        // if ($id_user_owned_by_requester->duta_wakaf_id == $user->id){
        //     $is_show_cicilan = true;
        // }
        // $data->is_show_cicilan = $is_show_cicilan;

        return view('admin.content.detail-request-pinjam')->with(['data' => $data]);
    }

    public function listDetailApprovalAnggota(Request $request, $id){
        $data = DB::table('jf_pinjam_approval')
        ->where('jf_pinjam_approval.pinjam_id', $id)
        ->join('jf_group_anggota', 'jf_pinjam_approval.group_anggota_id', '=', 'jf_group_anggota.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->select('pa_duta_wakaf.duta_name as name', 'jf_pinjam_approval.accepted_at', 'jf_pinjam_approval.status', 'jf_pinjam_approval.note')
        ->get();

        // dd($data);

        if ($request->ajax()) {
            return datatables()->of($data)->toJson();
        }
    }

    public function listDetailApprovalPendamping(Request $request, $id){
        $data = DB::table('jf_pinjam_approval_by_pendamping')
        ->where('jf_pinjam_approval_by_pendamping.pinjam_id', $id)
        ->join('jf_pendamping', 'jf_pinjam_approval_by_pendamping.pendamping_id', '=', 'jf_pendamping.id')
        ->select('jf_pendamping.name', 'jf_pinjam_approval_by_pendamping.accepted_at', 'jf_pinjam_approval_by_pendamping.status', 'jf_pinjam_approval_by_pendamping.note')
        ->get();

        // dd($data);

        if ($request->ajax()) {
            return datatables()->of($data)->toJson();
        }
    }

    public function listDetailApprovalNazhir(Request $request, $id){
        $data = DB::table('jf_pinjam_approval_by_nazhir')
        ->where('jf_pinjam_approval_by_nazhir.pinjam_id', $id)
        ->join('pa_nazhir', 'jf_pinjam_approval_by_nazhir.nazhir_id', '=', 'pa_nazhir.id')
        ->select('pa_nazhir.nazhir_name as name', 'jf_pinjam_approval_by_nazhir.accepted_at', 'jf_pinjam_approval_by_nazhir.status', 'jf_pinjam_approval_by_nazhir.note')
        ->get();

        // dd($data);

        if ($request->ajax()) {
            return datatables()->of($data)->toJson();
        }
    }

    public function listDetailApprovalAdmin(Request $request, $id){
        $data = DB::table('jf_pinjam')
        ->where('jf_pinjam.id', $id)
        ->where('jf_pinjam.accepted_at', '!=', null)
        ->select('jf_pinjam.nominal_accepted', 'jf_pinjam.accepted_at', 'jf_pinjam.status')
        ->get();

        // dd($data);

        if ($request->ajax()) {
            return datatables()->of($data)->toJson();
        }
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
}
