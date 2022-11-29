<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class survey_items extends Model
{
    use HasFactory;

    protected $table = 'survey_items';
    protected $primaryKey = 'item_id';

    protected $hidden = [
        'item_id',
    ];

    protected $appends = [
        'idkey'
    ];

    function getIdkeyAttribute()
    {
        return Crypt::encryptString($this->item_id);
    }
}
