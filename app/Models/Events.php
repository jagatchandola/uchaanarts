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
use DB;

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
            $events = DB::table('events')
                                ->select('id', 'etitle', 'start_date','end_date', 'fees', 'shide as status')
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
    
    public function updateEventStatus($event_id, $status) {
        $updateStatus = DB::table('events')
            ->where('id', $event_id)
            ->update(['shide' => $status]);

        if ($updateStatus >= 1) {
            return true;
        }
        
        return false;
    }
    
    public function updateEvent($data) {
        
        $updateData = [
                        'etitle' => $data['event-name'],
                        'venue' => $data['venue'],
                        'about' => $data['about'],
                        'start_date' => $data['start_date'],
                        'end_date' => $data['end_date'],
                        'fees' => $data['event_fees'],
                        'shide' => $data['status']
                    ];
        
        if (isset($data['image']) && !empty($data['image'])) {
            $updateData['banner'] = $data['image'];
        }

        $updateStatus = DB::table('events')
            ->where('id', $data['event-id'])
            ->update($updateData);

        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }

    public function addEvent($data) {
        $insert = DB::table('events')->insert([
                                            'etitle' => $data['event_name'],
                                            'eurl' => str_replace(' ', '-', strtolower($data['event_name'])),
                                            'venue' => $data['venue'],
                                            'about' => $data['about'],
                                            'start_date' => $data['start_date'],
                                            'end_date' => $data['end_date'],
                                            'fees' => $data['event_fees'],
                                            'banner' => $data['image'],
                                            'shide' => $data['status']
                                        ]);

        if ($insert === true) {
            return true;
        }
        return false;
    }
}
