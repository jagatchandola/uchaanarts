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

class ProductOrder extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_order';
    protected $fillable = ['user_id', 'product_id', 'total_amount', 'order_date'];
    
    public function addOrder($user_id, $product_id, $order_amount) {
        $insertData = [
                        'total_amount' => $order_amount,
                        'order_date' => date('Y-m-d h:i:s')
                    ];
        
        $matchThese = ['user_id' => $user_id, 'product_id' => $product_id];
        //$insert = DB::table($this->table)->insert($insertData);
        $insert = ProductOrder::firstOrNew($matchThese, $insertData);
//        $insert = ProductOrder::forceCreate($insertData);
        var_dump($insert);exit;
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

    public function updateBannerStatus($banner_id, $status) {
        
        $updateStatus = DB::table('banner')
            ->where('id', $banner_id)
            ->update(['status' => $status]);
        
        //var_dump($updateStatus);exit;
        if ($updateStatus >= 1) {
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
