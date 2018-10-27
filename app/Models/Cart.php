<?php
/**
 * @File Cart.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 15/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Cart extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart';

    protected $fillable = ['user_id', 'product_id'];
    
    public function addToCart($cart_items) {
        foreach($cart_items as $item) {
            $cart = Cart::firstOrNew([
                                        'user_id' => Auth::user()->id,
                                        'product_id' => $item
                            ]);

            $cart->date_added = date('Y-m-d h:i:s');            
            $cart->save();
        }

        return $this->getCartItemCount();
    }
    
    public function getCartItemCount() {
        $cartItemCount = DB::table('cart')
                        ->where('user_id', Auth::user()->id)
                        ->get()
                        ->toArray();
        
        $cartArray = [];
        if (!empty($cartItemCount)) {
            foreach($cartItemCount as $item) {
                $cartArray[$item->product_id] = 1;
            }
        }

        return $cartArray;
    }
    
    public function getCartItems() {
        if (!Auth::check()) {
            $productDetail = DB::table('art_items as ai')
                ->join('users as u', 'ai.artist_id' , '=', 'u.id')
                ->whereIn('ai.id', array_keys($_SESSION['cart']))
                ->whereAnd('ai.isSold', 0)
                ->whereAnd('active', 1)
                ->select('ai.id as product_id', 'ai.title', 'ai.fname', 'ai.ext', 'ai.price', 'ai.discount', 'ai.discount_value', 'ai.gst', 'u.username')
                ->get()
                ->toArray();
        } else {
            $productDetail = DB::table('cart as c')
                ->join('art_items as ai', 'c.product_id' , '=', 'ai.id')
                ->join('users as u', 'ai.artist_id' , '=', 'u.id')
                ->where('c.user_id', Auth::user()->id)
                ->whereAnd('ai.isSold', 0)
                ->whereAnd('active', 1)
                ->select('c.id', 'c.quantity', 'ai.id as product_id', 'ai.title', 'ai.fname', 'ai.ext', 'ai.price', 'ai.discount', 'ai.discount_value', 'ai.gst', 'u.username')
                ->get()
                ->toArray();
        }

        if (!empty($productDetail) && count($productDetail)) {
            return $productDetail;
        }

        return [];
    }
}
