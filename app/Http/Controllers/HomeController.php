<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use App\Models\Events;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
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
        $result = $this->catalogue->getCatalogues();
        $category = $this->category->getCatalogues();

        return view('home')->with(['catalogues' => $result, 'categories' => $category]);
    }

    /**
     * Show the application aboutus.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutus()
    {
        return view('aboutus');
    }

    /**
     * Show the application artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function artists()
    {
        $artists = $this->artists->getAllArtists();
        return view('artists')->with(['artists' => $artists]);
    }

    /**
     * Show the application events.
     *
     * @return \Illuminate\Http\Response
     */
    public function events()
    {
        $events = $this->events->getAllEvents();
        return view('events')->with(['events' => $events]);
    }
}
