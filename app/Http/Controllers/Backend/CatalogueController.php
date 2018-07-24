<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use Illuminate\Http\Request;
use App\Helpers\Helper;

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
        $arts = $this->catalogue->getCatalogues('all');
        return view('backend.gallery')->with([
                                    'arts' => $arts
                                ]);
    }

    /**
     * Show the application artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function getArtistDetails(Request $request, $id)
    {
        $artists = $this->artists->getAllArtists('all');
        return view('backend.artists')->with(['artists' => $artists]);
    }

}
