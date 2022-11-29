<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class employees extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'employees';
    protected $primaryKey = 'p_id';

    protected $fillable = [

        'lname',
        'fname'
    ];

    protected $hidden = [
        'p_id',
    ];

    protected $appends = [
        'idkey'
    ];

    function getIdkeyAttribute()
    {
        return Crypt::encryptString($this->p_id);
    }

    function getFullnameAttribute() // Dr. Juan Ramos Dela Cruz III
    {
        return $this->title.' '.$this->fname.' '.$this->mname.' '.$this->lname.' '.$this->ext;
    }

    function getFullname2Attribute() // Dela Cruz, Juan III Ramos
    {
        return $this->lname.', '.$this->fname.' '.$this->ext.' '.$this->mname;
    }

    function getNameAttribute() // Dr. Juan R. Dela Cruz III
    {
        if ($this->mname)
            return $this->title.' '.$this->fname.' '.$this->mname[0].'. '.$this->lname.' '.$this->ext;
        else
            return $this->title.' '.$this->fname.' '.$this->lname.' '.$this->ext;
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
        return $this->hasOne('App\Models\employees_account', 'p_id', 'p_id');
    }

    public function admin()
    {
        return $this->hasOne('App\Models\system_admins', 'p_id', 'p_id')->where('system', 'pnc-feedback');
    }

    public function emp_depts()
    {
        return $this->hasMany('App\Models\employees_dept', 'p_id', 'p_id');
    }
}
