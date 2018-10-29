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

class Media extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media_cover';

    public function getMedia($all = 0) {
       
        $media = DB::table('media_cover');
        if($all == 0){
            $media->where('status', '=', 1);
        }
                            
        $media = $media->orderBy('date_created', 'ASC')
        ->get();
        
        if (!empty($media)) {
            return $media;
        }

        return [];
    }

    public function getMediaDetails($media_id = '') {
        
        $media = DB::table('media_cover');
                
        if($media_id != '')
            $media->where('id', $media_id);

        $media = $media->get()
                         ->toArray();

        if (!empty($media)) {
            return $media;
        }

        return [];
    }

    public function updateMediaStatus($media_id, $status) {
        
        $updateStatus = DB::table('media_cover')
            ->where('id', $media_id)
            ->update(['status' => $status]);
        
        //var_dump($updateStatus);exit;
        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }

    public function updateMedia($data) {

        $where = ['title' => $data['title'], 'status' => $data['status']];

        if (!empty($data['image'])) {
            $where['image'] = $data['image'];
        }
        $updateStatus = DB::table('media_cover')
            ->where('id', $data['media-id'])
            ->update($where);
        
        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }

    public function addMedia($data) {
        
        $lastInsertId = DB::table('media_cover')->insertGetId(['title' => $data['title'], 'status' => $data['status'], 'image' => $data['image']]);

        if ($lastInsertId > 0) {
            return true;
        }
        
        return false;
    }
    
    
}
