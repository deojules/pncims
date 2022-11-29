<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $icons = array(

        "OUP" => "bi bi-person-fill",
        "OEVP" => "bi bi-people-fill",
        "OVPAA" => "bi bi-building",
        "OVPAF" => "bi bi-bank2",
        "OVPPRE" => "bi bi-book",
        "OVPSDAS" => "bi bi-broadcast",
        "OUS" => "bi bi-person-fill",
        "MISD" => "bi bi-people-fill",
        "CBAA" => "bi bi-building",
        "CCS" => "bi bi-building",
        "CEAS" => "bi bi-building",
        "CENG" => "bi bi-building",
        "CHAS" => "bi bi-building",
        "GS" => "bi bi-building",
        "SHS" => "bi bi-building",
        "TVED" => "bi bi-building",
        "CPED" => "bi bi-building",
        "ULIB" => "bi bi-building",
        "OUR" => "bi bi-building",
        "FD" => "bi bi-bank2",
        "UHD" => "bi bi-bank2",
        "LSDRRMD" => "bi bi-bank2",
        "PMGSD" => "bi bi-bank2",
        "HRMD" => "bi bi-bank2",
        "EBDD" => "bi bi-bank2",
        "RDD" => "bi bi-book",
        "CESD" => "bi bi-book",
        "QMPD" => "bi bi-book",
        "KMID" => "bi bi-book",
        "SDD" => "bi bi-broadcast",
        "SASD" => "bi bi-broadcast",
        "GCD" => "bi bi-broadcast",
        "AD" => "bi bi-broadcast",
        "PALD" => "bi bi-broadcast",
        "GDD" => "bi bi-broadcast",
        "DPD" => "bi bi-people-fill",
        "OAVPAA" => "bi bi-building"
        

    );

    protected $division = array(

        "OUP" => "Office of the University President",
        "EVP" => "Executive Vice President",
        "AA" => "Academic Affairs",
        "AF" => "Administration and Finance",
        "PRE" => " Planning Research & Extension",
        "SDAS" =>  "Student Development & Auxiliary Services",
    );

    
}
