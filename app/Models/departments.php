<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class departments extends Model
{
    use HasFactory;

        protected $table = 'departments';
        protected $primaryKey = 'dept_id';

        protected $hidden = [
            'dept_id',
        ];



    protected $appends = [
        'idkey'
    ];

    function getIdkeyAttribute()
    {
        return Crypt::encryptString($this->dept_id);
    }

    public function head()
    {
        return $this->belongsTo('App\Models\employees', 'dept_head', 'p_id');
    }

    public function div()
    {
        return $this->belongsTo('App\Models\departments', 'division', 'division')->whereIn('level', [0, 1]);
    }

    public function emp_depts()
    {
        return $this->hasMany('App\Models\employees_dept', 'dept_id', 'dept_id');
    }

    public function service_depts()
    {
        return $this->hasMany('App\Models\departments_service', 'dept_id', 'dept_id');
    }
}
