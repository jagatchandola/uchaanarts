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

class Banner extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banner';

    public function getBanners() {
       
        $banners = DB::table('banner')
                            ->where('status', '=', 1)
                            ->orderBy('sort_order', 'ASC')
                            ->get();
        
        if (!empty($banners)) {
            return $banners;
        }

        return [];
    }
    
    
}
