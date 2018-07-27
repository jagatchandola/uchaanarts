<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Session;

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
        //$arts = $this->catalogue->getCatalogues('all');
        $arts = $this->catalogue->getCatalogues();
        return view('backend.gallery.index')->with([
                                    'arts' => $arts
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
            
            $result = $this->catalogue->updateArt($inputData);

            if ($result == true) {
                Session::flash('success_message', 'Art updated successfully');
                return redirect('/admin/gallery/' . $inputData['artist-id'] . '/' . $inputData['art-id']);
            } else {
                Session::flash('success_message', 'Something went wrong. Please try again');
                return redirect('/admin/gallery/' . $artist_id . '/' . $art_id);
            }
        } else {
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

}
