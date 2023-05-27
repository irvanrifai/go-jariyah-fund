<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class duta_wakaf extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected $primaryKey = 'id';
    public $table='pa_duta_wakaf';
    protected $fillable = [
        'provinsi_id',
        'kabupaten_id',
        'duta_type',
        'parent_id',
        'nazhir_id',
        'license_number',
        'duta_name',
        'duta_username',
        'duta_birth_place',
        'duta_birth',
        'duta_gender',
        'duta_phone',
        'duta_email',
        'duta_password',
        'duta_last_education',
        'bt_graduate_date',
        'duta_job',
        //'license_number',
        'duta_bank_name',
        'duta_bank_branch',
        'duta_bank_account',
        'duta_bank_account_name',
        'duta_refcode',
        'duta_reason'
    ];

    public function getAuthPassword(){
        return $this->duta_password;
    }
 /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'duta_password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
