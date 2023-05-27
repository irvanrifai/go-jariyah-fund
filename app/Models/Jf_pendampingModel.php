<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jf_pendampingModel extends Model
{
    protected $table = 'jf_pendamping';
    use HasFactory;
    protected $guarded = [
        'id'
    ];
}
