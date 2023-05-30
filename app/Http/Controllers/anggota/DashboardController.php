<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saran;
use App\Models\jf_pinjam;
use App\Models\Report_gratifikasi;
use App\Models\ReportConflictInterest;
use App\Models\WbsTopic;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user()->id;

        $is_user_exist_in_group = DB::table('jf_group_anggota')->where('duta_wakaf_id', $user)->first();
        if (!$is_user_exist_in_group){
            return back()->withErrors([
                'credentials_error' => 'You are not a member yet!'
            ]);
        }

        //Total Pengajuan Pribadi
        $user_ajuan = DB::table('jf_group_anggota')->select(
            '*',
            'jf_pinjam.*'
        )->where('jf_group_anggota.duta_wakaf_id', $user);
        $user_ajuan = $user_ajuan
            ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
            ->count();

        //Total Pengajuan Pribadi Yang Disetujui
        $user_ajuan_acc = DB::table('jf_group_anggota')->select(
            'jf_pinjam.status as status'
        )->where('jf_group_anggota.duta_wakaf_id', $user);
        $user_ajuan_acc = $user_ajuan_acc
            ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
            ->where('jf_pinjam.status', '=', 'accepted')
            ->count();

        // get data one group with user logged in
        $group_id = DB::table('jf_group_anggota')
        ->where('jf_group_anggota.duta_wakaf_id', $user)
        ->first()->group_id;

        //Total Pengajuan Seluruh Anggota
        $group = DB::table('jf_group_anggota')
            ->where('group_id', $group_id)
            ->get();

        // init var 0 for filled amount ajuan group
        $group_ajuan = 0;
        // looping to get all user in one group/project
        for ($i=0; $i < count($group) ; $i++) {
            $group_ajuan += DB::table('jf_pinjam')->where('group_anggota_id', $group[$i]->id)->count();
        }

        // init var 0 for filled amount ajuan group approved
        $group_ajuan_acc = 0;

        //Total Pengajuan Anggota Yang Disetujui looping
        for ($i=0; $i < count($group) ; $i++) {
            $group_ajuan_acc += DB::table('jf_pinjam')
            ->where('group_anggota_id', $group[$i]->id)
            ->where('status', 'accepted')
            ->count();
        }

        return view('backoffice.dashboard')->with(compact(
            'user_ajuan',
            'user_ajuan_acc',
            'group_ajuan',
            'group_ajuan_acc',
        ));
    }

    public function chartPinjamanAktifAnda(){

        // GUIDE BUSSINESS LOGIC
        // Total Pinjam user sdg login
        // Dikembalikan/disaur usr sdg login
        // Sisa yg masih bisa di Pinjam user sdg login

        // init user auth
        $user = auth()->user();

        // fetch data keanggotaan in group
        $table_pinjam = DB::table('jf_group_anggota')
        ->join('jf_pinjam', 'jf_group_anggota.id', '=', 'jf_pinjam.group_anggota_id')
        ->where('duta_wakaf_id', $user->id);

        // serve data sum pinjam user auth
        $total_pinjam_user = $table_pinjam
        ->sum('nominal_accepted');

        // serve data yang telah dikembalikan/dicicil
        $cicilan_user = $table_pinjam->join('jf_cicilan', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
        ->where('is_valid', 1)
        ->sum('nominal');

        // serve data masih bisa dipinjam
        $sisa_pinjam_user = $total_pinjam_user - $cicilan_user;

        $data[0] = ['value' => $total_pinjam_user, 'name' => 'Total Pinjam'];
        $data[1] = ['value' => $cicilan_user, 'name' => 'Dikembalikan'];
        $data[2] = ['value' => $sisa_pinjam_user,'name' => 'Sisa Pinjam'];


        // dummy data for demo, you can comment this code, used for temp
        // $data[0] = ['value' => 120000, 'name' => 'Total Pinjam'];
        // $data[1] = ['value' => 20000, 'name' => 'Dikembalikan'];
        // $data[2] = ['value' => 100000,'name' => 'Sisa Pinjam'];
        // end of dummy data

        return $data;
    }

    public function chartAkumulasiAnda(){

        // GUIDE BUSSINES LOGIC
        // Total Penghimpunan user sdg login
        // Total Pinjam user sdg login
        // Sisa Penghimpunan user sdg login

        // init user auth
        $user = auth()->user();

        // fetch data keanggotaan in group
        $group = DB::table('jf_group_anggota')
        ->where('duta_wakaf_id', $user->id)
        ->first();

        // fetch data group
        $project = DB::table('jf_group')
        ->where('id', $group->id)
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
        ->sum('nominal_accepted');

        // sisa penghimpunan data
        $sisa_penghimpunan_user = $total_penghimpunan_user - $total_pinjam_user;

        // parsing data
        $data[0] = ['value' => $total_penghimpunan_user, 'name' => 'Total penghimpunan'];
        $data[1] = ['value' => $total_pinjam_user, 'name' => 'Total Pinjam'];
        $data[2] = ['value' => $sisa_penghimpunan_user, 'name' => 'Sisa Penghimpunan'];

        // dummy data for demo, you can comment this code, used for temp
        // $data[0] = ['value' => 1000000, 'name' => 'Total penghimpunan'];
        // $data[1] = ['value' => 150000, 'name' => 'Total Pinjam'];
        // $data[2] = ['value' => 1000000 - 150000, 'name' => 'Sisa Penghimpunan'];
        // end of dummy data

        return $data;
    }

    public function chartPengumpulanDanaWakafAll(){

        // GUIDE BUSSINES LOGIC
        // total pengumpulan dana Pribadi sdg login : 15jt (15%), where project id, where refcode = usr_login, where status complete, get wakaf_base
        // total pengumpulan dana Anggota Lain (except usr sdg login) : 80jt (80%) where project id, where refcode != usr login, where status complete, get wakaf_base
        // total pengumpulan dana utk Projek sdg login : 5jt (5%) where project id, where not refcode anggota anymore, where status complete, get wakaf_base

        // init user auth
        $user = auth()->user();

        // fetch data keanggotaan in group
        $group = DB::table('jf_group_anggota')
        ->where('duta_wakaf_id', $user->id)
        ->first();

        // fetch data group
        $project = DB::table('jf_group')
        ->where('id', $group->id)
        ->first();

        // data dana depend => project, transaction_status
        $dana = DB::table('pa_transaction')
        ->where('project_id', $project->project_id)
        ->where('transaction_status', 'complete');

        // query pengumpulan dana user auth depend => refcode
        $dana_user = $dana
        ->where('ref_code', $user->duta_refcode)
        ->sum('wakaf_base');

        // query pengumpulan dana all user in same project except user auth depend => refcode
        $dana_other = $dana
        ->where('ref_code', '!=', $user->duta_refcode)
        ->sum('wakaf_base');

        // query pengumpulan dana for project who user auth included depend => refcode
        $dana_project = $dana
        ->where('ref_code', null)
        ->sum('wakaf_base');

        // parsing data
        $data['data_series']= [
            $dana_user,
            $dana_other,
            $dana_project
        ];
        $data['data_labels'] = [
            'Anda | ' . 'Rp. ' . number_format($dana_user),
            'Anggota lain | ' . 'Rp. ' . number_format($dana_other),
            'Project | ' . 'Rp. ' . number_format($dana_project)
        ];

        // dummy data for demo, you can comment this code, used for temp
        // $data['data_series']= [
        //     15000000,
        //     80000000,
        //     5000000
        // ];
        // $data['data_labels'] = [
        //     'Anda | ' . 'Rp. ' . number_format(15000000),
        //     'Anggota lain | ' . 'Rp. ' . number_format(80000000),
        //     'Project | ' . 'Rp. ' . number_format(5000000)
        // ];
        // end of dummy data

        return $data;
    }

    public function chartPeminjamanDanaWakafAll(){

        // GUIDE BUSSINES LOGIC
        // jumlah uang dipinjam Pribadi usr sedang login : 8jt (10%)
        // jumlah uang dipinjam Anggota Lain (except usr sdg login) : 75jt (90%)

        // init user auth
        $user = auth()->user();

        // fetch data user auth keanggotaan in group
        $group_user = DB::table('jf_group_anggota')
        ->where('duta_wakaf_id', $user->id)
        ->first();

        // fetch data except user auth keanggotaan in group
        $group_other = DB::table('jf_group_anggota')
        ->where('duta_wakaf_id', '!=', $user->id)
        ->where('group_id', $group_user->group_id)
        ->get()->toArray();

        // init 0 variable, after loop, will filled data sum all user except user auth
        $pinjam_other = 0;

        // for-loop to assign nominal to variable 0
        for ($i = 0 ; $i < count($group_other) ; $i++) {
            $pinjam_other += DB::table('jf_pinjam')
            ->where('group_anggota_id', $group_other[$i]->id)
            ->sum('nominal_accepted');
        }

        // serve data sum user auth
        $pinjam_user = DB::table('jf_pinjam')
        ->where('group_anggota_id', $group_user->id)
        ->sum('nominal_accepted');

        // parsing data
        $data['data_series'] = [
            (int)$pinjam_user,
            $pinjam_other
        ];
        $data['data_labels'] = [
            'Anda | ' . 'Rp. ' . number_format($pinjam_user),
            'Anggota lain | ' . 'Rp. ' . number_format($pinjam_other)
        ];

        // dummy data for demo, you can comment this code, used for temp
        // $data['data_series'] = [
        //     8000000,
        //     75000000
        // ];
        // $data['data_labels'] = [
        //     'Anda | ' . 'Rp. ' . number_format(8000000),
        //     'Anggota lain | ' . 'Rp. ' . number_format(75000000)
        // ];
        // end of dummy data

        return $data;
    }

    public function chartPinjamanAktifAll(){

        // GUIDE BUSSINES LOGIC
        // Total bisa Pinjam semuanya (belum lunas)
        // total dana Dikembalikan
        // total Sisa

        // init user auth
        $user = auth()->user();

        // fetch data user auth keanggotaan in group
        $group_user = DB::table('jf_group_anggota')
        ->where('duta_wakaf_id', $user->id)
        ->first();

        // fetch data except user auth keanggotaan in group
        $group_all = DB::table('jf_group_anggota')
        ->where('group_id', $group_user->group_id)
        ->get()->toArray();

        // init array variable nil, after loop, will filled data array from jf_pinjam all user in one group
        $pinjam_all = [];
        // for-loop to assign nominal to variable 0
        for ($i = 0 ; $i < count($group_all) ; $i++) {
            if ( DB::table('jf_pinjam')->where('group_anggota_id', $group_all[$i]->id)->get()->toArray() != null){
                array_push($pinjam_all, DB::table('jf_pinjam')
                ->where('group_anggota_id', $group_all[$i]->id)->get()->toArray());
            }
        }

        $total_pinjam_aktif = 0;
        // for-loop to assign nominal to variable 0
        for ($i = 0 ; $i <= count($pinjam_all) ; $i++) {
            $total_pinjam_aktif += DB::table('jf_pinjam')
            ->where('group_anggota_id', $group_all[$i]->id)->sum('nominal_accepted');
        }

        $frequency_pinjam_all = [];

        for ($i=0; $i < count($pinjam_all) ; $i++) {
            for ($j=0; $j < count($pinjam_all[$i]); $j++) {
                array_push($frequency_pinjam_all, $pinjam_all[$i][$j]);
            }
        }

        // serve data yang telah dikembalikan
        $cicilan_all = 0;

        for ($i=0; $i < count($frequency_pinjam_all); $i++) {
            $cicilan_all += DB::table('jf_cicilan')
            ->where('pinjam_id', $frequency_pinjam_all[$i]->id)
            ->where('is_valid', 1)
            ->sum('nominal');
        }

        $sisa_all = $total_pinjam_aktif - $cicilan_all;

        // parsing data
        $data['data_labels'] = [
            'Total Pinjam',
            'Dikembalikan',
            'Sisa Pinjam'
        ];
        $data['datas'] = [
            $total_pinjam_aktif,
            $cicilan_all,
            $sisa_all
        ];

        // dummy data for demo, you can comment this code, used for temp
        // $data['data_labels'] = [
        //     'Total Pinjam',
        //     'Dikembalikan',
        //     'Sisa Pinjam'
        // ];
        // $data['datas'] = [
        //     2300000,
        //     50000,
        //     2300000 - 50000
        // ];
        // end of dummy data

        return $data;
    }

    public function chartAkumulasiAll(){

        // GUIDE BUSSINES LOGIC
        // Total Pinjam (semua status baik complete, lunas, dll)
        // Dikembalikan
        // Sisa Pinjam

        // init user auth
        $user = auth()->user();

        // fetch data user auth keanggotaan in group
        $group_user = DB::table('jf_group_anggota')
        ->where('duta_wakaf_id', $user->id)
        ->first();

        // fetch data except user auth keanggotaan in group
        $group_all = DB::table('jf_group_anggota')
        ->where('group_id', $group_user->group_id)
        ->get()->toArray();

        // init array variable nil, after loop, will filled data array from jf_pinjam all user in one group
        $pinjam_all = [];
        // for-loop to assign nominal to variable 0
        for ($i = 0 ; $i < count($group_all) ; $i++) {
            if ( DB::table('jf_pinjam')->where('group_anggota_id', $group_all[$i]->id)->get()->toArray() != null){
                array_push($pinjam_all, DB::table('jf_pinjam')
                ->where('group_anggota_id', $group_all[$i]->id)->get()->toArray());
            }
        }

        $total_pinjam_aktif = 0;
        // for-loop to assign nominal to variable 0
        for ($i = 0 ; $i <= count($pinjam_all) ; $i++) {
            $total_pinjam_aktif += DB::table('jf_pinjam')
            ->where('group_anggota_id', $group_all[$i]->id)->sum('nominal_accepted');
        }

        $frequency_pinjam_all = [];

        for ($i=0; $i < count($pinjam_all) ; $i++) {
            for ($j=0; $j < count($pinjam_all[$i]); $j++) {
                array_push($frequency_pinjam_all, $pinjam_all[$i][$j]);
            }
        }

        // serve data yang telah dikembalikan
        $cicilan_all = 0;

        for ($i=0; $i < count($frequency_pinjam_all); $i++) {
            $cicilan_all += DB::table('jf_cicilan')
            ->where('pinjam_id', $frequency_pinjam_all[$i]->id)
            ->where('is_valid', 1)
            ->sum('nominal');
        }

        $sisa_all = $total_pinjam_aktif - $cicilan_all;

        // parsing data
        $data['data_labels'] = [
            'Total Pinjam',
            'Dikembalikan',
            'Sisa Pinjam'
        ];
        $data['datas'] = [
            $total_pinjam_aktif,
            $cicilan_all,
            $sisa_all
        ];

        // dummy data for demo, you can comment this code, used for temp
        // $data['data_labels'] = [
        //     'Total Pinjam',
        //     'Dikembalikan',
        //     'Sisa Pinjam'
        // ];
        // $data['datas'] = [
        //     3000000,
        //     550000,
        //     3000000 - 550000
        // ];
        // end of dummy data

        return $data;
    }
}
