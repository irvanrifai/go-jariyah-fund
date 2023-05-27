<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JfPinjamApprovalByNazhir extends Model
{
    protected $table = 'jf_pinjam_approval_by_nazhir';
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public $timestamps = true;
}
