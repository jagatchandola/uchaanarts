<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Catalogue;
use App\Models\ProductOrder;
use App\Models\Cart;
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
        $this->cart = new Cart();
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
    
    public function productPayment() {
        if (!Auth::check()) {
            return redirect('/');
        }
        
//        dd(Auth::user());
        
        $cartItems = $this->cart->getCartItems();
        if (!empty($cartItems)) {
            $totalPrice = 0;
            
            foreach ($cartItems as $productDetail) {
                $calculateData = [
                                            'price' => $productDetail->price,
                                            'gst' => $productDetail->gst,
                                            'discountType' => $productDetail->discount,
                                            'discountValue' => $productDetail->discount_value
                                        ];

                $totalPrice += Helper::calculatePrice($calculateData);
            }
            
            $orderId = Helper::getUniqueId();
            $result = $this->order->addOrder($totalPrice, $orderId);
            
            if ($result === true) {
                $ch = curl_init();

                //curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
                curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                
                // For Production
                /*curl_setopt($ch, CURLOPT_HTTPHEADER,
                            array("X-Api-Key:bb202dc1c0b19cdda7f9f164fbb49ecd",
                                  "X-Auth-Token:d56ee4b8bc8b14301430054fec9fe49c"));*/
                
                // For development
                curl_setopt($ch, CURLOPT_HTTPHEADER,
                            array("X-Api-Key: test_20379e4739c5ee98dbf1258454c",
                                  "X-Auth-Token: test_61bbe938ebc21412d41b830a5ae"));
                
                $payload = Array(
                    'purpose' => 'Order payment - ' . $orderId,
                    'amount' => $totalPrice,
                    'phone' => Auth::user()->phone,
                    'buyer_name' => Auth::user()->uname,
                    'redirect_url' => url('/returnurl/'.$orderId),
                    'send_email' => true,
                    'webhook' => 'http://www.example.com/webhook/',
                    'send_sms' => false,
                    'email' => Auth::user()->email,
                    'allow_repeated_payments' => false
                );
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                $response = curl_exec($ch);
                curl_close($ch); 

                //echo $response;exit;
                $response = json_decode($response);
//                echo '<pre>';
//                print_r($response);exit;
                if ($response->success === false) {
                    $updateData = [
                                    'payment_status' => 0,
                                    'failure_reason' => json_encode($response->message)
                                ];
//                    echo '<pre>';
//                print_r($updateData);exit;
                    $result = $this->order->updateOrderStatus($orderId, $updateData);
                    Session::flash('error_message', 'Something went wrong. Please try again later');
                    return redirect('/checkout');
                }
                
                //$pay_ulr = $response->payment_request->longurl;
                return redirect($response->payment_request->longurl);
                //exit();
            }
            
        }
        
        return redirect('/');
    }
    
    public function returnurl(Request $request, $orderId)
    {

        echo '<pre>';
        print_r($request);exit;
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key: test_20379e4739c5ee98dbf1258454c",
                "X-Auth-Token: test_61bbe938ebc21412d41b830a5ae"));

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 

        if ($err) {
            $updateData = [
                                    'payment_status' => 0,
                                    'failure_reason' => json_encode($err)
                                ];
            $this->order->updateOrderStatus($orderId, $updateData);
            Session::flash('error_message', 'Payment Failed, Try Again!!');
            return redirect('/checkout');
        } else {
            $data = json_decode($response);
        }
        
        echo '<pre>';
        print_r($request);exit;
        
        if($data->success == true) {
            if($data->payment->status == 'Credit') {
                
                $updateData = [
                                    'payment_status' => 1,
                                    'failure_reason' => json_encode($data->payment->message),
                                    'transaction_id' => ''
                                ];
                $this->order->updateOrderStatus($orderId, $updateData);
                Session::flash('error_message', 'Your payment has been pay successfully, Enjoy!!');
                return redirect('/checkout');
            } else {
                $updateData = [
                                    'payment_status' => 0,
                                    'failure_reason' => json_encode($data->payment->message)
                                ];
                $this->order->updateOrderStatus($orderId, $updateData);
                Session::flash('error_message', 'Payment Failed, Try Again!!');
                return redirect('/checkout');
            }
        } else {
            $updateData = [
                                    'payment_status' => 0,
                                    'failure_reason' => json_encode($data->payment->message)
                                ];
            $this->order->updateOrderStatus($orderId, $updateData);
            Session::flash('error_message', 'Payment Failed, Try Again!!');
            return redirect('/checkout');
        }
    }
}
