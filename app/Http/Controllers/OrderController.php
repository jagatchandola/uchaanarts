<?php

namespace App\Http\Controllers;

// use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Catalogue;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Session;
use Auth;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->catalogue = new Catalogue();
        $this->orderItem = new OrderItems();
        $this->cart      = new Cart();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function addItem(Request $request)
    {
        if($request->post()) {
        
            $input  = $request->all();

            if (Auth::check()) {
                // check if the item is in the array, if it is, do not add
                if(array_key_exists($input['id'], $_SESSION['cart'])){
                    echo '2';
                } else { // else, add the item to the array
                    $cartItemCount = $this->cart->addToCart([$input['id']]);
                    $_SESSION['cart'] = $cartItemCount;
                    echo 1;
                }
            } else {
                if(!isset($_SESSION['cart'])){
                    $_SESSION['cart'] = [];
                }

                // check if the item is in the array, if it is, do not add
                if(array_key_exists($input['id'], $_SESSION['cart'])){
                    echo '2';
                } else { // else, add the item to the array
                    $_SESSION['cart'][$input['id']] = 1;
                    echo '1';
                }
            }
        }
    }
    
    public function checkout() {
        $cartItems = [];
        
        if (isset($_SESSION['cart'])) { 
            $cartItems = $this->cart->getCartItems();

            if (!empty($cartItems)) {
                foreach ($cartItems as $productDetail) {
                    $calculateData = [
                                                'price' => $productDetail->price,
                                                'gst' => $productDetail->gst,
                                                'discountType' => $productDetail->discount,
                                                'discountValue' => $productDetail->discount_value
                                            ];

                    $productDetail->totalPrice = Helper::calculatePrice($calculateData);
                    $productDetail->quantity = $productDetail->quantity ?? 1;
                }
            }
        }

        return view('checkout-pay')->with([
                                        'cartItems' => $cartItems
                                    ]);
    }
    
    public function checkoutRegister() {
        return view('checkout');
    }
}
