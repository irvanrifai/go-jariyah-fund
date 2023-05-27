<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    use HasFactory;
    protected $table = 'jf_group';
    protected $fillable = [
        'viilage_id',
        'district_id',
        'project_id',
        'status',
        'name'
    ];
}
