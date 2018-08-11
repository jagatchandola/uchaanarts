<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Artists;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Gate;
use Session;
use Auth;

class ArtistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->catalogue = new Catalogue();
        $this->artists = new Artists();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $artists = $this->artists->getAllArtists('all');
        return view('backend.artist.index')->with([
                                            'artists' => $artists
                                        ]);
    }

    /**
     * Show the application artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCustomers()
    {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $customers = $this->artists->getCustomers();
        return view('backend.customers.index')->with([
                                            'customers' => $customers
                                        ]);
    }

    /**
     * Show the customer details.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerDetails(Request $request, $id)
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

    public function updateStatus(Request $request, $artist_id) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $artist = $this->artists->updateArtistStatus($artist_id, $request['status'], $request['type']);

        if ($artist == true) {
            $msg = $request['type'] == 'approve' ? 'Artist approved successfully' : 'Status updated successfully';
            Session::flash('success_message', $msg);
            echo 1;
        } else {
            Session::flash('error_message', 'Something went wrong. Please try again.');
            echo 0;
        }
    }
    
    public function edit(Request $request, $artist_id = '') {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

            $result = $this->artists->updateArtist($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Artist updated successfully');
                return redirect('/admin/artists/'.$inputData['artist-id']);
            } else {
                Session::flash('success_message', 'Something went wrong. Please try again');
                return redirect('/admin/artists/'.$inputData['artist-id']);
            }
        } else {
            $artist = $this->artists->getArtistDetails($artist_id);

            return view('backend.artist.edit-artist')->with([
                                                'artist' => array_shift($artist)
                                            ]);
        }
    }
    
    public function viewArts($artist_id) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $arts = $this->catalogue->getArtistArts($artist_id);

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
        
        return view('backend.artist.view-arts')->with([
                                            'arts' => $arts
                                        ]);
    }
    
    public function getPendingArtists()
    {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $artists = $this->artists->getPendingArtists();
        return view('backend.artist.pending')->with([
                                            'artists' => $artists
                                        ]);
    }

    public function profile(Request $request)
    {
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['title']));
                $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path(config('constants.uploads.artists')).Auth::user()->username;
                $image->move($destinationPath, $name);
                
                $inputData['profimg'] = $name;
                unset($inputData['image']);
            }

            $result = $this->artists->updateProfile(Auth::user()->id, $inputData);
            if ($result == true) {
                Session::flash('success_message', 'Profile updated successfully');
                return redirect('/admin/artist/profile');
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
                return redirect('/admin/artist/profile');
            }
        } else {
            $artist = $this->artists->getArtistsProfile(Auth::user()->id);
            // print_r($artists);die;
            return view('backend.artist.profile')->with([
                                                'artist' => $artist
                                            ]);
        }
    }
}
