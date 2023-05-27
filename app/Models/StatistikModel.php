<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StatistikModel extends Model
{
    public function AllData(){
        return DB::table('danabersama')->get();
    }
}
