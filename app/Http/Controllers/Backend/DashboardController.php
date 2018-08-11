<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use App\Models\Events;
use App\Models\Moments;
use Illuminate\Support\Facades\Auth;
use Gate;
use DB;
use Session;

class DashboardController extends Controller
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
        $this->moments = new Moments();
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin') || Gate::allows('isArtist')) {
            $id = '';
            $totalArtists = 0;

            if (Auth::user()->user_role == 'artist') {
                $id = Auth::user()->id;
            } else {
                $totalArtists = $this->artists->getTotalArtistsCount();
            }

            $totalArts = $this->catalogue->getTotalArtsCount($id);
            $totalEvents = $this->events->getTotalEventsCount();

            return view('backend.index')->with([
                                            'totalArts' => $totalArts ?? 0,
                                            'totalArtists' => $totalArtists,
                                            'totalEvents' => $totalEvents
                                        ]);


        }
        
        abort(401);
    }
    
    public function addPhotos(Request $request) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

            $event = DB::table('uchaan_events')->get();

            if ($request->hasFile('image')) {
                for ($i=0; $i<count($request->file('image')); $i++) {
                    $image = $request->file('image')[$i];
                    
                    $title = str_replace(' ', '-', strtolower($request['title']));
                    $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();

                    $destinationPath = public_path(config('constants.uploads.memorable'));

                    $image->move($destinationPath, $name);
                    
                    $inputData['image'] = $name;
                    
                    $result = $this->moments->addMemorableMoments($inputData);
                    if ($result == false) {
                        Session::flash('error_message', 'Something went wrong. Please try again');
                        return redirect('/admin/aboutus');
                    }
                }
                
                Session::flash('success_message', 'Moments uploaded successfully');
                return redirect('/admin/aboutus');
            }
            
        }
        
        $uploadedMoments = $this->moments->getUchaanMoments(true);
        return view('backend.gallery.uchaan-memorable-moments')->with([
                                    'uploadedMoments' => $uploadedMoments
                                ]);
    }
    
    public function deletePhoto($id, $image) {
        $result = $this->moments->deleteMoment($id);
        if($result == true) {
            $path = public_path(config('constants.uploads.memorable') . $image);
            if(file_exists($path)) {
                unlink($path);
            }
            echo 1;
        } else {
            echo 0;
        }
    }
}
