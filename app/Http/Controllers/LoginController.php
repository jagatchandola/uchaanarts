<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Models\Artists;
use App\Models\Cart;
use Illuminate\Http\Request;
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
        $this->cart = new Cart();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {

            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {                
                $cartItemCount = $this->cart->addToCart(array_keys($_SESSION['cart']));
                $_SESSION['cart'] = $cartItemCount;
            } else {
                $cartItemCount = $this->cart->getCartItemCount();
                $_SESSION['cart'] = $cartItemCount;
            }
            
            if(Auth::user()->user_role == 'user')
                return redirect()->route('home');
            else
                return redirect('/admin/dashboard');;
        } else {
            Session::flash('error-msg', "Invalid email/password");
            return redirect('login');
        }
        
    }

    public function logout(Request $request)
    {
        Session::flush();
        $_SESSION['cart'] = '';
        // unset($_SESSION['cart']);
        Auth::logout();
        return redirect('/');
    }
}
