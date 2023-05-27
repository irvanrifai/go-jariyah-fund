<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JfDetailDataUsahaAnggota extends Model
{
    protected $table = 'jf_detail_data_usaha_anggota';
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public $timestamps = true;
}
