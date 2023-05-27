<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\duta_wakaf;
use DB;

class ChartController extends Controller
{
    public function index()
    {
    return view('backoffice/dashboard');
    }

    public function chartproject()
    {
        $result=DB::select(DB::raw("select count(*) as jumlah, SUM(wakaf_base*wakaf_qty) as total, wakaf_base from pa_transaction group_by project_id"));
        $Data="";
        foreach($result as $list){
        $Data.="['".$list->jumlah."', ".$list->total."],";
    }
    
    $arr['charData']=rtrim($Data,",");
    return view('backoffice/dashboard', $arr);
    }
}
