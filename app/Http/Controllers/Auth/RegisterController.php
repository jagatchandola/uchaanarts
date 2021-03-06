<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\Helper;
use App\Models\Cart;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/gallery/add';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->cart = new Cart();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (isset($data['checkout'])) {
            $this->redirectTo = '/checkout';
            
            $user = User::create([
                'uname' => $data['name'] . ' ' . $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'user_role' => 'user',
                'phone' => $data['phone_no'],
                'shipping_address' => $data['shipping_address'],
                'billing_address' => $data['billing_address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'pcode' => $data['pincode'],
                'country' => $data['country'],
            ]);

            $user->username = Helper::nameFormat($data['name']) . '-' . $user->id;
            $user->save();
            
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {                
                $cartItemCount = $this->cart->addToCart(array_keys($_SESSION['cart']), $user->id);
                $_SESSION['cart'] = $cartItemCount;
            }
            
            return $user;
        } 
        
        if (isset($data['artist_image'])) {
            $image = $data['artist_image'];
            $title = str_replace(' ', '-', strtolower($data['name']));
            $name = str_slug($title) .'-'.time() . '.' . $image->getClientOriginalExtension();
            // $destinationPath = public_path(config('constants.uploads.artists'));
            // $image->move($destinationPath, $name);

            $data['image'] = $name;
        }

        $user = User::create([
            'uname' => $data['name'],
            // 'username' => Helper::nameFormat($data['name']).'-','LAST_INSERT_ID()',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_role' => $data['user_role'],
            'phone' => $data['mobile'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'pcode' => $data['pincode'],
            'profimg' => $data['image'],
            'about' => $data['about'],
            'awards' => $data['awards'],
            'education' => $data['qualification']
        ]);

        $user->username = Helper::nameFormat($data['name']).'-'.$user->id;
        // print_r($user);die;
        if (isset($data['artist_image'])) {
            // $image = $data['artist_image'];
            // $title = str_replace(' ', '-', strtolower($data['name']));
            // $name = str_slug($title) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path(config('constants.uploads.artists')) . $user->username . '/';
            $image->move($destinationPath, $name);

        }
        $user->save();

        return $user;
    }
}
