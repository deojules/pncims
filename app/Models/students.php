<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class students extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'stud_id';

    protected $appends = [
        'idkey'
    ];

    function getIdkeyAttribute()
    {
        return Crypt::encryptString($this->stud_id);
    }

    function getFullnameAttribute() // Dr. Juan Ramos Dela Cruz III
    {
        return $this->fname.' '.$this->mname.' '.$this->lname.' '.$this->ext;
    }

    function getFullname2Attribute() // Dela Cruz, Juan III Ramos
    {
        return $this->lname.', '.$this->fname.' '.$this->ext.' '.$this->mname;
    }

    function getNameAttribute() // Dr. Juan R. Dela Cruz III
    {
        if ($this->mname)
            return $this->fname.' '.$this->mname[0].'. '.$this->lname.' '.$this->ext;
        else
            return $this->fname.' '.$this->lname.' '.$this->ext;
    }

    function getName2Attribute() // Dela Cruz, Juan III R.
    {
        if ($this->mname)
            return $this->lname.', '.$this->fname.' '.$this->ext.' '.$this->mname[0].'.';
        else
            return $this->lname.', '.$this->fname.' '.$this->ext;
    }

    function getInitialsAttribute() // J. R. Dela Cruz
    {
        if ($this->mname)
            return $this->fname[0].'. '.$this->mname[0].'. '.$this->lname;
        else
            return $this->fname[0].'. '.$this->lname;
    }

    public function account()
    {
        return $this->hasOne('App\Models\students_account', 'stud_id', 'stud_id');
    }


}
