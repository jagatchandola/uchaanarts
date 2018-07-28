<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use App\Models\Banner;
use App\Models\Events;
use App\Models\Testimonials;
use App\Models\Contactus;
use App\Models\Moments;
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
        $this->moments = new Moments();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arts = $this->catalogue->getCreativeArts();
        // print_r($result);die;
        $category = $this->category->getCategories('all');
        $artists = $this->artists->getArtistDetails('','1');

        $banner = new Banner();

        $banners = $banner->getBanners();

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

        return view('home')->with([
                                'catalogues' => $arts, 
                                'categories' => $category,
                                'banners'    => $banners,
                                'artists'    => $artists,
                                'arts'    => $artists
                            ]);
    }

    /**
     * Show the application aboutus.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutus()
    {
        $moments = $this->moments->getAllMoments();
        return view('aboutus')->with([
                                    'moments' => $moments
                                ]);
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

    public function gallery() {
        $arts = $this->catalogue->getCatalogues();
        
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
