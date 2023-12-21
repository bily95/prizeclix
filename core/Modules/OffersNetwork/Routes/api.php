<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/offersnetwork', function (Request $request) {
    return $request->user();
});

// get Offers and store them to database
Route::name('offers-network.fetch.')->prefix('offers-network')->group(function () {
    Route::get('/fetch/{provider}', 'Api\FetchProviderController@index')->name('provider');
    Route::get('/load/{provider}', 'Api\FetchProviderController@fetch')->name('custom');
});
