<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/login', 'LoginController@index')->name('login');
//Route::post('/register', 'RegisterController@create')->name('register');
Route::post('/logout-custom', 'LoginController@logout')->name('logout-custom');
Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus');
Route::get('/artists', 'HomeController@artists')->name('artists');
Route::get('/artists/{id}', 'HomeController@artistdetails')->name('artistdetails');
Route::get('/events', 'HomeController@events')->name('events');
Route::get('/events/{id}', 'HomeController@eventdetails')->name('eventdetails');
Route::get('/art-gallery', 'HomeController@gallery')->name('art-gallery');
Route::get('/art-gallery/{cat_name}', 'HomeController@catGallery')->name('cat-art-gallery');
Route::get('/artists/{id}/{art_id}', 'HomeController@artistArtDetails')->name('artist-art');

Route::get('/testimonials', 'HomeController@testimonials')->name('testimonials');
Route::get('/media', 'HomeController@media')->name('media');
Route::get('/contactus', 'HomeController@contactus')->name('contactus');
Route::post('/contactus', 'HomeController@contactus')->name('contactus');



// Backend routes
Route::match(['get', 'post'], '/backend/login','Backend\LoginController@index')->name('backend-login');
//Route::get('/admin/dashboard','Backend\DashboardController@index')->name('backend-dashboard');	

Route::group(['middleware' => ['auth']],function(){
	Route::get('/admin/dashboard','Backend\DashboardController@index')->name('backend-dashboard');
	//Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/artists','Backend\ArtistController@getArtists')->name('artists-list');
	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

	// Categories Routes (Admin)
//	Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
//	Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
//	Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
//	Route::get('/admin/view-categories','CategoryController@viewCategories');
//
//	// Products Routes
//	Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
//	Route::get('/admin/view-products','ProductsController@viewProducts');
});
//Route::namespace('Backend')->prefix('backend')->group(function () {
//	Route::get('/login', 'LoginController@index')->name('backend-login');
//        Route::post('/login', 'LoginController@index')->name('backend-post-login');
//	Route::get('/', 'DashboardController@index')->name('backend-dashboard');
//});

Route::get('/backend/logout', 'Backend\LoginController@logout')->name('backend-logout');
