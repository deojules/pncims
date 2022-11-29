<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    use Authenticatable;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postlogin(Request $request)
    {
        if(Auth::guard('student')->attempt(['stud_id' => $request->stud_id, 'password' => $request->password]))

        {
            return redirect('survey');
        }
            return redirect()->back()->withErrors(['stud_id' => 'Incorrect user login details.'])->withInput();

    }

    public function logout(Request $request)
    {
        
        Auth::logout();
        return redirect('/');
    }

    public function username(){

        return'stud_id';
    }
}
