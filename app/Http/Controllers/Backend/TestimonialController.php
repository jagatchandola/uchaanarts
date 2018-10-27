<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Gate;
use Session;

class TestimonialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->testimonial = new Testimonials();
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
        
        $testimonials = $this->testimonial->getTestimonials(1);
        return view('backend.testimonial.index')->with([
                                            'testimonials' => $testimonials
                                        ]);
    }

    public function updateStatus(Request $request, $testimonial_id) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $artist = $this->testimonial->updateTestimonialStatus($testimonial_id, $request['status']);

        if ($artist == true) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function edit(Request $request, $testimonial_id = '') {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

             if ($request->hasFile('image')) {
                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['name']));
                $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path(config('constants.uploads.testimonials'));
                $image->move($destinationPath, $name);
                
                $inputData['image'] = $name;
            }

            $result = $this->testimonial->updateTestimonial($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Banner updated successfully');
                return redirect('/admin/testimonial/'.$inputData['testimonial-id']);
            } else {
                Session::flash('success_message', 'Something went wrong. Please try again');
                return redirect('/admin/testimonial/'.$inputData['testimonial-id']);
            }
        } else {
            $testimonial = $this->testimonial->getTestimonialDetails($testimonial_id);

            return view('backend.testimonial.edit-testimonial')->with([
                                                'testimonial' => array_shift($testimonial)
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
                $destinationPath = public_path(config('constants.uploads.testimonials'));
                $image->move($destinationPath, $name);
                
                $inputData['image'] = $name;
            }

            $result = $this->testimonial->addTestimonial($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Banner updated successfully');
                return redirect('/admin/testimonial');
            } else {
                Session::flash('success_message', 'Something went wrong. Please try again');
                return redirect('/admin/testimonial/add');
            }
        } else {

            return view('backend.testimonial.add-testimonial');
        }
    }
   
}
