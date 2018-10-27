<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Gate;
use Session;

class MediaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->media = new Media();
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
        
        $media = $this->media->getMedia(1);
        return view('backend.media.index')->with([
                                            'media' => $media
                                        ]);
    }

    public function updateStatus(Request $request, $media_id) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $artist = $this->media->updateMediaStatus($media_id, $request['status']);

        if ($artist == true) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function edit(Request $request, $media_id = '') {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

             if ($request->hasFile('image')) {
                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['title']));
                $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path(config('constants.uploads.media'));
                $image->move($destinationPath, $name);
                
                $inputData['image'] = $name;
            }

            $result = $this->media->updateMedia($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Media cover updated successfully');
                return redirect('/admin/media/'.$inputData['media-id']);
            } else {
                Session::flash('success_message', 'Something went wrong. Please try again');
                return redirect('/admin/media/'.$inputData['media-id']);
            }
        } else {
            $media = $this->media->getMediaDetails($media_id);

            return view('backend.media.edit-media')->with([
                                                'media' => array_shift($media)
                                            ]);
        }
    }

    public function add(Request $request) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

             if ($request->hasFile('image')) {
                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['title']));
                $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path(config('constants.uploads.media'));
                $image->move($destinationPath, $name);
                
                $inputData['image'] = $name;
            }

            $result = $this->media->addMedia($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Media cover updated successfully');
                return redirect('/admin/media');
            } else {
                Session::flash('success_message', 'Something went wrong. Please try again');
                return redirect('/admin/media/add');
            }
        } else {

            return view('backend.media.add-media');
        }
    }
   
}
