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

class Catalogue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'art_items';

    public function getCatalogues() {
        $catalogues = Catalogue::where('active', 1)
                    ->orderBy('id', 'desc')
                    ->take(10)
                    ->get();
// echo '<pre>';
// print_r($flights);exit;

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }
    
}
