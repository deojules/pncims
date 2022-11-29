<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class systems_admin extends Model
{
    use HasFactory;

    protected $table = 'systems_admin';
    protected $primaryKey = 'admin_id';

    protected $hidden = [
        'admin_id',
    ];

    protected $appends = [
        'idkey'
    ];

    function getIdkeyAttribute()
    {
        return Crypt::encryptString($this->admin_id);
    }

    public function admins()
    {
        return $this->hasMany('App\Models\employees', 'p_id', 'p_id')->where('system', 'pnc-feedback');
    }
}
