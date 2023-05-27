<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CicilanModel extends Model
{
    use HasFactory;
    protected $table = 'jf_cicilan';
    protected $guarded = ['id'];

    public function fetch_std()
    {
        $query = DB::table('jf_cicilan')->select(
            'pa_duta_wakaf.duta_name'
        );
        $query = $query
            ->join('jf_pinjam', 'jf_cicilan.pinjam_id', '=', 'jf_pinjam.id')
            ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
            ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')
            ->distinct()
            ->get();
        return $query;
    }

    public function fetch_result()
    {
        $query = DB::table('jf_cicilan')->select('nominal as nominal')->distinct()->get();
        return $query;
    }

    public function fetch()
    {
        $query = DB::table('jf_cicilan')->select('*')->get();
        return $query;
    }

    public function fetch_filter($std, $res)
    {
        $query = DB::table('jf_cicilan')->select('*')->where('duta_name', '=', $std && 'nominal', '=', $res)->get();
        return $query;
    }

    public function fetch_std_filter($std)
    {
        $query = DB::table('jf_cicilan')->select('*')->where('duta_name', '=', $std)->get();
        return $query;
    }

    public function fetch_res_filter($res)
    {
        $query = DB::table('jf_cicilan')->select('*')->where('nominal', '=', $res)->get();
        return $query;
    }
}
