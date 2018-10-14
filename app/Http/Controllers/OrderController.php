<?php

namespace App\Http\Controllers;

// use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Session;
use Auth;
use Illuminate\Support\Facades\Mail;

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
        // $this->order = new Orders();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function addItem(Request $request)
    {
        // if(!Auth::check()){
        //     echo -1;
        //     exit;
        // }
        if($request->post()) {
        
            $input  = $request->all();
            print_r($input);die;
            $itemData = $catalogue->getArtItem($input['id']);
            if(!empty($itemData)){

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
            }
        }
        // if(!empty($input['email'])){
        //     $news = new NewsLetter();
        //     $result = $news->add($input);
        //     echo $result;
            
        // } else {
        //     echo -1;
        // }
    }
    
}
