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
Route::get('/vue', 'VueController@index');

// itinerarios
Route::get('itineraries', 'ItineraryController@index');
Route::get('itineraries/create', 'ItineraryController@create');
Route::post('itineraries/store', 'ItineraryController@store');
Route::get('itineraries/{pnr}', 'ItineraryController@show');

// cambios
Route::get('change/create/{itinerary_id}','ChangeController@create');
Route::post('change/store', 'ChangeController@store');
Route::get('/change', 'ChangeController@index');
Route::get('/change/{pnr}', 'ChangeController@getChangeByPnr');
Route::patch('itineraries/change/update', 'PnrController@updateComments');

// pnr
Route::get('pnr/create/{change_id}','PnrController@create');
Route::post('pnr/store','PnrController@store');
Route::get('pnr/close/{id}', 'PnrController@close');
Route::get('pnr/details/{id}', 'PnrController@getPnrDetails');

// passengers
Route::get('passenger', 'PassengerController@index');
Route::get('passenger/pnrs/{id}', 'PassengerController@getAllPnrs');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// test routes

Route::get('vue-test', 'VueTestController@index');
