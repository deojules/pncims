<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class employees_dept extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'employees_dept';
    protected $primaryKey = 'ed_id';




    protected $fillable = [

        'p_id',
        'dept_id'
    ];



    protected $hidden = [
        'ed_id',
    ];

    protected $appends = [
        'idkey'
    ];

    function getIdkeyAttribute()
    {
        return Crypt::encryptString($this->ed_id);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\employees', 'p_id', 'p_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\departments', 'dept_id', 'dept_id');
    }
}

