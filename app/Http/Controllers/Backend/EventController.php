<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Session;
use Auth;
use Gate;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->events = new Events();
        $this->catalogue = new Catalogue();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->events->getAllEvents('all');
        return view('backend.events.index')->with([
                                    'events' => $events
                                ]);
    }

    /**
     * Show the application event details.
     *
     * @return \Illuminate\Http\Response
     */
    public function eventDetails(Request $request, $id)
    {
        $eventDetails = $this->events->getEventDetails($id);
        return view('eventdetails')->with([
                                            'eventDetails' => $eventDetails
                                        ]);
    }

    public function updateStatus(Request $request, $event_id) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $event = $this->events->updateEventStatus($event_id, $request['status']);

        if ($event == true) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function edit(Request $request, $event_id = '') {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['event-name']));
                $name = str_slug($title).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path(config('constants.uploads.events')) . $inputData['path'];
                $image->move($destinationPath, $name);
                
                $inputData['image'] = $name;
            }
            
            $result = $this->events->updateEvent($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Event updated successfully');                
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
            }
            
            return redirect('/admin/events/'.$inputData['event-id']);
        } else {
            $event = $this->events->getEventDetails($event_id);

            return view('backend.events.edit-event')->with([
                                                'event' => $event
                                            ]);
        }
    }

    public function addEvent(Request $request) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

            $valid = $request->validate([
                'event_name' => 'required|regex:/(^([a-zA-Z\s]+)(\d+)?$)/u|max:50',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('image')) {
                
                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['event_name']));
                $name = str_slug($title).'.'.$image->getClientOriginalExtension();

                $destinationPath = public_path(config('constants.uploads.events')) . $title .'-'. date('d-M-Y', strtotime($inputData['start_date']));
                $image->move($destinationPath, $name);
            }

            $inputData['image'] = $name;
            
            $result = $this->events->addEvent($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Event added successfully');
                return redirect('/admin/events');
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
                return redirect('/admin/events/add');
            }
        } else {
            return view('backend.events.add-event');
        }
    }

    public function participateEvent(Request $request, $event_id){

        if (!Gate::allows('isArtist')) {
            abort(401);
        }
        
        $artist_id = Auth::user()->id;
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

            $request->validate([
                'art_id' => 'required'
            ]);

            $eventArtistsArray = [];
            
            foreach($inputData['art_id'] as $id) {
                $eventArtistsArray[] = [
                                'evtid'             => $event_id,
                                'artist_id'         => $artist_id,
                                'artist_item_id'    => $id,
                                'shide'             => 0
                            ];
            }
            
            $result = $this->events->participateEventArts($eventArtistsArray, $inputData['event_art_id']);
            if ($result == true) {
                Session::flash('success_message', 'Particiapted successfully');
                return redirect('/admin/events');
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
                return redirect('/admin/participateEvent/'.$event_id);
            }
        } else {
            if(!isset($_SERVER['HTTP_REFERER'])) {
                abort(401);
            }
            
            $arts = $this->catalogue->getArtistArts($artist_id, true);            
            $eventArts = $this->events->getArtistEventArts($artist_id, $event_id);
            
            $eventArtItemIds = [];
            $eventArtIds = '';
            
            if (!empty($eventArts)) {
                $eventArtItemIds = array_column($eventArts, 'artist_item_id');
                $eventArtIds = implode(',', array_column($eventArts, 'id'));
            }

            return view('backend.events.participate-event')->with([
                                            'arts'          => $arts,
                                            'eventArts'     => $eventArtItemIds,
                                            'event_id'      => $event_id,
                                            'event_artist_id' => $eventArtIds
                                        ]);
        }
    }
    
    public function participants() {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $eventParticipants = $this->events->getEventParticipants();
        return view('backend.events.event-participants')->with([
                                    'eventParticipants' => $eventParticipants
                                ]);
    }
    
    public function participantDetails(Request $request, $event_id, $artist_id) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('post')) {
            $inputData = $request->all();
            
            $data = [
                'event_art_ids'     => $inputData['event_id'], 
                'featured_image'    => $inputData['featured_image'],
                'event_id'          => $event_id,
                'artist_id'         => $artist_id
            ];

            $response = $this->events->approveEventArt($data);

            if (!empty($response) && count($response)) {
                $html = 'Total amount to be paid : <b>'. $response[0]->payment_amount . '</b>. <br>Cleck on the link <a href="'.env('APP_URL') . '/event/payment/' . $response[0]->payment_link.'">Click here</a> to make the payment';
                $status = Mail::send([], [], function($message) use ($html) {
                    $message->from(env('MAIL_USERNAME'), 'Jagat Prakash');
                    $message->to('jagat2205114@gmail.com');
                    $message->subject('Event Payment');
                    $message->setBody($html, 'text/html');
                }); 
                
                Session::flash('success_message', 'Participant approved successfully');
                return redirect('/admin/event/participants');
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
                return redirect('/admin/event/participants/' . $event_id . ''. $artist_id);
            }
        }
        
        $eventArts = $this->events->getParticipantDetails($event_id, $artist_id);
        
        if (!empty($eventArts) && count($eventArts)) {
            foreach ($eventArts as $art) {
                $calculateData = [
                                    'price' => $art->price,
                                    'gst' => $art->gst,
                                    'discountType' => $art->discount,
                                    'discountValue' => $art->discount_value
                                ];
                
                $art->totalPrice = Helper::calculatePrice($calculateData);
            }
        }

        return view('backend.events.participant-details')->with([
                                    'eventArts' => $eventArts,
                                    'event_id' => $event_id,
                                    'artist_id' => $artist_id
                                ]);
    }
    
    public function uploadMemorableMoments(Request $request, $eventId) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();
            dd($inputData);
            
            if ($request->hasFile('image')) {
                
                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['event_name']));
                $name = str_slug($title).'.'.$image->getClientOriginalExtension();

                $destinationPath = public_path(config('constants.uploads.events')) . $title .'-'. date('d-M-Y', strtotime($inputData['start_date']));
                $image->move($destinationPath, $name);
            }

            $inputData['image'] = $name;
            
            $result = $this->events->addEvent($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Moments uploaded successfully');
                return redirect('/admin/events');
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
                return redirect('/admin/event/moments/'.$eventId);
            }
        }
        
        return view('backend.events.memorable-moments')->with([
                                    'eventId' => $eventId
                                ]);
    }
}
