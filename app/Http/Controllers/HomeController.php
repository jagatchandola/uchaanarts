<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use App\Models\Banner;
use App\Models\Events;
use App\Models\Testimonials;
use App\Models\Contactus;
use App\Models\NewsLetter;
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

        $category = $this->category->getCategories('all');
        $artists = $this->artists->getArtistDetails('','1');
        $weeklyStatus = $this->artists->getArtistOfWeek();

        $events = $this->events->getAllEvents();
        $upcomingEvents = [];

        if (!empty($events)) {
           
            foreach ($events as $event) {
                if (strtotime($event->start_date) >= strtotime(date('Y-m-d'))) {
                    $upcomingEvents[] = $event;
                }
            }
        }

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
// echo '<pre>';print_r($arts);exit;
        return view('home')->with([

                            'catalogues' => $arts, 
                            'categories' => $category,
                            'banners'    => $banners,
                            'artists'    => $artists,
                            'weeklyStatus' => $weeklyStatus,
                            'upcomingEvents' => $upcomingEvents

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
            $items = [];
            if (!empty($catalogues) && count($catalogues)) {
                foreach ($catalogues as $art) {
                    $calculateData = [
                                        'price' => $art['price'],
                                        'gst' => $art['gst'],
                                        'discountType' => $art['discount'],
                                        'discountValue' => $art['discount_value']
                                    ];
                    
                    $art['totalPrice'] = Helper::calculatePrice($calculateData);

                    $items[] = $art;
                }
            }

        }

        return view('artistdetails')->with([
                                            'artists' => array_shift($artist),
                                            'catalogues' => $items
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

        if (!empty($events)) {
           
            foreach ($events as $event) {
//                echo $event->start_date;exit;
//                echo '<pre>';print_r($event);exit;
                if (strtotime($event->start_date) >= strtotime(date('Y-m-d'))) {
                    $upcomingEvents[] = $event;
                } else {
                    $pastEvents[] = $event;
                }
            }
        }
//        echo '<pre>';print_r($upcomingEvents);exit;
        return view('events')->with(['upcomingEvents' => $upcomingEvents, 'pastEvents' => $pastEvents]);
    }

    /**
     * Show the application event details.
     *
     * @return \Illuminate\Http\Response
     */
    public function eventdetails(Request $request, $event_id)
    {
        $eventDetails = $this->events->getEventDetails($event_id);
        $eventArts = $this->events->getEventFeaturedArts($event_id);
       // dd($eventArts);
        return view('eventdetails')->with([
                                            'eventDetails' => $eventDetails,
                                            'eventArts'    => $eventArts
                                        ]);
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
                                    'categories' => $categories,
                                    'cat_name' => $cat_name
                                ]);
    }

    public function artistArtDetails($artist_id, $art_id) {
        $art = $this->catalogue->getArtDetails($artist_id, $art_id);

        $artistOtherArts = $categoryArts = [];
        
        if (!empty($art)) {
            $art = $art[0];
            $calculateData = [
                                'price' => $art->price,
                                'gst' => $art->gst,
                                'discountType' => $art->discount,
                                'discountValue' => $art->discount_value
                            ];

            $art->totalPrice = Helper::calculatePrice($calculateData);

            // artist other arts
            $artistOtherArts = $this->catalogue->getOtherArts($artist_id, $art->id);
            if (!empty($artistOtherArts)) {
                foreach ($artistOtherArts as $artistOtherArt) {
                    $calculateData = [
                                    'price' => $artistOtherArt->price,
                                    'gst' => $artistOtherArt->gst,
                                    'discountType' => $artistOtherArt->discount,
                                    'discountValue' => $artistOtherArt->discount_value
                                ];

                    $artistOtherArt->totalPrice = Helper::calculatePrice($calculateData);
                }                
            }
            
            // artist category related arts
            $categoryArts = $this->category->getArtistCategoryArts($art->cat, $art->id);
            if (!empty($categoryArts)) {
                foreach ($categoryArts as $categoryArt) {
                    $calculateData = [
                                    'price' => $categoryArt->price,
                                    'gst' => $categoryArt->gst,
                                    'discountType' => $categoryArt->discount,
                                    'discountValue' => $categoryArt->discount_value
                                ];

                    $categoryArt->totalPrice = Helper::calculatePrice($calculateData);
                }                
            }
        }

        return view('artdetails')->with([
                                    'art' => $art,
                                    'artistOtherArts' => (!empty($artistOtherArts) && count($artistOtherArts)) ? $artistOtherArts : '',
                                    'categoryArts' => (!empty($categoryArts) && count($categoryArts)) ? $categoryArts : ''
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
        
        $msg = '';
        if($request->post()) {
            $request->validate([
                'fname' => 'required|regex:/(^([a-zA-Z\s]+)(\d+)?$)/u|max:25',
                'lname' => 'required|regex:/(^([a-zA-Z\s]+)(\d+)?$)/u|max:25',
                'email' => 'required|email|max:100',
                'mobile' => 'max:10|max:10',
                'message' => 'required|max:10000'
            ]);
            
//            print_r($request->all());exit;
            if($this->contactus->insert($request)) {
                $msg = 'Thank you for contacting us. We will get back to you soon!';
            }
        }
        
        return view('contactus')->with([ 'message' => $msg]);
    }

    public function newsLetter(Request $request){

        $input  = $request->all();
        if(!empty($input['email'])){
            $news = new NewsLetter();
            $result = $news->add($input);
            if(!empty($result)){
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo -1;
        }

    }
}
