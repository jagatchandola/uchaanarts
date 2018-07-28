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
        
        // Artists Routes (Admin)
	Route::get('/admin/artists','Backend\ArtistController@index')->name('artists-list');
	Route::put('/admin/artists/changeStatus/{id}','Backend\ArtistController@updateStatus');
        Route::get('/admin/artists/{id}','Backend\ArtistController@edit')->name('edit-artist');
        Route::post('/admin/artist','Backend\ArtistController@edit')->name('edit-artist-post');
        
        // gallery Routes (Admin)
	Route::get('/admin/gallery','Backend\CatalogueController@index')->name('gallery-list');
        Route::get('/admin/gallery/{artistId}/{artId}','Backend\CatalogueController@edit')->name('edit-gallery');
        Route::post('/admin/gallery','Backend\CatalogueController@edit')->name('edit-gallery-post');
        
        // Customers Routes (Admin)
        Route::get('/admin/customers','Backend\ArtistController@getCustomers')->name('customers-list');
        
        // Category Routes (Admin)
        Route::get('/admin/category', 'Backend\CategoryController@index')->name('category-list');
        Route::put('/admin/category/changeStatus/{id}', 'Backend\CategoryController@updateStatus');
        Route::get('/admin/category/{id}', 'Backend\CategoryController@edit')->name('edit-category');
        Route::post('/admin/category', 'Backend\CategoryController@editPost')->name('edit-category-post');
        Route::match(['get', 'post'], '/admin/category/add', 'Backend\CategoryController@addCategory')->name('add-category');
        
        // Event Routes (Admin)
        Route::get('/admin/events','Backend\EventController@index')->name('events-list');
//	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

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
