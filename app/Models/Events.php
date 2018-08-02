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
    private $data;
    
    public function getAllEvents($records = '') {
        if ($records == 'all') {

            $events = DB::table('events')
                                ->select('id', 'etitle', 'start_date','end_date','venue', 'fees', 'shide as status')

                                ->orderBy('start_date', 'desc')
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
                                            'eurl' => str_replace(' ', '-', strtolower($data['event_name'])).'-'.date('d-M-Y', strtotime($data['start_date'])),
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
    
    public function getArtistEventArts($artist_id, $event_id) {
        $where = [
                    'evtid'     => $event_id,
                    'artist_id' => $artist_id
                ];
        
        $events = DB::table('evt_artists')
                    ->where($where)
                    ->select('id', 'artist_item_id')
                    ->get()
                    ->toArray();

        if (!empty($events)) {
            return $events;
        }

        return [];
    }
    
    public function participateEventArts($eventArtistsArts, $event_art_id) {
        DB::table('evt_artists')->whereIn('id', explode(',', $event_art_id))->delete();
        
        return DB::table('evt_artists')->insert(
            $eventArtistsArts
        );        
    }
    
    public function getEventParticipants() {
        
        $catalogue = Events::where('events.shide', 1)
                    ->join('evt_artists', 'events.id' , '=', 'evt_artists.evtid')
                    ->join('users', 'evt_artists.artist_id' , '=', 'users.id')
                    //->join('art_items', 'evt_artists.artist_item_id' , '=', 'art_items.id')
                    ->select('events.etitle', 'events.id as event_id', 'users.id as artist_id', 'uname')
                    ->orderBy('events.id', 'desc')
                    ->groupBy('evt_artists.evtid', 'evt_artists.artist_id')
                    ->get();

        if (!empty($catalogue)) {
            return $catalogue;
        }

        return [];
    }
    
    public function getParticipantDetails($event_id, $artist_id) {
        return DB::table('evt_artists')
                ->join('art_items', 'evt_artists.artist_item_id' , '=', 'art_items.id')
                ->where('evt_artists.evtid', '=', $event_id)
                ->where('evt_artists.artist_id', '=', $artist_id)
                ->select('evt_artists.id', 'title', 'fname', 'ext', 'price', 'gst', 'discount', 'discount_value')
                ->get();
    }
    
    public function approveEventArt($data) {
        $this->data = $data;
        //dd($this->data);
        $result = DB::transaction(function () {

            $approveStatus = DB::table('evt_artists')
                            ->whereIn('id', $this->data['event_art_ids'])
                            ->update(['admin_approved' => 1]);
            
            $featuredStatus = DB::table('evt_artists')
                                ->where('id', $this->data['featured_image'])
                                ->update(['is_featured' => 1]);
            
            $eventDetails = $this->getEventDetails($this->data['event_id']);
            
            $lastInsertId = DB::table('event_payment')->insertGetId([
                                            'event_id' => $this->data['event_id'],
                                            'artist_id' => $this->data['artist_id'],
                                            'payment_amount' => $eventDetails['fees'],
                                            'payment_link'  => hash('sha256', $this->data['event_id'].$this->data['artist_id'])
                                        ]);
            
            if ($lastInsertId > 0) {
                return DB::table('event_payment')
                        ->where('id', $lastInsertId)
                        ->get();                
            }            
        }, 5);
        
        if ($result != null) {
            return $result;
        }

        return false;
    }
 
    public function getEventFeaturedArts($event_id) {
        $result = DB::table('events as e')
                ->join('evt_artists as es', 'e.id', '=', 'es.evtid')
                ->join('art_items as ai', 'es.artist_item_id', '=', 'ai.id')
                ->join('users as u', 'es.artist_id', '=', 'u.id')
                ->where('e.id', '=', $event_id)
                ->where('es.shide', '=', 1)
                ->where('es.is_featured', '=', 1)
                ->select('ai.fname', 'ai.ext', 'u.profimg', 'u.uname')
                ->get();
        
        if (!empty($result)) {
            return $result;
        }
        
        return [];
    }
}
