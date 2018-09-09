<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductEnquiry;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Session;
use Illuminate\Support\Facades\Auth;
use Gate;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
        $this->enquiry = new ProductEnquiry();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function queris()
    {
        $id = '';
        if (Auth::user()->user_role == 'artist') {
            $id = Auth::user()->id;
        }
        
        $quries = $this->enquiry->getProductEnqiries($id);
        return view('backend.order.enquiry')->with([
                                    'quries' => $quries
                                ]);
    }
    
}
