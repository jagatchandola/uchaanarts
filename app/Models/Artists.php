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

class Artists extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    public function getAllArtists($records = '') {
        if ($records == 'all') {
            $artists = DB::table('users')
                                ->where('user_role', '=', 'artist')
                                ->select('id', 'uname', 'email as user_email','shide as status')
                                ->get();
        } else {
            $artists = Artists::where('shide', 1)
                        ->orderBy('uname', 'asc')
                        ->paginate(5);
        }
        
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

    public function getArtistDetails($artist_id = '', $is_creative = 0) {
        $artist = Artists::where('shide', 1);
                
        if($artist_id != '')
            $artist->where('id', $artist_id);

        if($is_creative == 1)
            $artist->where('is_creative_artists', 1);

            //->orderBy('uname', 'asc')
        $artist = $artist->get()
                         ->toArray();

        if (!empty($artist)) {
            return $artist;
        }

        return [];
    }
    
    public function getTotalArtistsCount() {
        $catalogues = Artists::where('shide', 1)
                    ->where('user_role', '=', 'artist')
                    ->count('id');

        if (!empty($catalogues)) {
            return $catalogues;
        }

        return [];
    }
    
    public function getCustomers() {
        $customers = DB::table('users')
                            ->where('user_role', '=', 'user')
                            ->select('id', 'uname', 'email as user_email', 'phone','shide as status')
                            ->get();
        
        if (!empty($customers)) {
            return $customers;
        }

        return [];
    }
    
    public function updateArtistStatus($artist_id, $status) {
        $updateStatus = DB::table('users')
            ->where('id', $artist_id)
            ->update(['shide' => $status]);
        
        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }
}
