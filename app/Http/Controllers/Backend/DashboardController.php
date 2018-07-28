<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

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
        $id = '';
        $totalArtists = 0;
        
        if (Auth::user()->user_role == 'artist') {
            $id = Auth::user()->id;
        } else {
            $totalArtists = $this->artists->getTotalArtistsCount();
        }
        
        $totalArts = $this->catalogue->getTotalArtsCount($id);
        $totalEvents = $this->events->getTotalEventsCount();
        
        return view('backend.index')->with([
                                        'totalArts' => $totalArts ?? 0,
                                        'totalArtists' => $totalArtists,
                                        'totalEvents' => $totalEvents
                                    ]);
    }
}
