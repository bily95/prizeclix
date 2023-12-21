<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group.
| Create something great!
|
*/

use Illuminate\Support\Facades\Route;

// Public routes
Route::name('user.offer-network.')->group(function () {
    Route::get('/offers', 'OffersNetworkController@index')->name('index');
    Route::get('/offer/details', 'OffersNetworkController@details')->name('details');
    Route::get('/offers/{category_id}/{category_name}', 'OffersNetworkController@browse')->name('browse');
    Route::get('/offer/click/{offer_id}', 'OffersNetworkController@click')->name('click');
});

// Admin routes
Route::name('moder.offers-network.')
    ->middleware(['auth', 'permission:admin'])
    ->group(function () {
 
    // Categories controller routes
    Route::name('category.')
        ->prefix('admin/offers/categories')
        ->group(function () {
            Route::get('/', 'Admin\CategoryController@index')->name('list');
            Route::post('/store', 'Admin\CategoryController@store')->name('store');
            Route::get('/show', 'Admin\CategoryController@show')->name('show');
            Route::post('/update', 'Admin\CategoryController@update')->name('update');
            Route::get('/delete', 'Admin\CategoryController@destroy')->name('delete');
            Route::get('/active-status/{cate_id}', 'Admin\CategoryController@toggleActiveStatus')->name('active-status');
            Route::get('/home-status/{cate_id}', 'Admin\CategoryController@toggleAtHomeStatus')->name('home-status');
        });

   

    // Manage the fetched offers controller routes
    Route::name('manage-offers.')
        ->prefix('admin/offers/manage')
        ->group(function () {
            Route::get('/', 'Admin\ManageOffersController@index')->name('list');
            Route::get('/{offer_id}/active', 'Admin\ManageOffersController@changeis_active')->name('active');
            Route::get('/{offer_id}/banner', 'Admin\ManageOffersController@changeIsBanner')->name('banner');
            Route::get('/{offer_id}/completed', 'Admin\ManageOffersController@changeIsCompleted')->name('completed');
            Route::get('/delete', 'Admin\ManageOffersController@destroy')->name('delete');
        });
});
