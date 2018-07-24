<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Gate;

class ArtistController extends Controller
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
        $artists = $this->artists->getAllArtists('all');
        return view('backend.artists')->with([
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
            return 'You are not authorized!';
        }
        
        $customers = $this->artists->getCustomers();
        return view('backend.customers')->with([
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
        $artist = $this->artists->updateArtistStatus($artist_id, $request['status']);

        if ($artist == true) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
