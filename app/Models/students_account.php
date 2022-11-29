<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Crypt;

class students_account extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'students_account';
    protected $primaryKey = 'stud_id';

    protected $fillable = [
        'stud_id',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    
    protected $appends = [
        'idkey'
    ];

    function getIdkeyAttribute()
    {
        return Crypt::encryptString($this->stud_id);
    }

    
    public function info()
    {
        return $this->hasOne('App\Models\students', 'stud_id', 'stud_id');
    }


}
