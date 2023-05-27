<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class jf_pinjam extends Model
{
    use HasFactory;
    protected $table = 'jf_pinjam';
    protected $guarded = ['id'];
    protected $fillable = [
        'group_anggota_id',
        'nominal_request',
        'desc_request',
        'nominal_accepted',
        'status',
        'tenor',
        'total_mudharabah',
        'cicilan_perbulan',
        'cicilan_pokok',
        'cicilan_modharabah',
    ];

    public function fetch_std_peminjam()
    {
        $query = DB::table('jf_pinjam')->select(
            'pa_duta_wakaf.duta_name'
        );
        $query = $query
            ->join('jf_group_anggota', 'jf_pinjam.group_anggota_id', '=', 'jf_group_anggota.id')
            ->join('pa_duta_wakaf', 'jf_group_anggota.duta_wakaf_id', '=', 'pa_duta_wakaf.id')->distinct()->get();
        return $query;
    }
}
