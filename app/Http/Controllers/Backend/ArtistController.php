<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Artists;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Gate;
use Session;

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
        
        $artist = $this->artists->updateArtistStatus($artist_id, $request['status']);

        if ($artist == true) {
            echo 1;
        } else {
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
}
