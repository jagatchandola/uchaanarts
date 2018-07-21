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
    protected $table = 'users';

    public function getAllArtists() {
        $artists = Artists::where('shide', 1)
                    ->orderBy('uname', 'asc')
                    //->get()
                    ->paginate(5);

        if (!empty($artists)) {
            return $artists;
        }

        return [];
    }
    
    public function authenticate($input) {
        $matchThese = [
                        'email' => $input['email'], 
                        'password' => md5($input['password'])
                    ];

        $artist = Artists::where($matchThese)
                    ->get()
                    ->toArray();

        if (!empty($artist)) {
            return $artist;
        }

        return [];
    }

    public function getArtistDetails($artist_id) {
        $artist = Artists::where('id', $artist_id)
                    //->orderBy('uname', 'asc')
                    ->get()
                    ->toArray();

        if (!empty($artist)) {
            return $artist;
        }

        return [];
    }
}
