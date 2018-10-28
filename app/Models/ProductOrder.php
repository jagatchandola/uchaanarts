<?php
/**
 * @File Artists.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 15/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Helpers\Helper;

class ProductOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_order';
    protected $fillable = ['user_id', 'product_id', 'total_amount', 'order_date'];
    
    public function addOrder($order_amount, $order_id) {
        $insertData = [
                        'order_id' => $order_id,
                        'user_id' => Auth::user()->id,
                        'total_amount' => $order_amount,
                        'order_date' => date('Y-m-d h:i:s')
                    ];
        
        $insert = DB::table($this->table)->insert($insertData);

        //var_dump($insert);exit;
        if ($insert === true) {
            return true;
        }
        return false;
    }

    public function getBannerDetails($banner_id = '') {
        
        $banner = DB::table('banner');
                
        if($banner_id != '')
            $banner->where('id', $banner_id);

        $banner = $banner->get()
                         ->toArray();

        if (!empty($banner)) {
            return $banner;
        }

        return [];
    }

    public function updateOrderStatus($order_id, $update_data) {
        
        $updateStatus = DB::table('product_order')
            ->where('order_id', $order_id)
            ->update($update_data);
        
        $updateStatus = 1;
        
        if ($updateStatus >= 1) {
            $cartIdArray = [];
            
            $cartItems = DB::table('cart')
                    ->where('user_id', Auth::user()->id)
                    ->get()
                    ->toArray();
            
//            echo '<pre>';
//            print_r($cartItems);exit;
            
            foreach ($cartItems as $cart) {
                $cartIdArray[] = $cart->id;
                
                $artItem = DB::table('art_items')
                    ->where('id', $cart->product_id)
                    ->get()
                    ->toArray();
                
                $orderData = [
                    'order_id' => $order_id,
                    'art_item_id' => $cart->product_id,
                    'artist_id' => $cart->user_id,
                    'qty' => $cart->quantity,
                    'price' => $artItem[0]->price,
                    'gst' => $artItem[0]->gst,
                    'discount' => $artItem[0]->discount,
                    'discount_value' => $artItem[0]->discount_value,
                    'commission' => config('app.commission'),
                    'status' => 1,
                    'shipping_address' => Auth::user()->shipping_address,
                    'billing_address' => Auth::user()->billing_address,
                    'date_created' => date('Y-m-d h:i:s')
                ];

                $calculateData = [
                                    'price' => $artItem[0]->price,
                                    'gst' => $artItem[0]->gst,
                                    'discountType' => $artItem[0]->discount,
                                    'discountValue' => $artItem[0]->discount_value
                                ];

                $orderData['total_price'] = Helper::calculatePrice($calculateData);
                
                $order = new OrderItems();
                $orderItemId = $order->addOrderItem($orderData);
                
                if ($orderItemId !== false) {

                    DB::table('art_items')
                        ->where('id', $cart->product_id)
                        ->update(['isSold' => 1]);

                    DB::table('cart')->delete($cart->id);
                }                
            }

            return true;
        }
        return false;
    }

    public function updateBanner($data) {

        $where = ['title' => $data['banner-title'], 'description' => $data['description'], 'url' => $data['url'], 'status' => $data['status']];

        if (!empty($data['image'])) {
            $where['image'] = $data['image'];
        }
        $updateStatus = DB::table('banner')
            ->where('id', $data['banner-id'])
            ->update($where);
        
        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }

    public function addBanner($data) {
        
        $lastInsertId = DB::table('banner')->insertGetId(['title' => $data['banner-title'], 'description' => $data['description'], 'url' => $data['url'], 'status' => $data['status'], 'image' => $data['image']]);

        if ($lastInsertId > 0) {
            return true;
        }
        
        return false;
    }
    
    
}
