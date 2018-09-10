<?php
/**
 * @File Api.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 15/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class ProductEnquiry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_enquiry';

    public function getProductEnqiries($id = '') {
        
            $queries = ProductEnquiry::join('art_items', 'art_items.id' , '=', 'product_enquiry.product_id')->join('users', 'users.id' , '=', 'art_items.artist_id');
                        
            if ($id != '') {
                $queries->where('art_items.artist_id' , $id);
            }
            
            $queries = $queries->select('product_enquiry.*', 'art_items.title', 'art_items.fname', 'art_items.ext', 'users.uname', 'users.username as directory')
                        ->orderBy('date_enquiry', 'desc')
                        ->orderBy('id', 'desc')
                        ->get();
        
        
        if (!empty($queries)) {
            return $queries;
        }

        return [];
    }
}