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
        
        $banners = $this->banner->getBanners(1);
        return view('backend.banner.index')->with([
                                            'banners' => $banners
                                        ]);
    }

    public function updateStatus(Request $request, $banner_id) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $artist = $this->banner->updateBannerStatus($banner_id, $request['status']);

        if ($artist == true) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function edit(Request $request, $banner_id = '') {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

             if ($request->hasFile('image')) {
                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['name']));
                $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path(config('constants.uploads.banner'));
                $image->move($destinationPath, $name);
                
                $inputData['image'] = $name;
            }

            $result = $this->banner->updateBanner($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Banner updated successfully');
                return redirect('/admin/banner/'.$inputData['banner-id']);
            } else {
                Session::flash('success_message', 'Something went wrong. Please try again');
                return redirect('/admin/banner/'.$inputData['banner-id']);
            }
        } else {
            $banner = $this->banner->getBannerDetails($banner_id);

            return view('backend.banner.edit-banner')->with([
                                                'banner' => array_shift($banner)
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
                $title = str_replace(' ', '-', strtolower($request['name']));
                $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path(config('constants.uploads.banner'));
                $image->move($destinationPath, $name);
                
                $inputData['image'] = $name;
            }

            $result = $this->banner->addBanner($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Banner updated successfully');
                return redirect('/admin/banner');
            } else {
                Session::flash('success_message', 'Something went wrong. Please try again');
                return redirect('/admin/banner/add');
            }
        } else {

            return view('backend.banner.add-banner');
        }
    }
   
}
