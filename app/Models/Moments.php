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

    public function getUchaanMoments() {
        $moments = DB::table('uchaan_events')
                    ->where('is_active', 1)
                    ->get();

        if (!empty($moments)) {
            return $moments;
        }

        return [];
    }

}
