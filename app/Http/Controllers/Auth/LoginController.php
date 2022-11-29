<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\employees_account;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = url()->previous();
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|max:50',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials))
        {

            $p_id = employees_account::where('username', $request->username)->pluck('p_id');

         

            return redirect('user');
            
        }

            
        return redirect()->back()->withErrors(['username' => 'Incorrect user login details.'])->withInput();
    }

    public function username()
    {
        return 'username';
    }
}
