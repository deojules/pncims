<?php

namespace App\Http\Controllers;

use App\Models\StudentsAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentsAccountController extends Controller
{

    public function index()
    {
        $this->middleware('auth');
        $student = StudentsAccount::find(Auth::guard('student')->user()->id);
        return view('users.app', compact('student'));

    }

    public function StudentRegister(Request $request)
    {
        StudentsAccount::create([

            'stud_id' => $request->stud_id,
            'password' => Hash::make($request->password),

        ]);

            return view('users.index');
    }

    public function StudentLogin(Request $request)
    {
        if(Auth::guard('student')->attempt(['stud_id' => $request->stud_id, 'password' => $request->password]))
        {

          return view('users.index');
        } else {
            return view('/');
        }

    }

    public function logout(Request $request)
    {

        Auth::logout();

        return redirect('/');
    }

    public function SurveyEmployee()
    {
        return view('users.survey');
    }

}
