<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class survey_responses extends Model
{
    use HasFactory;

    protected $table = 'survey_responses';
    protected $primaryKey = 'response_id';

    protected $hidden = [
        'response_id',
    ];

    protected $appends = [
        'idkey'
    ];

    function getIdkeyAttribute()
    {
        return Crypt::encryptString($this->response_id);
    }

    public function department()
    {
        return $this->belongsTo('App\Models\departments', 'dept_id', 'dept_id');
    }

    public function info()
    {
        return $this->belongsTo('App\Models\employees', 'staff', 'p_id')->withDefault();
    }

    public function getDateAttribute()
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('Y-m-d');

        return $date;
    }



}
