<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use App\Models\Events;
use App\Models\Testimonials;
use App\Models\Contactus;
use Illuminate\Http\Request;
use App\Helpers\Helper;

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
        $this->testimonials = new Testimonials();
        $this->contactus = new Contactus();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->catalogue->getCatalogues();
        $category = $this->category->getCategories();

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
    public function events()
    {
        $events = $this->events->getAllEvents();
        return view('events')->with(['events' => $events]);
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

    public function gallery() {
        $arts = $this->catalogue->getCatalogues();
        
//        echo '<pre>';
//        print_r($arts);exit;
        if (!empty($arts)) {
            foreach ($arts as $art) {
                $calculateData = [
                                    'price' => $art['price'],
                                    'gst' => $art['gst'],
                                    'discountType' => $art['discount'],
                                    'discountValue' => $art['discount_value']
                                ];
                
                $art['totalPrice'] = Helper::calculatePrice($calculateData);
            }
        }

        $categories = $this->category->getCategories();

        return view('gallery')->with([
                                    'arts' => $arts,
                                    'categories' => $categories
                                ]);
    }

    public function catGallery($cat_name) {
        $arts = $this->category->getCategoryArts($cat_name);

        if (!empty($arts) && count($arts)) {
            foreach ($arts as $art) {
                $calculateData = [
                                    'price' => $art->price,
                                    'gst' => $art->gst,
                                    'discountType' => $art->discount,
                                    'discountValue' => $art->discount_value
                                ];
                
                $art->totalPrice = Helper::calculatePrice($calculateData);
            }
        }
        
        $categories = $this->category->getCategories();

        return view('gallery')->with([
                                    'arts' => $arts,
                                    'categories' => $categories
                                ]);
    }

    public function artistArtDetails($artist_id, $art_id) {
        $arts = $this->catalogue->getArtDetails($artist_id, $art_id);

        $artistOtherArts = $categoryArts = [];
        if (!empty($arts)) {
            $artistOtherArts = $this->catalogue->getOtherArts($artist_id, $arts[0]->id);
            $categoryArts = $this->category->getArtistCategoryArts($arts[0]->cat, $arts[0]->id);
        }
        
        return view('artdetails')->with([
                                    'arts' => $arts,
                                    'artistOtherArts' => $artistOtherArts,
                                    'categoryArts' => $categoryArts
                                ]);
    }
    
    public function testimonials() {
        $testimonails = $this->testimonials->getTestimonials();
        return view('testimonials')->with([
                                    'testimonails' => $testimonails
                                ]);
    }
    
    public function media() {
        return view('media');
    }
    
    public function contactus(Request $request) {
        if($request->post()) {
            //print_r($request->all());exit;
            $this->contactus->insert($request);
        }
        
        return view('contactus');
    }
}
