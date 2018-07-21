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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login', 'LoginController@index')->name('login');
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
