<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Artists;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Gate;

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
    
    public function addPhotos() {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

            $event = DB::table('events')->where('id', $eventId)->get();

            if ($request->hasFile('image')) {
                for ($i=0; $i<count($request->file('image')); $i++) {
                    $image = $request->file('image')[$i];
                    
                    $title = str_replace(' ', '-', strtolower($request['title']));
                    $name = str_slug($title).'-'.time().rand().'.'.$image->getClientOriginalExtension();

                    $destinationPath = public_path(config('constants.uploads.events')) . $event[0]->eurl .'/slides/';
                    $image->move($destinationPath, $name);
                    
                    $inputData['image'] = $name;
                    $inputData['event_id'] = $eventId;
                    
                    $result = $this->events->addMemorableMoments($inputData);
                    if ($result == false) {
                        Session::flash('error_message', 'Something went wrong. Please try again');
                        return redirect('/admin/event/moments/' . $eventId);
                    }
                }
                
                Session::flash('success_message', 'Moments uploaded successfully');
                return redirect('/admin/events');
            }
            
        }
        
        $uploadedMoments = $this->events->getMemorableMoments($eventId);
        return view('backend.events.memorable-moments')->with([
                                    'eventId' => $eventId,
                                    'uploadedMoments' => $uploadedMoments
                                ]);
    }
    
    public function deletePhoto($id, $path, $image) {
        $result = $this->events->deleteMoment($id);
        if($result == true) {
            $path = public_path(config('constants.uploads.events') . $path . '/slides/' . $image);
            if(file_exists($path)) {
                unlink($path);
            }
            echo 1;
        } else {
            echo 0;
        }
    }
}
