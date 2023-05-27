<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JfPinjamApprovalByPendampingModel extends Model
{
    protected $table = 'jf_pinjam_approval_by_pendamping';
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public $timestamps = true;
}
