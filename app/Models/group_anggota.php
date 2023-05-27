<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class group_anggota extends Model
{
    protected $table = 'jf_group_anggota';
    use HasFactory;
    protected $fillable = [
        'group_id',
        'duta_wakaf_id',
        'status'
    ];

    public $timestamps = true;

    public function filter_name(){
        $data = DB::table('jf_group_anggota')->select('name')->distinct()->get();
        return $data;
    }
}
