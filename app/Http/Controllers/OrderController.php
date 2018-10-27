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
        // $this->order = new Orders();
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
            //dd(Session::get('cart'));
            //dd($_SESSION['cart']);
            //die;
            //$itemData = $catalogue->getArtItem($input['id']);
            /*if(!empty($itemData)){

                $itemId = 0;
                $dataArray = [
                    'type'=> ($input['type'].toLowerCase() == 'cart' ? 0 : 1),
                    'art_item_id' => $itemData->id,
                    'artist_id' => $itemData->artist_id,
                    'qty' => 1,
                    'gst' => 0,
                    'commission' => config('app.commission'),
                    'discount' => $itemData->discount_value,
                    'total_price' => Helper::calculatePrice(['price' => $itemData->price, 'gst' => $itemData->gst, 'discountType' => $itemData->discount, 'discountValue' => $itemData->discount_value]),
                    'status' => 1
                    ];
                $item = $orderItem->checkCartItem($input['id']);
                if($item){
                    $itemId = $orderItem->updateOrderItem($item->id, $dataArray);
                    
                } else {
                    $itemId = $orderItem->addOrderItem($dataArray);
                }

                if($itemId > 0){
                    
                }
            }*/
        }
        // if(!empty($input['email'])){
        //     $news = new NewsLetter();
        //     $result = $news->add($input);
        //     echo $result;
            
        // } else {
        //     echo -1;
        // }
    }
    
    public function checkout() {
//        dd($_SESSION['cart']);
        $cartItems = $this->cart->getCartItems();
//echo '<pre>';
//print_r($cartItems);exit;
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
            
//            if(Auth::user()) {
//                $this->order->addOrder(Auth::user()->id, $product_id, $totalPrice);
//            }
        }
//dd($cartItems);
        return view('checkout-pay')->with([
                                        'cartItems' => $cartItems
                                    ]);
    }
}
