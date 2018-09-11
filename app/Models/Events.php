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
                                ->select('id', 'etitle', 'eurl', 'start_date','end_date','venue', 'fees', 'shide as status')

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
        $totalEvents = Events::count('id');

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
                    ->leftJoin('event_payment', function($join){
                            $join->on('events.id', '=', 'event_payment.event_id')
                                ->on('users.id', '=', 'event_payment.artist_id');
                    })
                    ->select('events.etitle', 'events.id as event_id', 'users.id as artist_id', 'uname', 'event_payment.id as event_payment_id', 'event_payment.payment_received')
                    ->orderBy('events.id', 'asc')
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
                ->join('users', 'art_items.artist_id' , '=', 'users.id')
                ->where('evt_artists.evtid', '=', $event_id)
                ->where('evt_artists.artist_id', '=', $artist_id)
                ->select('evt_artists.id', 'title', 'fname', 'ext', 'price', 'gst', 'discount', 'discount_value','users.username')
                ->get();
    }
    
    public function approveEventArt($data) {
        $this->data = $data;

        $result = DB::transaction(function () {

            $eventDetails = $this->getEventDetails($this->data['event_id']);
            $artsCount = count($this->data['event_art_ids']);
            $paymentAmount = $eventDetails['no_of_entries'] == 1 ? ($artsCount * $eventDetails['fees']) : ($artsCount * ($eventDetails['fees']/$eventDetails['no_of_entries']));
            
            DB::table('evt_artists')
                            ->whereIn('id', $this->data['event_art_ids'])
                            ->update(['admin_approved' => 1]);
            
            DB::table('evt_artists')
                                ->where('id', $this->data['featured_image'])
                                ->update(['is_featured' => 1]);
            
            $lastInsertId = DB::table('event_payment')->insertGetId([
                                            'event_id' => $this->data['event_id'],
                                            'artist_id' => $this->data['artist_id'],
                                            'payment_amount' => $paymentAmount,
                                            'payment_link'  => hash('sha256', $this->data['event_id'].$this->data['artist_id'].time())
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
                ->select('ai.fname', 'ai.ext', 'u.username', 'u.profimg', 'u.uname')
                ->get();
        
        if (!empty($result)) {
            return $result;
        }
        
        return [];
    }
    
    public function addMemorableMoments($data) {
        $insert = DB::table('moments')->insert([
                                            'event_id' => $data['event_id'],
                                            'title' => $data['title'],
                                            'image' => $data['image'],
                                            'is_active' => 1
                                        ]);

        if ($insert === true) {
            return true;
        }
        return false;
    }
    
    public function getMemorableMoments($event_id) {
        return DB::table('moments as m')
                ->join('events as e', 'm.event_id', '=', 'e.id')
                ->where('event_id', $event_id)
                ->select('m.id as moment_id', 'm.title', 'm.image', 'e.eurl')
                ->get();
    }
    
    public function deleteMoment($id) {
        $response = DB::table('moments')->delete($id);
        if ($response >= 1) {
            return true;
        }
        return false;
    }
    
    public function getArtistEvents($artist_id) {
        return DB::table('evt_artists')
                ->where('artist_id', $artist_id)
                ->groupBy('evtid')
                ->select('evtid')
                ->get()
                ->toArray();
    }
    
    public function checkLink($link) {
        $result = DB::table('event_payment')
                        ->where('payment_link', $link)
                        ->get()
                        ->toArray();                
        
        if ($result != null || !empty($result)) {
            return $result;
        }

        return false;
    }
    
    public function updatePayment($data) {
        $updateData = [
                        'payment_received' => 'y',
                        'transaction_id' => $data['transaction_id']
                    ];

        $updateStatus = DB::table('event_payment')
            ->where('id', $data['id'])
            ->update($updateData);

        if ($updateStatus >= 1) {
            return true;
        }
        
        return false;
    }
    
    public function addOnlineEvent($data) {
        $insert = DB::table('contests')->insert([
                                            'etitle' => $data['event_name'],
                                            'eurl' => str_replace(' ', '-', strtolower($data['event_name'])).'-'.date('d-M-Y', strtotime($data['start_date'])),
                                            'about' => $data['about'],
                                            'start_date' => $data['start_date'],
                                            'end_date' => $data['end_date'],
                                            'banner' => $data['image'],
                                            'shide' => $data['status'],
                                            'first_prize' => $data['first_prize'],
                                            'second_prize' => $data['second_prize'],
                                            'third_prize' => $data['third_prize']
                                        ]);

        if ($insert === true) {
            return true;
        }
        return false;
    }
    
    public function getAllOnlineEvents($records = '') {
        if ($records == 'all') {

            $events = DB::table('contests')
                                ->select('id', 'etitle', 'eurl', 'start_date','end_date', 'shide as status', 'first_prize', 'second_prize', 'third_prize')

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
    
    public function updateOnlineEventStatus($event_id, $status) {
        $updateStatus = DB::table('contests')
            ->where('id', $event_id)
            ->update(['shide' => $status]);

        if ($updateStatus >= 1) {
            return true;
        }
        
        return false;
    }
    
    public function updateOnlineEvent($data) {
        
        $updateData = [
                        'etitle' => $data['event-name'],
                        'about' => $data['about'],
                        'start_date' => $data['start_date'],
                        'end_date' => $data['end_date'],
                        'banner' => $data['image'],
                        'shide' => $data['status'],
                        'first_prize' => $data['first_prize'],
                        'second_prize' => $data['second_prize'],
                        'third_prize' => $data['third_prize']
                    ];
        
        if (isset($data['image']) && !empty($data['image'])) {
            $updateData['banner'] = $data['image'];
        }

        $updateStatus = DB::table('contests')
            ->where('id', $data['event-id'])
            ->update($updateData);

        if ($updateStatus >= 1) {
            return true;
        }
        return false;
    }
    
    public function getOnlineEventDetails($event_id) {
        $events = DB::table('contests')
                ->where('id', $event_id)
                ->get()
                ->toArray();

        if (!empty($events)) {
            return $events[0];
        }

        return [];
    }
    
    public function getArtistOnlineEvents($artist_id) {
        return DB::table('contest_art')
                ->where('artist_id', $artist_id)
                ->groupBy('contid')
                ->select('id')
                ->get()
                ->toArray();
    }
}
