<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class GuestController extends Controller
{
   

    public function Guestlogin(Request $request)
    {

        $credentials = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'type' => 'required',
            'others',
            'stud_fname',
            'stud_lname',
        ]);

        session([
            'client' => Crypt::encryptString(0),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'stud_fname' => $request->stud_fname,
            'stud_lname' => $request->stud_lname,
            'guest' => true,
            'type' => $request->type,
        ]);


        return redirect('survey');

        


    }
}

