<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\jf_pinjam;
use App\Models\group_anggota;
use App\Models\GroupModel;
use DB;

class DashboardAdminController extends Controller
{
    public function index(){
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
        //dd($ddd);

        $charData="";
        foreach($ddd as $list){
            $charData.=$list->duit;
        }
        $arr=rtrim($charData);
       //dd($charData);
       
     $total_all=(int)$total_dana_project+(int)$charData;//total dana seluruh kelompok
    // dd($total_all);
    
        $totalajuan = jf_pinjam::count();
        $tomu = DB::table('jf_pinjam')->sum('total_mudharabah');//Dana Bersama
        $req = DB::table('jf_pinjam')->sum('status', '=', 'request','&&', 'accepted');
        $acc = DB::table('jf_pinjam')->sum('nominal_accepted');//pinjaman aktif
       // $total_wakaf = DB::table('pa_transaction')->sum('wakaf_base','*', 'wakaf_qty');//1
        $fin = $total_all-$acc;//total nominal sisa pinjaman
        //dd($acc,$total_wakaf,$fin);

        $bayar_cicil=DB::table('jf_cicilan')->sum('nominal');
        $final=$fin+$bayar_cicil;//total dana belum dipinjam
       //dd($final);
        return view('admin/dashboard')->with(compact('totalkelompok','total_all' ,'totalgroup','final','totalajuan', 'tomu','req', 'acc', 'fin'));
    }
}