<?php
/**
 * @File Events.php
 * @Project Uchaanarts
 * @Author: Jagat Prakash
 * @Date: 15/07/18
 * @Time: 11:00 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    public function getAllEvents($records = '') {
        if ($records == 'all') {
            $artists = DB::table('events')
                                ->select('id', 'title', 'start_date','end_date','venue', 'banner', 'shide as status')
                                ->orderBy('id', 'desc')
                                ->get();
        } else {
            $events = Events::where('shide', 1)
                        ->orderBy('start_date', 'desc')
                        ->get();
        }
        if (!empty($events)) {
            return $events;
        }

        return [];
    }
    
    public function getEventDetails($event_id) {
        $events = Events::where('id', $event_id)
                    ->get();

        if (!empty($events)) {
            return $events[0];
        }

        return [];
    }
    
    public function getTotalEventsCount() {
        $totalEvents = Events::where('shide', 1)
                    ->count('id');

        if (!empty($totalEvents)) {
            return $totalEvents;
        }

        return [];
    }
}
