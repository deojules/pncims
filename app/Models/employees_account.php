<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;


class employees_account extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'employees_account';
    protected $primaryKey = 'p_id';

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'p_id',
        'passkey',
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'idkey'
    ];

    function getIdkeyAttribute()
    {
        return Crypt::encryptString($this->p_id);
    }

    public function info()
    {
        return $this->hasOne('App\Models\employees', 'p_id', 'p_id');
    }

    public function admin()
    {
        return $this->hasOne('App\Models\systems_admin', 'account_id', 'account_id')->where('system', 'pnc-feedback');
    }

    public function emp_depts()
    {
        return $this->hasMany('App\Models\employees_dept', 'p_id', 'p_id');
    }
}
