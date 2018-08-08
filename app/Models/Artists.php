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
                                ->select('id', 'uname', 'username', 'email as user_email','shide as status', 'is_creative_artists', 'is_weekly_artist')
                                ->get();
        } else {
            $artists = Artists::where('shide', 1)
                        ->orderBy('uname', 'asc')
                        ->paginate(12);
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
    
    public function updateArtistStatus($artist_id, $status, $type) {
        
        $update = [];
        switch ($type){
            case 'status':
                $update = ['shide' => $status];
                break;
            case 'creative_artist':
                $update = ['is_creative_artists' => $status];
                break;
            case 'weekly_artist':
                if ($status == 1) {
                    DB::table('users')
                            ->update(['is_weekly_artist' => 0]);
                }
                
                $update = ['is_weekly_artist' => $status];
                break;
        }
        
        $updateStatus = DB::table('users')
            ->where('id', $artist_id)
            ->update($update);
        
        //var_dump($updateStatus);exit;
        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }
    
    public function updateArtist($data) {
        $updateStatus = DB::table('users')
            ->where('id', $data['artist-id'])
            ->update(['uname' => $data['artist-name'], 'email' => $data['email'], 'user_role' => $data['user-role'], 'shide' => $data['status']]);
        
        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }

    public function getArtistOfWeek() {
        $artist = Artists::where('shide', 1)
                ->where('is_weekly_artist', 1)
                ->where('user_role', 'artist')
                ->select('id', 'username', 'uname', 'email', 'about', 'profimg')
                ->orderBy('id', 'desc')
                ->take(1);
        $artist = $artist->first();

        if (!empty($artist)) {
            return $artist;
        }

        return [];
    }
}
