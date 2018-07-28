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

    public function getCatalogues($records = '', $artist_id = '') {
        if ($records == 'all') {
            $catalogues = DB::table('art_items')
                        ->join('users', 'art_items.artist_id' , '=', 'users.id')
                        ->select('art_items.id', 'title', 'art_items.about', 'price', 'users.uname as user_name', 'art_items.active as status')
                        ->orderBy('id', 'desc')
                        ->get();
        } else {
            $catalogues = Catalogue::where('art_items.active', 1)
                        ->join('users', 'art_items.artist_id' , '=', 'users.id');
            
            if (!empty($artist_id)) {
                $catalogues = $catalogues->where('art_items.artist_id', '=', $artist_id);
            }
            
            
            $catalogues = $catalogues->select('art_items.*', 'users.uname')
                        ->orderBy('id', 'desc')
                        ->paginate(10);
        }
        
        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }
    
    public function getArtistWork($artist_id) {
        $where = [
                    'artist_id' => $artist_id,
                    'active'    => 1
                ];
        $catalogues = Catalogue::where($where)
                    ->orderBy('id', 'desc')
                    ->take(4)
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
            ->join('users', 'art_items.artist_id', '=', 'users.id')
            ->where('art_items.id', $art_id)
            ->where('users.id', '=', $artist_id)
            ->select('art_items.*', 'users.uname', 'users.id as artist_id')
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
        $catalogues = Catalogue::where($where)
                    ->join('users', 'art_items.artist_id', '=', 'users.id')
                    ->where('art_items.id', '<>', $art_id)
                    ->orderBy('art_items.id', 'desc')
                    ->take(4)
                    ->get()
                    ->toArray();

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }
    
    public function getTotalArtsCount($id = '') {
        $catalogues = Catalogue::where('active', 1);
        
        if (!empty($id)) {
            $catalogues->where('artist_id', $id);
        }
        
        $catalogues = $catalogues->count('id');

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return 0;
    }
    
    public function updateArt($data) {
        
        dd(Auth::user());
        $updateStatus = DB::table('art_items')
            ->where('id', $data['art-id'])
            ->update([
                        'title' => $data['title'], 
                        'about' => $data['about'], 
                        'price' => $data['price'], 
                        'gst' => $data['gst'], 
                        'discount' => $data['discount'], 
                        'discount_value' => $data['discount_value'], 
                        'active' => $data['status']
                    ]);

        if ($updateStatus >= 1) {
            return true;
        }
        
        return false;
    }

    public function getCreativeArts(){

        $catalogues = DB::table('art_items')->where('art_items.is_creative_art', 1)
                    ->join('users', 'art_items.artist_id' , '=', 'users.id')
                    ->select('art_items.id', 'title', 'price', 'gst', 'discount', 'discount_value', 'users.uname as user_name', 'art_items.fname', 'art_items.ext')
                    ->orderBy('id', 'desc')
                    ->get();

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];            
    }
    
    public function getArtistArts($artist_id) {
        $where = [
                    'artist_id' => $artist_id,
                    'active'    => 1
                ];
        
        $catalogues = Catalogue::where($where)
                    ->orderBy('id', 'desc')
                    ->paginate(2);

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }
}
