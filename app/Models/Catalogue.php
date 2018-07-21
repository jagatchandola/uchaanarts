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

class Catalogue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'art_items';

    public function getCatalogues() {
        $catalogues = Catalogue::where('art_items.active', 1)
                    ->join('artists', 'art_items.artist_id' , '=', 'artists.id')
                    ->select('art_items.*', 'artists.uname')
                    ->orderBy('id', 'desc')
                    //->take(10)
                    ->paginate(10);
// echo '<pre>';
// print_r($flights);exit;

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
            ->join('artists', 'art_items.artist_id', '=', 'artists.id')
            ->where('art_items.id', $art_id)
            ->where('artists.id', '=', $artist_id)
            ->select('art_items.*', 'artists.uname')
            ->get();
// echo '<pre>';
// print_r($catArts);exit;
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
                    ->join('artists', 'art_items.artist_id', '=', 'artists.id')
                    ->where('art_items.id', '<>', $art_id)
                    ->orderBy('art_items.id', 'desc')
                    ->take(4)
                    ->get()
                    ->toArray();
// echo '<pre>';
// print_r($catalogues);exit;

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }
}
