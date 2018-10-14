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
use Session;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
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

        $category = $this->category->getCategories('');
        $artists = $this->artists->getArtistDetails('','1');
        $weeklyStatus = $this->artists->getArtistOfWeek();
        $weeklyArts = $this->catalogue->getWeeklyArtistArts();
        //print_r($weeklyArts);die;

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

        return view('home')->with([

                            'catalogues' => $arts, 
                            'categories' => $category,
                            'banners'    => $banners,
                            'artists'    => $artists,
                            'weeklyStatus' => $weeklyStatus,
                            'weeklyArts' => $weeklyArts,
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
        $moments = $this->moments->getUchaanMoments();
        return view('aboutus')->with([
                                    'moments' => $moments
                                ]);
    }

    public function artsCompetition()
    {
        return view('arts-competition');
    }

    /**
     * Show the application artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function artists()
    {
        $artists = $this->artists->getAllArtists();
        //print_r($artists);exit;        
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
                if (strtotime($event->start_date) >= strtotime(date('Y-m-d'))) {
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
    public function eventdetails(Request $request, $event_id)
    {
        $eventDetails = $this->events->getEventDetails($event_id);
        $eventArts = $this->events->getEventFeaturedArts($event_id);
        $moments = $this->moments->getAllMoments($event_id);
       // print_r($moments);die;
        return view('eventdetails')->with([
                                            'eventDetails' => $eventDetails,
                                            'eventArts'    => $eventArts,
                                            'moments' => $moments
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
//dd($art);
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
            echo $result;
            
        } else {
            echo -1;
        }

    }
    
    public function productEnquiry(Request $request, $product_id){
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();
            $result = $this->catalogue->enquiry($inputData, $product_id);
            if ($result !== true) {
                
                try{
                    $html = 'Dear <b>' . $result[0]->uname . '</b>,<br> An enquiry is made for one of your product. Below are the details:<br>';
                    $html .= 'Name: ' . $inputData['name'] . '<br>';
                    $html .= 'Email: ' . $inputData['email'] . '<br>';
                    $html .= 'Mobile No: ' . $inputData['mobile'] . '<br>';
                    $html .= 'Cooments: ' . $inputData['comments'] . '<br>';
                    $html .= '<a href="'.env('APP_URL') . '/artists/' . $result[0]->artist_id . '/' . $product_id .'">Click Here</a> to get product details.';
                    $artistEmail = $result[0]->email;

                    $status = Mail::send([], [], function($message) use ($html, $artistEmail) {
                        $message->from(env('MAIL_USERNAME'), 'Uchaanarts');
                        $message->to($artistEmail);
                        $message->subject('Product Enquiry');
                        $message->setBody($html, 'text/html');
                    });
            
                    $html = 'Dear <b>Admin</b>,<br> An enquiry is made for one of the product. Below are the details:<br>';
                    $html .= 'Name: ' . $inputData['name'] . '<br>';
                    $html .= 'Email: ' . $inputData['email'] . '<br>';
                    $html .= 'Mobile No: ' . $inputData['mobile'] . '<br>';
                    $html .= 'Cooments: ' . $inputData['comments'] . '<br>';
                    $html .= '<a href="'.env('APP_URL') . '/artists/' . $result[0]->artist_id . '/' . $product_id .'">Click Here</a> to get product details.';
                    
                    $status = Mail::send([], [], function($message) use ($html) {
                         $message->from(env('MAIL_USERNAME'), 'Uchaanarts');
                         $message->to(config('app.admin_email'));
                         $message->subject('Product Enquiry');
                         $message->setBody($html, 'text/html');
                    });
                } catch(\Exception $e){
                    
                }
                
                Session::flash('success_message', 'Thanks for making an enquiry. We will soon contact you.');
            } else {

                Session::flash('error_message', 'Some error ocured. Please try again');
            }
            
            return redirect('/product/enquiry/' . $product_id);
            
        }
        
        return view('enquiry')->with([
                                'product_id' => $product_id
                            ]);
    }

    public function whySell()
    {
        return view('why-sell');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    public function copyrightPolicy()
    {
        return view('copyright-policy');
    }

    public function paintings()
    {
        return view('paintings');
    }

    public function photography()
    {
        return view('photography');
    }

    public function nature()
    {
        return view('nature');
    }

    public function spritual()
    {
        return view('spritual');
    }

    public function portrait()
    {
        return view('portrait');
    }

    
}
