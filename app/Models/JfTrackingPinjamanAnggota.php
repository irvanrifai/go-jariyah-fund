<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JfTrackingPinjamanAnggota extends Model
{
    protected $table = 'jf_tracking_pinjaman_anggota';
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public $timestamps = true;
}
