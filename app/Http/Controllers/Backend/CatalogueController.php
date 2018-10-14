<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Session;
use Illuminate\Support\Facades\Auth;
use Gate;


class CatalogueController extends Controller
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
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = '';

        if (Auth::user()->user_role == 'artist') {
            $id = Auth::user()->id;
        }
        
        $message = '';
        
        if (Session::has('success_message')) {
            $message = Session::get('success_message');
        } elseif (Session::has('error_message')) {
            $message = Session::get('error_message');
        }
       
        $arts = $this->catalogue->getCatalogues('all', $id, true);
        return view('backend.gallery.index')->with([
                                    'arts' => $arts,
                                    'message' => $message
                                ]);
    }

    /**
     * Show the application artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $artist_id = '', $art_id = '')
    {
        if ($request->isMethod('POST')) {
            $inputData = $request->all();
            $id = '';

            if (Auth::user()->user_role == 'artist') {
                $id = Auth::user()->id;
                
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $title = str_replace(' ', '-', strtolower($request['title']));
                    $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path(config('constants.uploads.artists')).Auth::user()->username.'/imgs/';
                    $image->move($destinationPath, $name);
                    
                    $inputData['image'] = $name;
                }
            }

            $result = $this->catalogue->updateArt($inputData, $id);

            if ($result == true) {
                Session::flash('success_message', 'Art updated successfully');
                
                if (!empty($id)) {
                    return redirect('/admin/gallery');
                }
                
                return redirect('/admin/gallery/' . $inputData['artist-id'] . '/' . $inputData['art-id']);
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
                return redirect('/admin/gallery/' . $artist_id . '/' . $art_id);
            }
        } else {
            if(!isset($_SERVER['HTTP_REFERER'])) {
                abort(401);
            }
            
            $art = $this->catalogue->getArtDetails($artist_id, $art_id);

            $calculateData = [
                                        'price' => $art[0]->price,
                                        'gst' => $art[0]->gst,
                                        'discountType' => $art[0]->discount,
                                        'discountValue' => $art[0]->discount_value
                                    ];

            $totalPrice = Helper::calculatePrice($calculateData);
            
            return view('backend.gallery.edit-gallery')->with([
                                                    'art' => $art[0],
                                                    'totalPrice' => $totalPrice
                                                ]);
        }
    }

    public function getPendingPhotos() {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $message = '';
        
        if (Session::has('success_message')) {
            $message = Session::get('success_message');
        } elseif (Session::has('error_message')) {
            $message = Session::get('error_message');
        }
        
        $arts = $this->catalogue->getPendingPhotos();
        return view('backend.gallery.pending-gallery')->with([
                                    'arts' => count($arts) ? $arts : [],
                                    'message' => $message
                                ]);
    }

    public function updatePendingPhotos(Request $request, $art_id = null) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('post')) {
            $inputData = $request->all();

            $result = $this->catalogue->updateArt($inputData);

            if ($result == true) {
                Session::flash('success_message', 'Product approved successfully');               
                return redirect('/admin/gallery/pending');                
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
                return redirect('/admin/gallery/pending/' . $art_id);
            }
        }
        
        if(!isset($_SERVER['HTTP_REFERER'])) {
            abort(401);
        }

        $art = $this->catalogue->getArtById($art_id);

        $calculateData = [
                                    'price' => $art[0]->price,
                                    'gst' => $art[0]->gst,
                                    'discountType' => $art[0]->discount,
                                    'discountValue' => $art[0]->discount_value
                                ];

        $totalPrice = Helper::calculatePrice($calculateData);

        return view('backend.gallery.update-gallery')->with([
                                                'art' => $art[0],
                                                'totalPrice' => $totalPrice
                                            ]);
    }
    
    public function addGallery(Request $request)
    {
        $errors = [];
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

            // $validator = $this->validate($request, [
            //     'image' => 'required',
            //     'title' => 'required',
            //     'about' => 'required',
            //     'price' => 'required',
            //     'title' => 'required',
            //     'subject' => 'required',
            //     'painting' => 'required',
            //     'surface' => 'required',
            //     'size' => 'required',
            //     'quantity' => 'required'
            // ]);
            // if ($validator->fails()) {
                
            //     $errors = $validator->messages()->all();
                
            // } else {

                $id = Auth::user()->id;

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $title = str_replace(' ', '-', strtolower($request['title']));
                    $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path(config('constants.uploads.artists')).Auth::user()->username.'/imgs/';
                    $image->move($destinationPath, $name);

                    $inputData['image'] = $name;

                    $result = $this->catalogue->addArt($inputData, $id);

                    if ($result == true) {
                        Session::flash('success_message', 'Product has been sent to admin for approval');
                        return redirect('/admin/gallery/add');
                    } else {
                        Session::flash('error_message', 'Something went wrong. Please try again');
                        return redirect('/admin/gallery/add');
                    }
                } else {
                    $errors[0] = 'Product Image is required.';
                }
            // }
        }
        //dd(Auth::user());
        $categories = $this->category->getCategories();
        return view('backend.gallery.add-gallery')->with([
                                                            'categories' => $categories, 'errors' => $errors
                                                        ]);
        
    }
    public function deleteProduct(Request $request, $id){

        $getProduct = $this->catalogue->getArtById($id);
        if ($getProduct == true) {
            $getProduct = $getProduct[0];
            $image = $getProduct->username.'/imgs/'.$getProduct->fname.'.'.$getProduct->ext;
            
                // echo public_path(config('constants.uploads.artists').$image);die;
            $delete = $this->catalogue->deleteProduct($id);
            if ($delete == true) {
                
                if(is_file(public_path(config('constants.uploads.artists').$image))) {
                    unlink(public_path(config('constants.uploads.artists').$image));
                }
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }
}
