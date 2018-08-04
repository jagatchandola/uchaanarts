<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Gate;
use Session;

class BannerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->banner = new Banner();
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
        
        $banners = $this->banner->getBanners();
        return view('backend.banner.index')->with([
                                            'banners' => $banners
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
   
}
