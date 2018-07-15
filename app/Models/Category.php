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

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category';

    public function getCatalogues() {
        $categories = Category::where('shide', 1)
                    ->orderBy('id', 'desc')
                    ->get();

        if (!empty($categories)) {
            return $categories;
        }

        return [];
    }
    
}
