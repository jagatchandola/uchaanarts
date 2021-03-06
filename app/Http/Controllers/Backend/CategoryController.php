<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Session;
use Gate;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->category = new Category();
    }

    /**
     * Show admin category page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $categories = $this->category->getCategories('all');
        return view('backend.category.index')->with([
                                            'categories' => $categories
                                        ]);
    }

    public function updateStatus(Request $request, $cat_id) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        $artist = $this->category->updateArtistStatus($cat_id, $request['status']);

        if ($artist == true) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    public function edit(Request $request, $cat_id = '') {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();
            if(!empty($this->category->checkCategoryName($inputData['cat-name'], $inputData['cat-id']))){
                Session::flash('error_message', 'Category already exists.');
                return redirect('/admin/category/'.$inputData['cat-id']);
            }

            if (!empty($_FILES['image']) && $request->hasFile('image')) {
                
                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['cat-name']));
                $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path(config('constants.uploads.category'));
                $image->move($destinationPath, $name);
                
                $inputData['image'] = $name;
            }
            // print_r($inputData);die;
            
            $result = $this->category->updateCategory($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Category updated successfully');
                return redirect('/admin/category/'.$inputData['cat-id']);
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
                return redirect('/admin/category/'.$inputData['cat-id']);
            }
        } else {
            $cat = $this->category->getCategoryDetails($cat_id);

            return view('backend.category.edit-category')->with([
                                                'category' => array_shift($cat)
                                            ]);
        }
    }

    public function addCategory(Request $request) {
        if (!Gate::allows('isAdmin')) {
            abort(401);
        }
        
        if ($request->isMethod('POST')) {
            $inputData = $request->all();

            $valid = $request->validate([
                'cat-name' => 'required|regex:/(^([a-zA-Z\s]+)(\d+)?$)/u|max:50',
                'gst' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if(!empty($this->category->checkCategoryName($request['cat-name']))){
                Session::flash('error_message', 'Category already exists.');
                return redirect('/admin/category/add');
            }
            if ($request->hasFile('image')) {
                
                $image = $request->file('image');
                $title = str_replace(' ', '-', strtolower($request['cat-name']));
                $name = str_slug($title).'-'.time().'.'.$image->getClientOriginalExtension();
                //$destinationPath = public_path('/uploads/category');
                $destinationPath = public_path(config('constants.uploads.category'));
                $imagePath = $destinationPath. "/".  $name;
                $image->move($destinationPath, $name);
            }

            $inputData['image'] = $name;
            
            $result = $this->category->addCategory($inputData);
            if ($result == true) {
                Session::flash('success_message', 'Category added successfully');
                return redirect('/admin/category');
            } else {
                Session::flash('error_message', 'Something went wrong. Please try again');
                return redirect('/admin/category/add');
            }
        } else {
            return view('backend.category.add-category');
        }
    }
}
