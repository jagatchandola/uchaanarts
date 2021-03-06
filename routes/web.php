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
Route::post('/logout-custom', 'LoginController@logout')->name('logout-custom');
Route::get('/aboutus', 'HomeController@aboutus')->name('aboutus');
Route::get('/arts-competition', 'HomeController@getCompetition')->name('arts-competition');
Route::get('/arts-competition/{id}', 'HomeController@getCompetitionDetail')->name('arts-competition-detail');
Route::get('/arts-competition/{id}/{artist_id}/{artist_item_id}', 'HomeController@getArtistCompetitionDetail')->name('artist-art-competition-detail');
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

Route::post('/news-letter', 'HomeController@newsLetter')->name('news-letter');

Route::get('/event/payment/{paymentLink}', 'PaymentController@eventPayment')->name('event-payment');
Route::get('/payment', 'PaymentController@productPayment')->name('order-payment');
Route::get('/returnurl/{orderId}', 'PaymentController@returnurl')->name('returnurl');
Route::match(['get', 'post'], '/product/enquiry/{productId}', 'HomeController@productEnquiry')->name('product-enquiry');

Route::get('/checkout', 'OrderController@checkout')->name('checkout');
Route::get('/checkout-register', 'OrderController@checkoutRegister')->name('checkout-register');

// static pages
Route::get('/why-sell', 'HomeController@whySell')->name('why-sell');
Route::get('/privacy-policy', 'HomeController@privacyPolicy')->name('privacy-policy');
Route::get('/copyright-policy', 'HomeController@copyrightPolicy')->name('copyright-policy');
Route::get('/paintings', 'HomeController@paintings')->name('paintings');
Route::get('/photography', 'HomeController@photography')->name('photography');
Route::get('/nature', 'HomeController@nature')->name('nature');
Route::get('/spritual', 'HomeController@spritual')->name('spritual');
Route::get('/portrait', 'HomeController@portrait')->name('portrait');

Route::post('/add-to-cart', 'OrderController@addItem')->name('add-to-cart');

// Backend routes
Route::match(['get', 'post'], '/backend/login','Backend\LoginController@index')->name('backend-login');
//Route::get('/admin/dashboard','Backend\DashboardController@index')->name('backend-dashboard');	

Route::group(['middleware' => ['auth']],function(){
	Route::get('/admin/dashboard','Backend\DashboardController@index')->name('backend-dashboard');
	Route::match(['get', 'post'], '/admin/aboutus', 'Backend\DashboardController@addPhotos')->name('add-aboutus-photos');
    Route::delete('/admin/aboutus/delete/{id}/{image}','Backend\DashboardController@deletePhoto')->name('delete-aboutus-photos');
	//Route::get('/admin/settings','AdminController@settings');
        
        // Artists Routes (Admin)
	Route::get('/admin/artists','Backend\ArtistController@index')->name('artists-list');
        Route::get('/admin/pending/artists','Backend\ArtistController@getPendingArtists')->name('pending-artists');
	Route::put('/admin/artists/changeStatus/{id}','Backend\ArtistController@updateStatus');
        Route::get('/admin/artists/{id}','Backend\ArtistController@edit')->name('edit-artist');
        Route::post('/admin/artist','Backend\ArtistController@edit')->name('edit-artist-post');
        Route::get('/admin/artist/view/{id}','Backend\ArtistController@viewArts')->name('view-artist-arts');
        Route::get('/admin/artist/profile','Backend\ArtistController@profile')->name('artist-profile');
        Route::post('/admin/artist/profile','Backend\ArtistController@profile')->name('artist-profile');
        
        // gallery Routes (Admin)
    Route::get('/admin/gallery','Backend\CatalogueController@index')->name('gallery-list');
        Route::get('/admin/gallery/{artistId}/{artId}','Backend\CatalogueController@edit')->name('edit-gallery');
        Route::post('/admin/gallery','Backend\CatalogueController@edit')->name('edit-gallery-post');
        Route::get('/admin/gallery/pending','Backend\CatalogueController@getPendingPhotos')->name('pending-gallery');
        Route::match(['get', 'post'], '/admin/gallery/pending/{artId}','Backend\CatalogueController@updatePendingPhotos')->name('update-pending-gallery');
        Route::match(['get', 'post'], '/admin/gallery/add','Backend\CatalogueController@addGallery')->name('add-gallery');
	    Route::delete('/admin/product/{id}','Backend\CatalogueController@deleteProduct')->name('delete-product');
        
        
        
        // Customers Routes (Admin)
        Route::get('/admin/customers','Backend\ArtistController@getCustomers')->name('customers-list');
        Route::put('/admin/customers/changeStatus/{id}', 'Backend\ArtistController@updateStatus');
        
        
        
        // Category Routes (Admin)
        Route::get('/admin/category', 'Backend\CategoryController@index')->name('category-list');
        Route::put('/admin/category/changeStatus/{id}', 'Backend\CategoryController@updateStatus');
        Route::get('/admin/category/{id}', 'Backend\CategoryController@edit')->name('edit-category');
        Route::post('/admin/category', 'Backend\CategoryController@edit')->name('edit-category-post');
        Route::match(['get', 'post'], '/admin/category/add', 'Backend\CategoryController@addCategory')->name('add-category');
        
        
        
        // Event Routes (Admin)
        Route::get('/admin/events','Backend\EventController@index')->name('events-list');
        Route::put('/admin/events/changeStatus/{id}', 'Backend\EventController@updateStatus');
        Route::get('/admin/events/{id}', 'Backend\EventController@edit')->name('edit-event');
        Route::post('/admin/events', 'Backend\EventController@edit')->name('edit-event-post');
        Route::match(['get', 'post'], '/admin/event/add', 'Backend\EventController@addEvent')->name('add-event');
        Route::match(['get', 'post'], '/admin/event/moments/{eventId}', 'Backend\EventController@uploadMemorableMoments')->name('upload-memorable-moments');
        Route::delete('/admin/event/deleteMoment/{moment_id}/{path}/{image}', 'Backend\EventController@deleteMoment');
        Route::match(['get', 'post'], '/admin/online/event/add', 'Backend\EventController@addOnlineEvent')->name('add-online-event');
        Route::get('/admin/online/events','Backend\EventController@onlineEvents')->name('online-events-list');
        Route::put('/admin/online/events/changeStatus/{id}', 'Backend\EventController@updateOnlineEventStatus');
        Route::match(['get', 'post'], '/admin/online/events/{id}', 'Backend\EventController@editOnlineEvent')->name('edit-online-event');
        Route::match(['get', 'post'], '/admin/online/event/participate/{id}', 'Backend\EventController@participateOnlineEvent')->name('participate-online-event');
        
        // Event Route 
        Route::match(['get', 'post'], '/admin/event/participateEvent/{id}', 'Backend\EventController@participateEvent')->name('participate-event');
        Route::get('/admin/event/participants', 'Backend\EventController@participants')->name('event-participants');
        Route::match(['get', 'post'], '/admin/event/participants/{event_id}/{artist_id}', 'Backend\EventController@participantDetails')->name('participant');        
        Route::get('/admin/online/event/participants', 'Backend\EventController@onlineParticipants')->name('online-event-participants');
        Route::match(['get', 'post'], '/admin/online/event/participants/{event_id}/{artist_id}', 'Backend\EventController@onlineParticipantDetails')->name('online-participant');        
        

        // Banners
        Route::get('/admin/banner','Backend\BannerController@index')->name('banner-list');
        Route::put('/admin/banner/changeStatus/{id}','Backend\BannerController@updateStatus');
        Route::get('/admin/banner/{id}','Backend\BannerController@edit')->name('edit-banner');
        Route::post('/admin/banner/','Backend\BannerController@edit')->name('edit-banner-post');
        Route::match(['get', 'post'], '/admin/banner/add', 'Backend\BannerController@add')->name('add-banner');

        // testimonials
        Route::get('/admin/testimonial','Backend\TestimonialController@index')->name('testimonial-list');
        Route::put('/admin/testimonial/changeStatus/{id}','Backend\TestimonialController@updateStatus');
        Route::get('/admin/testimonial/{id}','Backend\TestimonialController@edit')->name('edit-testimonial');
        Route::post('/admin/testimonial/','Backend\TestimonialController@edit')->name('edit-testimonial-post');
        Route::match(['get', 'post'], '/admin/testimonial/add', 'Backend\TestimonialController@add')->name('add-testimonial');

        // Media
        Route::get('/admin/media','Backend\MediaController@index')->name('media-list');
        Route::put('/admin/media/changeStatus/{id}','Backend\MediaController@updateStatus');
        Route::get('/admin/media/{id}','Backend\MediaController@edit')->name('edit-media');
        Route::post('/admin/media/','Backend\MediaController@edit')->name('edit-media-post');
        Route::match(['get', 'post'], '/admin/media/add', 'Backend\MediaController@add')->name('add-media');

        // Queries
        Route::get('/admin/queries','Backend\OrderController@queris')->name('query-list');
});

Route::get('/backend/logout', 'Backend\LoginController@logout')->name('backend-logout');
