<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departments_service extends Model
{
    use HasFactory;


    protected $table = 'departments_service';
    protected $primaryKey = 'service_id';

    protected $hidden = [
        'service_id',
    ];


    public function depts()
    {
        return $this->belongsTo('App\Models\departments', 'dept_id', 'dept_id');
    }


}
