<?php
/**
 * @File Category.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 15/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    public function getCategories($records = '') {
        if ($records == 'all') {
            $categories = DB::table('category')
                        ->orderBy('cat_name', 'asc')
                        ->select('id', 'cat_url', 'cat_name', 'gst', 'shide as status')
                        ->get();
        } else {
            $categories = Category::where('shide', 1)
                        ->orderBy('cat_name', 'asc')
                        ->get();
        }
        
        if (!empty($categories)) {
            return $categories;
        }

        return [];
    }
    
    // get all arts of a category
    public function getCategoryArts($cat_name) {
        $catArts = DB::table('category')
            ->join('art_items', 'category.id', '=', 'art_items.cat')
            ->join('users', 'art_items.artist_id', '=', 'users.id')
            ->where('category.cat_url', '=', $cat_name)
            ->where('art_items.active', 1)
            ->select('art_items.*', 'users.uname')
            ->paginate(10);

        if (!empty($catArts)) {
            return $catArts;
        }

        return [];
    }


    public function getArtistCategoryArts($cat_id, $art_id) {
        $catArts = DB::table('art_items')
            ->join('users', 'art_items.artist_id', '=', 'users.id')
            ->where('art_items.cat', '=', $cat_id)
            ->where('art_items.id', '<>', $art_id)
            ->where('art_items.active', 1)
            ->orderBy('art_items.id', 'desc')
            ->take(10)
            ->select('art_items.*', 'users.uname')
            ->get()
            ->toArray();

        if (!empty($catArts)) {
            return $catArts;
        }

        return [];
    }
}
