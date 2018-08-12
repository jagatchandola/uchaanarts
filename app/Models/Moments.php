<?php
/**
 * @File Moments.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 22/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;

class Moments extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'moments';

    public function getAllMoments($eventId='') {
        $moments = Moments::where('moments.is_active', 1);
        if($eventId != ''){
            $moments->where('events.id', $eventId);
        }
        $moments = $moments->join('events', 'events.id' , '=', 'moments.event_id')
                    ->orderBy('moments.id', 'desc')
                    ->get();

        if (!empty($moments)) {
            return $moments;
        }

        return [];
    }

    public function getUchaanMoments($isBackend = false) {
        if($isBackend == false){

            $moments = DB::table('uchaan_events')
                    ->where('is_active', 1)
                    ->get();
        } else {
            $moments = DB::table('uchaan_events')
                    ->get();
        }

        if (!empty($moments)) {
            return $moments;
        }

        return [];
    }

    public function addMemorableMoments($data){

        $insert = DB::table('uchaan_events')->insert([
                                            'title' => $data['title'] ?? '',
                                            'image' => $data['image'],
                                            'is_active' => 1
                                        ]);

        if ($insert === true) {
            return true;
        }
        return false;
    }

    public function deleteMoment($id) {
        $response = DB::table('uchaan_events')->where('id', $id)->delete();
        if ($response >= 1) {
            return true;
        }
        return false;
    }

}
