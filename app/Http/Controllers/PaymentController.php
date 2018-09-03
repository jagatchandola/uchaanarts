<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Catalogue;
use App\Models\ProductOrder;
use App\Helpers\Helper;
use Gate;
use Session;
use Auth;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->events = new Events();
        $this->catalogue = new Catalogue();
        $this->order = new ProductOrder();
    }

    /**
     * Validate event payment link and redirect to PG
     *
     * @return \Illuminate\Http\Response
     */
    public function eventPayment($payment_link)
    {
        $result = $this->events->checkLink($payment_link);

        if ($result === false) {
            Session::flash('error_message', 'Invalid link');
            return redirect('/');
        }
        
        //@todo redirect to Payment Gateway
    }

    public function paymentResponse(Request $request) {
        $inputData = $request->all();
        
        if ($inputData['status'] == 'success') {
            $result = $this->events->updatePayment($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Payment successful!');
                redirect('/');
            } else {
                Session::flash('error_message', 'Payment unsuccessful!');
                redirect('/');
            }
        }
    }
    
    public function productPayment($product_id) {
        $productDetail = $this->catalogue->getProductDetails($product_id);

        if (!empty($productDetail)) {
            $calculateData = [
                                        'price' => $productDetail[0]->price,
                                        'gst' => $productDetail[0]->gst,
                                        'discountType' => $productDetail[0]->discount,
                                        'discountValue' => $productDetail[0]->discount_value
                                    ];

            $totalPrice = Helper::calculatePrice($calculateData);
            
            if(Auth::user()) {
                $this->order->addOrder(Auth::user()->id, $product_id, $totalPrice);
            }
        }

        return view('checkout-pay')->with([
                                        'productDetail' => array_shift($productDetail),
                                        'totalPrice'    => $totalPrice
                                    ]);
    }
}
