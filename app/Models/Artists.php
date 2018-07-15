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

class Artists extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';

    public function getAllArtists() {
        $artists = Artists::where('shide', 1)
                    ->orderBy('uname', 'asc')
                    ->get();

        if (!empty($artists)) {
            return $artists;
        }

        return [];
    }
    
}
