<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jf_pinjam_approval extends Model
{
    protected $table = 'jf_pinjam_approval';
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public $timestamps = true;
}
