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

class Catalogue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'art_items';

    public function getCatalogues($records = '', $artist_id = '', $admin = false) {
        if ($records == 'all') {
            $catalogues = DB::table('art_items');
            if (!empty($artist_id)) {
                $catalogues = $catalogues->where('art_items.artist_id', '=', $artist_id);
            }
                        $catalogues = $catalogues->join('users', 'art_items.artist_id' , '=', 'users.id')
                        ->whereIn('art_items.active', [0, 1])
                        ->select('art_items.*', 'users.username', 'users.uname', 'art_items.active as status')
                        ->orderBy('id', 'desc')
                        ->paginate(20);
        } else {
            $catalogues = Catalogue::where('art_items.active', 1)
                        ->join('users', 'art_items.artist_id' , '=', 'users.id');
                        
            if ($admin === false) {
                $catalogues = $catalogues->where('art_items.isSold' , '=', 0);
            }
            
            if (!empty($artist_id)) {
                $catalogues = $catalogues->where('art_items.artist_id', '=', $artist_id);
            }
            
            
            $catalogues = $catalogues->select('art_items.*', 'users.uname', 'users.username')
                        ->orderBy('id', 'desc')
                        ->paginate(21);
        }
        
        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }
    
    public function getArtistWork($artist_id) {
        $where = [
                    'art_items.artist_id' => $artist_id,
                    'art_items.active'    => 1,
                    'art_items.isSold'    => 0
                ];
        $catalogues = Catalogue::where($where)
                    ->select('art_items.*', 'users.uname', 'users.username')
                    ->join('users', 'art_items.artist_id' , '=', 'users.id')
                    ->orderBy('art_items.id', 'desc')
                    // ->take(4)
                    ->get()
                    ->toArray();

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }

    // get art details
    public function getArtDetails($artist_id, $art_id) {
        $catArts = DB::table('art_items')
            ->join('category', 'art_items.cat', '=', 'category.id')
            ->join('users', 'art_items.artist_id', '=', 'users.id')
            ->where('art_items.id', $art_id)
            ->where('art_items.artist_id', '=', $artist_id)
            ->select('art_items.*', 'users.uname', 'users.username', 'users.id as artist_id', 'category.cat_name')
            ->get();

        if (!empty($catArts)) {
            return $catArts;
        }

        return [];
    }

    public function getOtherArts($artist_id, $art_id) {
        $where = [
                    'art_items.artist_id' => $artist_id,
                    'art_items.active'    => 1
                ];
        
        $catalogues = DB::table('art_items')
                    ->join('users', 'art_items.artist_id', '=', 'users.id')
                    ->where('art_items.artist_id', '=', $artist_id)
                    ->where('art_items.active', '=', 1)
                    ->where('art_items.isSold', '=', 0)
                    ->where('art_items.id', '<>', $art_id)
                    ->orderBy('art_items.id', 'desc')
                    ->select('art_items.id', 'title', 'art_items.about', 'art_items.price', 'users.uname as user_name', 'users.username', 'users.id as artist_id', 'art_items.fname', 'art_items.ext', 'art_items.price', 'art_items.gst', 'art_items.discount', 'art_items.discount_value', 'art_items.painting', 'art_items.subject', 'art_items.surface', 'art_items.size', 'art_items.quantity')
                    ->take(20)
                    ->get();

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }
    
    public function getTotalArtsCount($id = '') {
        $catalogues = DB::table('art_items');

        if (!empty($id)) {
            $catalogues->where('artist_id', $id);
        }

        $catalogues = $catalogues->count('id');

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return 0;
    }
    
    public function updateArt($data, $id = '') {
        
        if (!empty($id)) {
            $where = [
                        'title' => $data['title'],
                        'about' => $data['about'],
                        'price' => $data['price'],
                        'subject' => $data['subject'],
                        'painting' => $data['painting'],
                        'surface' => $data['surface'],
                        'quantity' => $data['quantity'],
                        'size' => $data['size'],
                        'gst' => $data['gst'], 
                        'discount' => $data['discount'], 
                        'discount_value' => $data['discount_value']
                    ];
            if (Auth::user()->user_role == 'artist'){
                $where['active'] = 2;
            } else {
                if(isset($data['status'])){
                    $where['active'] = $data['status'];
                } else {
                    $where['active'] = 1;
                }
                $where['is_creative_art'] = $data['creative_art_status'] ?? 0;
            }
            if (!empty($data['image'])) {
                list($name, $extension) = explode('.', $data['image']);
                $where['fname'] = $name;
                $where['ext'] = $extension;
            }
        } else {
            $where = [
                        'title' => $data['title'], 
                        'about' => $data['about'], 
                        'price' => $data['price'], 
                        'subject' => $data['subject'],
                        'painting' => $data['painting'],
                        'surface' => $data['surface'],
                        'quantity' => $data['quantity'],
                        'size' => $data['size'],
                        'gst' => $data['gst'], 
                        'discount' => $data['discount'], 
                        'discount_value' => $data['discount_value'], 
                        // 'active' => $data['status'],
                        'is_creative_art' => $data['creative_art_status'] ?? 0
                    ];
            if(isset($data['status'])){
                $where['active'] = $data['status'];
            }
        }
        // print_r($where);die;
        $updateStatus = DB::table('art_items')
            ->where('id', $data['art-id'])
            ->update($where);

        if ($updateStatus >= 0) {
            return true;
        }
        
        return false;
    }

    public function getCreativeArts(){

        $catalogues = DB::table('art_items')->where('art_items.is_creative_art', 1)->where('art_items.active', 1)
                    ->join('users', 'art_items.artist_id' , '=', 'users.id')
                    ->select('art_items.*', 'title', 'price', 'gst', 'discount', 'discount_value', 'users.username as directory', 'users.id as user_id', 'users.uname as user_name')
                    ->orderBy('id', 'desc')
                    ->get();

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];            
    }
    
    public function getArtistArts($artist_id, $all = false, $artistPending = false) {
        if ($artistPending === true) {
            $where = [
                        'art_items.artist_id' => $artist_id
                    ];
        } else {
            $where = [
                        'art_items.artist_id' => $artist_id,
                        'art_items.active'    => 1
                    ];
        }
        
        if ($all === true) {
            $catalogues = Catalogue::where($where)
                    ->select('art_items.id', 'art_items.price', 'art_items.title', 'art_items.fname', 'art_items.ext', 'users.username', 'users.uname')
                    ->join('users', 'art_items.artist_id' , '=', 'users.id')
                    ->orderBy('art_items.id', 'desc')
                    ->get();
        } else {
            $catalogues = Catalogue::where($where)
                    ->join('users', 'art_items.artist_id' , '=', 'users.id')
                    ->orderBy('users.id', 'desc')
                    ->paginate(2);
        }
        
        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }
    
    public function getPendingPhotos() {
        
        $catalogue = Catalogue::where('art_items.active', 2)
                    ->join('users', 'art_items.artist_id' , '=', 'users.id')
                    ->where('users.admin_approved', '=', 1)
                    ->select('art_items.id', 'title', 'price', 'gst', 'discount', 'subject', 'painting', 'size', 'surface', 'quantity', 'discount_value', 'users.uname as user_name', 'art_items.fname', 'art_items.ext', 'users.uname', 'users.username')
                    ->orderBy('art_items.updated_at', 'desc')
                    ->get();

        if (!empty($catalogue)) {
            return $catalogue;
        }

        return [];
    }
    
    public function getArtById($art_id) {
        
        $catalogue = Catalogue::where('art_items.id', $art_id)
                    ->join('users', 'art_items.artist_id' , '=', 'users.id')
                    ->select('art_items.id', 'title', 'art_items.about', 'price', 'gst', 'discount', 'subject', 'painting', 'size', 'surface', 'quantity', 'discount_value', 'users.username', 'art_items.fname', 'art_items.ext', 'users.uname')
                    ->orderBy('art_items.updated_at', 'desc')
                    ->get();

        if (!empty($catalogue)) {
            return $catalogue;
        }

        return [];
    }
    
    public function addArt($data, $artist_id) {
        $where = [
                    'title' => $data['title'],
                    'artist_id' => $artist_id,
                    'about' => $data['about'],
                    'price' => $data['price'],
                    'subject' => $data['subject'],
                    'painting' => $data['painting'],
                    'surface' => $data['surface'],
                    'quantity' => $data['quantity'],
                    'size' => $data['size'],
                    'active' => 2,
                    'cat' => $data['category'],
                    'artwork_code' => $this->newItemCode()
                ];
        
        list($name, $extension) = explode('.', $data['image']);
        $where['fname'] = $name;
        $where['ext'] = $extension;
        
        $lastInsertId = DB::table('art_items')->insertGetId($where);

        if ($lastInsertId > 0) {
            return true;
        }
        
        return false;
    }
    

    public function getWeeklyArtistArts() {
        
        $catalogue = Catalogue::where('users.is_weekly_artist',1)
                    ->where('users.admin_approved',1)
                    ->join('users', 'art_items.artist_id' , '=', 'users.id')
                    ->select('art_items.id', 'art_items.title', 'art_items.fname', 'art_items.ext', 'art_items.price', 'art_items.cat', 'users.username as directory')
                    ->orderBy('art_items.updated_at', 'desc')
                    ->get();

        if (!empty($catalogue)) {
            return $catalogue;
            echo $catalogue;
        }

        return [];
    }


    public function getProductDetails($product_id) {
        
        $productDetail = DB::table('art_items as ai')
            ->join('users as u', 'ai.artist_id' , '=', 'u.id')
            ->where('ai.id', $product_id)
            ->whereAnd('isSold', 0)
            ->whereAnd('active', 1)
            ->select('ai.id', 'ai.title', 'ai.fname', 'ai.ext', 'ai.price', 'ai.discount', 'ai.discount_value', 'ai.gst', 'u.username')
            ->get()
            ->toArray();

        if (!empty($productDetail) && count($productDetail)) {
            return $productDetail;
        }

        return [];
    }

    
    public function enquiry($data, $product_id) {
        $where = [
                    'name'          => $data['name'],
                    'email'         => $data['email'],
                    'mobile_no'     => $data['mobile'],
                    'comments'      => $data['comments'],
                    'product_id'    => $product_id,
                ];
        $lastInsertId = DB::table('product_enquiry')->insertGetId($where);

        if ($lastInsertId > 0) {
            $productDetail = DB::table('art_items as ai')
                ->join('users as u', 'ai.artist_id' , '=', 'u.id')
                ->where('ai.id', $product_id)
                ->whereAnd('isSold', 0)
                ->whereAnd('active', 1)
                ->select('ai.artist_id', 'u.uname', 'u.email')
                ->get()
                ->toArray();

            if (!empty($productDetail) && count($productDetail)) {
                return $productDetail;
            }
            return true;
        }
        
        return false;
    }

    public function deleteProduct($id) {

        return Catalogue::where('id', $id)->delete();
    }

    public function getArtItem($id) {
        
        $catalogue = Catalogue::where('art_items.id', '=', $id)
                    ->where('art_items.active', '=', 1)
                    ->join('users', 'art_items.artist_id' , '=', 'users.id')
                    ->select('art_items.id', 'title', 'art_items.about', 'price', 'gst', 'discount', 'discount_value', 'users.username', 'art_items.fname', 'art_items.ext', 'users.uname')
                    ->first();

        if (!empty($catalogue)) {
            return $catalogue;
        }

        return [];
    }

    public function updateOnce(){

        $catalogue = Catalogue::orderBy('id', 'asc')
                    ->get();

        if (!empty($catalogue)) {
            $code = 2101;
            foreach ($catalogue as $value) {
                    
                if($value->artwork_code == 0){
                    $updateStatus = DB::table('art_items')
                        ->where('id', $value->id)
                        ->update(['artwork_code' => $code]);
                }
                $code++;
            }
        }
    }

    public function newItemCode(){

        $catalogue = Catalogue::orderBy('artwork_code', 'desc')
                    ->first();
        $code = 2101;
        if (!empty($catalogue)) {
            $code = $catalogue->artwork_code;
        }
        $code ++;
        return $code;
    }



}
