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

class OrderItems extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_items';

    public function checkCartItem($id) {
            
        $item = OrderItems::where('art_item_id', $id)
                            ->where('status', 1)
                            ->order('id', 'desc')
                            ->first();
        if (!empty($item)) {
            return $item;
        }
        return false;                    
    }
    
    
    public function updateOrderItem($id, $dataArray) {
        $updateStatus = DB::table('order_items')
            ->where('id', $id)
            ->update($dataArray);
        
        if (!empty($updateStatus)) {
            return $updateStatus->id;
        }
        return false;
    }

    public function addOrderItem($dataArray) {
        $lastInsertId = DB::table('order_items')
            ->insertGetId($dataArray);
        
        if ($lastInsertId > 0) {
            return $lastInsertId;
        }
        return false;
    }
    
}
