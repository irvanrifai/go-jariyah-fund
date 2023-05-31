<?php

namespace App\Http\Controllers\anggota;

use App\Models\jf_pinjam;
use App\Http\Controllers\Controller;
use App\Models\jf_setting;
use App\Models\group_anggota;
use App\Models\duta_wakaf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\Auth;
use App\Models\jf_pinjam_approval;
use App\Models\JfPinjamApprovalByPendampingModel;
use App\Models\VillageModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\JfTrackingPinjamanAnggota;

class PengajuanPinjamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myPinjam()
    {
        return view('anggota.content.my-pinjam-list');
    }

    public function requestPinjam()
    {
        // get data user status in group
        $user = auth()->user();
        $data_anggota = DB::table('jf_group_anggota')->where('duta_wakaf_id', $user->id)->first();
        $data_group = DB::table('jf_group')->where('id', $data_anggota->group_id)->first();

        // get data for maksimal pinjam
        $user = auth()->user()->id;
        $code = auth()->user()->duta_refcode;
        // dd($code);
        $duta_wakaf = duta_wakaf::where('id', $user)->where('duta_refcode', $code)->first();
        $max_tenor = jf_setting::where('key', 'max_tenor')->first()->value;

        if ($duta_wakaf) {
            // get value max pinjaman pribadi (strict regulation)
            $max_pinjam_pribadi_percent = jf_setting::where('key', 'max_pinjam_pribadi_percent')->first()->value / 100;

            // get value max pinjaman pribadi depend on order request (non strict) * max pinjaman pribadi
            $max_pinjam_pribadi_percent_first = jf_setting::where('key', 'max_pinjam_pribadi_percent_first')->first()->value / 100;
            $max_pinjam_pribadi_percent_second = jf_setting::where('key', 'max_pinjam_pribadi_percent_second')->first()->value / 100;
            $max_pinjam_pribadi_percent_third = jf_setting::where('key', 'max_pinjam_pribadi_percent_third')->first()->value / 100;

            $pinjaman_user = DB::table('jf_pinjam')
            ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
            ->where('jf_group_anggota.duta_wakaf_id', $user)
            ->where('jf_pinjam.status', 'accepted')
            ->select('jf_pinjam.*')
            ->get();

            // fetch data wakaf_base user
            $wakaf_bases = DB::table('pa_transaction')->where('ref_code', $code)->where('transaction_status', 'complete')->sum('wakaf_base') * $max_pinjam_pribadi_percent;

            // handle if first, second, third pinjaman order request
            if (count($pinjaman_user) == 0) {
                $wakaf_bases = $wakaf_bases * $max_pinjam_pribadi_percent_first;
            } else if (count($pinjaman_user) == 1) {
                $wakaf_bases = $wakaf_bases * $max_pinjam_pribadi_percent_second;
            } else if (count($pinjaman_user) == 2) {
                $wakaf_bases = $wakaf_bases * $max_pinjam_pribadi_percent_third;
            }

            // dd($wakaf_bases);

            // fetch data nom_request
            $nom_request = DB::table('jf_group_anggota')
            ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
            ->where('duta_wakaf_id', $user)
            ->where('jf_pinjam.status', 'request')
            ->sum('nominal_request');

            // fetch data keanggotaan in group
            $table_pinjam = DB::table('jf_group_anggota')
            ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
            ->where('duta_wakaf_id', $user);

            // serve data sum pinjam user auth
            $total_pinjam_user = $table_pinjam
            ->sum('nominal_accepted');

            // serve data yang telah dikembalikan/dicicil
            $cicilan_user = $table_pinjam->join('jf_cicilan', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
            ->where('is_valid', 1)
            ->sum('nominal');

            // serve data masih bisa dipinjam(pinjam aktif)
            $sisa_pinjam_user = $total_pinjam_user - $cicilan_user;

        } else {
            return back();
        }

        // set minimum request pinjam anggota
        $min_pinjam = DB::table('jf_setting')->where('key', 'min_request_pinjam_anggota')->first()->value;

        $final = $wakaf_bases - $nom_request - $sisa_pinjam_user;

        // max pinjam depend on first, second, third (NEED ADJUSTMENT)
        $max_pinjam = $final;

        // data resume user section
        // init user auth
        $user = auth()->user();

        // fetch data keanggotaan in group
        $group = DB::table('jf_group_anggota')
        ->where('duta_wakaf_id', $user->id)
        ->first();

        // fetch data group
        $project = DB::table('jf_group')
        ->where('id', $group->group_id)
        ->first();

        // total penghimpunan user depend on refcode, project, transaction_status
        $total_penghimpunan_user = DB::table('pa_transaction')
        ->where('ref_code', $user->duta_refcode)
        ->where('project_id', $project->project_id)
        ->where('transaction_status', 'complete')
        ->sum('wakaf_base');

        // serve data sum pinjam user auth
        $total_pinjam_user = DB::table('jf_pinjam')
        ->where('group_anggota_id', $group->id)
        ->where('status', 'accepted')
        ->sum('nominal_accepted');

        // dana dikembalikan depend on tb cicilan
        $total_dikembalikan_user = DB::table('jf_cicilan')
        ->join('jf_pinjam', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->where('jf_group_anggota.duta_wakaf_id', $user->id)
        ->where('jf_cicilan.is_valid', 1)
        ->sum('jf_cicilan.nominal');

        // sisa penghimpunan data
        $sisa_penghimpunan_user = $total_penghimpunan_user - $total_pinjam_user;

        $sisa_penghimpunan_user = $sisa_penghimpunan_user + ($total_pinjam_user - $total_dikembalikan_user);

        $resume['total_penghimpunan'] = $total_penghimpunan_user;
        $resume['total_pinjam'] = $total_pinjam_user;
        $resume['total_dikembalikan'] = $total_dikembalikan_user;
        $resume['dana_sisa'] = $sisa_penghimpunan_user;

        // init data history pinjam 3 latest()
        $history_pinjam = DB::table('jf_pinjam')
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->where('jf_group_anggota.duta_wakaf_id', $user->id)
        ->where('jf_pinjam.status', '=', 'accepted')
        ->select('jf_pinjam.*')
        ->latest()->take(3)->get();

        // checking if status pinjaman before is --request-- or doesn't complete.
        // Must complete one transaction pinjam, then can request pinjam again
        $transaction_pinjam = DB::table('jf_pinjam')
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->where('jf_group_anggota.duta_wakaf_id', $user->id)
        ->where('jf_pinjam.status', 'request')
        ->select('jf_pinjam.status')
        ->get();

        if (count($transaction_pinjam) > 0){
            // user can't apply (request pinjam before is incomplete)
            return view('anggota.content.request-pinjam-incomplete');
        } else {
            // user can apply for loan (user status active)
            if ($data_group->status === 1){
                return view('anggota.content.request-pinjam-form', [
                    'min_pinjam' => $min_pinjam,
                    'max_pinjam' => $max_pinjam,
                    'max_tenor' => $max_tenor,
                    'resume' => $resume,
                    'history' => $history_pinjam
                ]);

            // user can't apply (user status inactive or frezze)
            } else if ($data_group->status === null || $data_group->status === 0 || $data_group->status === 2){
                return view('anggota.content.request-pinjam-freeze');
            } else {
                return view('anggota.content.request-pinjam-freeze');
            }
        }

    }

    public function totalajuanpribadi(){
        $user = auth()->user()->id;
        $data = DB::table('jf_group_anggota')->select(
            '*',
            'jf_pinjam.*'
        )->where('jf_group_anggota.duta_wakaf_id', $user);
        $data = $data
            ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
            ->count();
            //dd($data);
    }

    public function dataajuan(Request $request)
    {
        $user = auth()->user()->id;
        $data = DB::table('jf_group_anggota')->select(
            '*',
            'jf_pinjam.*'
        )->where('jf_group_anggota.duta_wakaf_id', $user);
        $data = $data
            ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')->get();
        if ($request->ajax()) {

            return datatables()->of($data)
                ->addColumn('action', function ($key) {
                    $actionBtn = "<div class='d-flex justify-content-between'>
                    <a role='button' class='btn-sm btn-info' title='Detail' href='/anggota/detail-request-pinjam-extend/" . $key->id . "' data-content='Detail'>
                    <i class='fas fa-eye'></i></a>
                    <a role='button' class='btn-sm btn-warning edit-pinjaman' title='Edit' data-id='$key->id' data-content='Edit'>
                    <i class='fas fa-pen-fancy'></i></a>
                    </div>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
                // <a role='button' class='btn-sm btn-danger hapus' data-id='$key->id' style='color:white;' title='Hapus'>
                // <i class='fas fa-trash'></i></a>
        }
    }

    public function store(Request $request)
    {
        // init get data if user force do request pinjam
        $user = auth()->user()->id;
        $transaction_pinjam = DB::table('jf_pinjam')
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->where('jf_group_anggota.duta_wakaf_id', $user)
        ->where('jf_pinjam.status', 'request')
        ->select('jf_pinjam.status')
        ->get();

        if (count($transaction_pinjam) > 0){
            // user can't apply (request pinjam before is incomplete)
            return view('anggota.content.request-pinjam-incomplete');
        }

        // must have validation if max pinjam is (-) or 0 user cannot request pinjam
        // make sure max pinjam is valid, from DB and controll from FE that cannot request if (statement 1)
        $data_pinjaman = Validator::make($request->all(), [
            'nominal_request' => 'required',
            'tenor' => 'required',
            'desc_request' => 'required',
        ]);

        //data cicilan pokok
        $conversitenor = (intval($request->tenor) * 12);
        $nom_request = (int)str_replace(['Rp. ', '.', ','], '', $request->nominal_request);
        $cicilanpokok = $nom_request / $conversitenor;

        // check & calc nom_request must <= max_pinjam
        $user = auth()->user()->id;
        $code = auth()->user()->duta_refcode;
        $max_pinjam_pribadi_percent = jf_setting::where('key', 'max_pinjam_pribadi_percent')->first()->value / 100;
        // fetch data wakaf_base user
        $wakaf_bases = DB::table('pa_transaction')->where('ref_code', $code)->where('transaction_status', 'complete')->sum('wakaf_base') * $max_pinjam_pribadi_percent;
        // fetch data nom_request
        $nom_request_exist = DB::table('jf_group_anggota')
        ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
        ->where('duta_wakaf_id', $user)
        ->where('jf_pinjam.status', 'request')
        ->sum('nominal_request');
        // fetch data keanggotaan in group
        $table_pinjam = DB::table('jf_group_anggota')
        ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
        ->where('duta_wakaf_id', $user);
        // serve data sum pinjam user auth
        $total_pinjam_user = $table_pinjam
        ->sum('nominal_accepted');
        // serve data yang telah dikembalikan/dicicil
        $cicilan_user = $table_pinjam->join('jf_cicilan', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
        ->where('is_valid', 1)
        ->sum('nominal');
        // serve data masih bisa dipinjam(pinjam aktif)
        $sisa_pinjam_user = $total_pinjam_user - $cicilan_user;
        // max_pinjam from db
        $max_pinjam = $wakaf_bases - $nom_request_exist - $sisa_pinjam_user;

       // check if nom_request > max_pinjam
       if ($nom_request > $max_pinjam){
            return response()->json([
                'status' => 400,
                'message' => 'Bad Request!',
                'errors' => $data_pinjaman->errors()->add('nominal_request', 'Nominal pinjam melebihi maksimal nominal pinjam')
            ]);
        }
        // check if nom_request > max_pinjam return back
        if ($max_pinjam <= 0 || $nom_request <= 0){
            return response()->json([
                'status' => 400,
                'message' => 'Bad Request!',
                'errors' => $data_pinjaman->errors()->add('nominal_request', 'Nominal pinjam atau maksimal pinjam tidak valid')
            ]);
        }
        // set minimum request pinjam anggota
        $min_pinjam = DB::table('jf_setting')->where('key', 'min_request_pinjam_anggota')->first()->value;
        if ($nom_request < $min_pinjam){
            return response()->json([
                'status' => 400,
                'message' => 'Bad Request!',
                'errors' => $data_pinjaman->errors()->add('nominal_request', 'Nominal pinjam dibawah minimum nominal pinjam')
            ]);
        }

        //calculate mudharabah
        $dbpercent = jf_setting::where('key', 'mudharabah_percent')->first()->value;
        $percent = $dbpercent / 100;
        $total_mudharabah = $cicilanpokok * $percent;
        $cicilan_modharabah = $total_mudharabah;
        $cicilan_perbulan = $cicilanpokok + $cicilan_modharabah;

        $duta_wakaf_id = auth()->user()->id;
        $group_anggota = group_anggota::where('duta_wakaf_id', $duta_wakaf_id)->where('status', '1')->first();

        if ($group_anggota) {
            $pinjam = jf_pinjam::create([
                'group_anggota_id' => $group_anggota->id,
                'nominal_request' => $nom_request,
                'desc_request' => $request->desc_request,
                'total_mudharabah' => $total_mudharabah,
                'status' => 'request',
                'tenor' => $conversitenor,
                'cicilan_perbulan' => $cicilan_perbulan,
                'cicilan_pokok' => $cicilanpokok,
                'cicilan_modharabah' => $cicilan_modharabah,
            ]);

            // add log to tracking
            app('App\Http\Controllers\TrackingPinjamanAnggotaController')->addUpdateTrackingPinjam($pinjam->id, Carbon::now());

            // soon give sw / message
            return redirect()->route('anggota.pinjam.my');
        } else {
            // soon give sw / message
            return back();
        }
    }

    public function delete($id)
    {
        $process = jf_pinjam::find($id);
        // $process->delete();
        $user = auth()->user()->id;
        $data = DB::table('jf_pinjam')->select(
            'jf_pinjam.*'
        )->where('jf_pinjam.group_anggota_id', $user)->get();
        return view('backoffice/pengajuanpinjam/pengajuanpinjam')->with(['data' => $data]);
    }

    public function edit($id)
    {
        // checking if another anggota was do approval, then request pinjam cannot be update
        $data_approval_anggota = DB::table('jf_pinjam_approval')
        ->where('jf_pinjam_approval.pinjam_id', $id)
        ->first();

        $data_approval_pendamping = DB::table('jf_pinjam_approval_by_pendamping')
        ->where('jf_pinjam_approval_by_pendamping.pinjam_id', $id)
        ->first();

        $data_approval_nazhir = DB::table('jf_pinjam_approval_by_nazhir')
        ->where('jf_pinjam_approval_by_nazhir.pinjam_id', $id)
        ->first();

        if ($data_approval_anggota || $data_approval_pendamping || $data_approval_nazhir) {
            return response()->json([
                'status' => 406,
                'message' => 'Request pinjam sudah tidak bisa diedit',
            ]);
        }

        // get pinjam by id
        $data = jf_pinjam::find($id);

        // check & calc nom_request must <= max_pinjam
        $user = auth()->user()->id;
        $code = auth()->user()->duta_refcode;
        $max_pinjam_pribadi_percent = jf_setting::where('key', 'max_pinjam_pribadi_percent')->first()->value / 100;
        // fetch data wakaf_base user
        $wakaf_bases = DB::table('pa_transaction')->where('ref_code', $code)->where('transaction_status', 'complete')->sum('wakaf_base') * $max_pinjam_pribadi_percent;
        // fetch data nom_request
        $nom_request_exist = DB::table('jf_group_anggota')
        ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
        ->where('duta_wakaf_id', $user)
        ->where('jf_pinjam.status', 'request')
        ->sum('nominal_request');
        // fetch data keanggotaan in group
        $table_pinjam = DB::table('jf_group_anggota')
        ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
        ->where('duta_wakaf_id', $user);
        // serve data sum pinjam user auth
        $total_pinjam_user = $table_pinjam
        ->sum('nominal_accepted');
        // serve data yang telah dikembalikan/dicicil
        $cicilan_user = $table_pinjam->join('jf_cicilan', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
        ->where('is_valid', 1)
        ->sum('nominal');
        // serve data masih bisa dipinjam(pinjam aktif)
        $sisa_pinjam_user = $total_pinjam_user - $cicilan_user;
        // max_pinjam from db

        // regulation editing request pinjam
        $max_pinjam = $wakaf_bases - $nom_request_exist - $sisa_pinjam_user;
        $min_pinjam = DB::table('jf_setting')->where('key', 'min_request_pinjam_anggota')->first()->value;
        $max_tenor = jf_setting::where('key', 'max_tenor')->first()->value;

        // regulation add to json data
        $data->max_pinjam = $max_pinjam;
        $data->min_pinjam = (int)$min_pinjam;
        $data->max_tenor = $max_tenor;

        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
            ]);
        }
    }

    public function update(Request $request)
    {
        // return $request->all();

        $data_pinjaman = Validator::make($request->all(), [
            'nominal_request' => 'required',
            'tenor' => 'required',
            'desc_request' => 'required',
        ]);

        //data cicilan pokok
        $convert_tenor = (intval($request->tenor) * 12);
        $convert_nom_request = (int)str_replace(['Rp. ', '.', ','], '', $request->nominal_request);
        $cicilan_pokok = $convert_nom_request / $convert_tenor;

        // check & calc nom_request must <= max_pinjam
        $user = auth()->user()->id;
        $code = auth()->user()->duta_refcode;
        $max_pinjam_pribadi_percent = jf_setting::where('key', 'max_pinjam_pribadi_percent')->first()->value / 100;
        // fetch data wakaf_base user
        $wakaf_bases = DB::table('pa_transaction')->where('ref_code', $code)->where('transaction_status', 'complete')->sum('wakaf_base') * $max_pinjam_pribadi_percent;
        // fetch data nom_request
        $nom_request_exist = DB::table('jf_group_anggota')
        ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
        ->where('duta_wakaf_id', $user)
        ->where('jf_pinjam.status', 'request')
        ->sum('nominal_request');
        // fetch data keanggotaan in group
        $table_pinjam = DB::table('jf_group_anggota')
        ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
        ->where('duta_wakaf_id', $user);
        // serve data sum pinjam user auth
        $total_pinjam_user = $table_pinjam
        ->sum('nominal_accepted');
        // serve data yang telah dikembalikan/dicicil
        $cicilan_user = $table_pinjam->join('jf_cicilan', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
        ->where('is_valid', 1)
        ->sum('nominal');
        // serve data masih bisa dipinjam(pinjam aktif)
        $sisa_pinjam_user = $total_pinjam_user - $cicilan_user;
        // max_pinjam from db
        $max_pinjam = $wakaf_bases - $nom_request_exist - $sisa_pinjam_user;

        // check if nom_request > max_pinjam
        if ($convert_nom_request > $max_pinjam){
            return response()->json([
                'status' => 400,
                'message' => 'Bad Request!',
                'errors' => $data_pinjaman->errors()->add('nominal_request', 'Nominal pinjam melebihi maksimal nominal pinjam')
            ]);
        }
        // check if nom_request > max_pinjam return back
        if ($max_pinjam <= 0 || $convert_nom_request <= 0){
            return response()->json([
                'status' => 400,
                'message' => 'Bad Request!',
                'errors' => $data_pinjaman->errors()->add('nominal_request', 'Nominal pinjam atau maksimal pinjam tidak valid')
            ]);
        }
        // set minimum request pinjam anggota
        $min_pinjam = DB::table('jf_setting')->where('key', 'min_request_pinjam_anggota')->first()->value;
        if ($convert_nom_request < $min_pinjam){
            return response()->json([
                'status' => 400,
                'message' => 'Bad Request!',
                'errors' => $data_pinjaman->errors()->add('nominal_request', 'Nominal pinjam dibawah minimum nominal pinjam')
            ]);
        }

        //calculate mudharabah
        $dbpercent = jf_setting::where('key', 'mudharabah_percent')->first()->value;
        $percent = $dbpercent / 100;
        $total_mudharabah = $cicilan_pokok * $percent;
        $cicilan_modharabah = $total_mudharabah;
        $cicilan_perbulan = $cicilan_pokok + $cicilan_modharabah;

        if ($data_pinjaman->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Bad Request!',
                'errors' => $data_pinjaman->errors()
            ]);

        } else {

            $pinjaman = jf_pinjam::find($request->id);

            $pinjaman->nominal_request = $convert_nom_request;
            $pinjaman->tenor = $convert_tenor;
            $pinjaman->desc_request = $request->desc_request;

            $pinjaman->total_mudharabah = $total_mudharabah;
            $pinjaman->cicilan_perbulan = $cicilan_perbulan;
            $pinjaman->cicilan_modharabah = $cicilan_modharabah;
            $pinjaman->cicilan_pokok = $cicilan_pokok;

            $pinjaman->update();

            return response()->json([
                'status' => 200,
                'data' => 'data success stored!'
            ]);
        }
    }

    public function detailRequestPinjamExtend($id)
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
        $user = auth()->user();
        $group_anggota = DB::table('jf_group_anggota')->where('duta_wakaf_id', $user->id)->first();

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
        $is_show_cicilan = false;
        if ($id_user_owned_by_requester->duta_wakaf_id == $user->id){
            $is_show_cicilan = true;
        }
        $data->is_show_cicilan = $is_show_cicilan;

        return view('anggota.content.detail-request-pinjam-extend')->with(['data' => $data]);
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

    public function detailRequestPinjam($id)
    {
        // old
        // $data = jf_pinjam::findOrFail($id);

        $user = auth()->user();

        // dd($user);

        // new query
        $data_pinjam = DB::table('jf_pinjam')->where('jf_pinjam.id', $id)
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->select('pa_duta_wakaf.duta_name', 'jf_pinjam.*')->first();

        $data_tracking_pinjam = JfTrackingPinjamanAnggota::where('pinjam_id', $id)->first();

        $data_pinjam_approval_by_anggotas = DB::table('jf_pinjam')->where('jf_pinjam.id', $id)
        ->join('jf_pinjam_approval', 'jf_pinjam.id', '=', 'jf_pinjam_approval.pinjam_id')
        ->join('jf_group_anggota', 'jf_pinjam_approval.group_anggota_id', '=', 'jf_group_anggota.id')
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        ->where('jf_group_anggota.duta_wakaf_id', $user->id)
        ->select
        (
            'pa_duta_wakaf.duta_name as name',
            'jf_pinjam_approval.status',
            'jf_pinjam_approval.note',
            'jf_pinjam_approval.accepted_at',
            'jf_pinjam_approval.id as approval_id'
        )
        ->first();

        $data['data_pinjam'] = $data_pinjam;
        $data['data_tracking_pinjam'] = $data_tracking_pinjam;
        $data['data_pinjam_approval_by_anggotas'] = $data_pinjam_approval_by_anggotas;

        if ($data) {
            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Not Found',
            ]);
        }
    }

    public function createUpdateApprovalPinjam(Request $request)
    {
        // init data user to get who approve pinjaman
        $user = auth()->user();
        $group_anggota = DB::table('jf_group_anggota')->where('duta_wakaf_id', $user->id)->first();

        $amount_approval = jf_pinjam_approval::where('pinjam_id', $request->pinjam_id);
        $amount_anggota_in_group = DB::table('jf_group_anggota')->where('group_id', $group_anggota->group_id);

        // check if user was approve this pinjam
        if (count($amount_approval->where('group_anggota_id', $group_anggota->id)->get()) > 0){
            return response()->json([
                'status' => 400,
                'message' => 'Anda sudah melakukan approval'
            ]);
        }

        // check if kuoat approval is full (depend on amount of anggota in one group) (-1 is except approval anggota itself)
        if (count($amount_approval->get()) > (count($amount_anggota_in_group->get()) - 1)){
            return response()->json([
                'status' => 400,
                'message' => 'Kuota Approval Penuh, Semua anggota telah melakukan approval'
            ]);
        }

        // set if note is null or filled
        $note = null;
        if ($request->note){
            $note = $request->note;
        }

        // set if note is filled or null(set value 'draft')
        $status = 'draft';
        if ($request->status){
            $status = $request->status;
        }

        jf_pinjam_approval::updateOrCreate(
            [
                // init if pinjam_id from request is exist in db do update, if doesn't exist do create new (pivot)
                'pinjam_id' => $request->pinjam_id,
                'group_anggota_id' => $group_anggota->id,
            ],
            [
                // data that be update/create
                // 'pinjam_id' => $request->pinjam_id,
                'status' => $status,
                'note' => $note,
                'accepted_at' => Carbon::now(),
            ]
        );

        // add log to tracking
        app('App\Http\Controllers\TrackingPinjamanAnggotaController')->addUpdateTrackingPinjam($request->pinjam_id, null, Carbon::now());

        return response()->json([
            'status' => 200,
            'message' => 'Data success stored!'
        ]);

    }

    public function deleteApprovalPinjam($id){
        $data_approval = jf_pinjam_approval::findOrFail($id);
        if ($data_approval) {
            $data_approval->delete();
            return response()->json('data approval deleted', 200);
        } else {
            return response()->json(null, 404);
        }
    }

    public function requestOther()
    {
        return view('anggota.content.other-pinjam-list');
    }

    public function dataAjuanAnggotaLain(Request $request){

        // get data user auth
        $user = auth()->user();
        // get data group that same with user auth
        $group = DB::table('jf_group_anggota')
        ->where('duta_wakaf_id', $user->id)->first();
        // get data all pinjaman user except pinjaman user auth that one group with user auth
        $all_pinjaman = DB::table('jf_pinjam')
        // ->join('jf_pinjam_approval', 'jf_pinjam.id', '=', 'jf_pinjam_approval.pinjam_id')
        ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
        ->where('duta_wakaf_id', '!=', $user->id)
        ->where('group_id', $group->group_id)
        ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
        // ->select('pa_duta_wakaf.duta_name', 'jf_pinjam.*', 'jf_pinjam_approval.status')
        ->select('pa_duta_wakaf.duta_name', 'jf_pinjam.*')
        ->get();

        // request ajax-datatable
        if ($request->ajax()) {
            return datatables()->of($all_pinjaman)
                ->addColumn('action', function ($key) {
                    $actionBtn = "
                    <a role='button' class='detail-request-pinjam btn-info btn-sm' title='Perijinan Anda' data-id=". $key->id ."' data-content='Popover body content is set in this attribute.'>
                    <i class='fas fa-user-plus'></i></a>
                    <a role='button' class='btn-sm btn-info' title='Detail' href='/anggota/detail-request-pinjam-extend/" . $key->id . "' data-content='Detail'>
                    <i class='fas fa-eye'></i></a>
                </button>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }
}
