<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $totalArts = $this->catalogue->getTotalArtsCount();        
        $totalArtists = $this->artists->getTotalArtistsCount();
        $totalEvents = $this->events->getTotalEventsCount();
        
        return view('backend.index')->with([
                                        'totalArts' => $totalArts,
                                        'totalArtists' => $totalArtists,
                                        'totalEvents' => $totalEvents
                                    ]);
    }
}
