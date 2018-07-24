<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use App\Models\Events;
use App\Models\Testimonials;
use App\Models\Contactus;
use App\Models\Moments;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
        $this->catalogue = new Catalogue();
        $this->category = new Category();
        $this->artists = new Artists();
        $this->events = new Events();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->events->getAllEvents();
        return view('backend.events')->with([
                                    'events' => $events
                                ]);
    }

    /**
     * Show the application artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function getArtists()
    {
        $artists = $this->artists->getAllArtists('all');
        return view('backend.artists')->with(['artists' => $artists]);
    }

    /**
     * Show the artist details.
     *
     * @return \Illuminate\Http\Response
     */
    public function artistdetails(Request $request, $id)
    {
        $artist = $this->artists->getArtistDetails($id);
        if (!empty($artist)) {
            $catalogues = $this->catalogue->getArtistWork($id);
        }

        return view('artistdetails')->with([
                                            'artists' => array_shift($artist),
                                            'catalogues' => $catalogues
                                        ]);
    }

    /**
     * Show the application events.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvents()
    {
        $events = $this->events->getAllEvents();
        $upcomingEvents = $pastEvents = [];

        if (empty($events)) {
           ?> <div>Sorry no arts avialabe right now</div> <?php
        } else {
            foreach ($events as $event) {
                //echo '<pre>';print_r($events->eurl);exit;
                if (strtotime($event->start_date) > strtotime(date('Y-m-d'))) {
                    $upcomingEvents[] = $event;
                } else {
                    $pastEvents[] = $event;
                }
            }
        }
        return view('events')->with(['upcomingEvents' => $upcomingEvents, 'pastEvents' => $pastEvents]);
    }

    /**
     * Show the application event details.
     *
     * @return \Illuminate\Http\Response
     */
    public function eventdetails(Request $request, $id)
    {
        $eventDetails = $this->events->getEventDetails($id);
        return view('eventdetails')->with(['eventDetails' => $eventDetails]);
    }

}
