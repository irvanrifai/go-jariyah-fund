<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jf_setting extends Model
{
    protected $table = 'jf_setting';
    use HasFactory;
    protected $guarded = [
        'id'
    ];
}
