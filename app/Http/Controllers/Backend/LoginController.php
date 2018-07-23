<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Models\Artists;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->user = new User();
        $this->artists = new Artists();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')) {
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/backend/login')->with('flash_message_error','Invalid Username or Password');
            }
        }
        
        return view('backend.login');
    }
    
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/backend/login')->with('flash_message_success','Logged out Successfully'); 
    }
}

