<?php

use App\Services\Postback;
use App\Http\Livewire\Welcome;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\OfferController;

// Optimize route
Route::get('/optimize', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    
    //Artisan::call('app:optimize');
    return back();
});


// Change language
Route::get('change-lang/{code}', [SiteController::class, 'changeLanguage']);

// Welcome page
Route::get('/', [Welcome::class, 'home'])->name('welcome');

// user modal for public
Route::get('/user-public-profile', [SiteController::class, 'userPublicProfile'])->name('userPublicProfile');

// Placeholder image route
Route::get('placeholder-image/{size}', [SiteController::class, 'placeholderImage'])->name('placeholder.image');

// Static pages
Route::view('terms-of-service', SETTING['site_theme'] .'pages.terms')->name('tos');
Route::view('privacy-policy', SETTING['site_theme'] .'pages.policy')->name('policy');
Route::view('faq', SETTING['site_theme'] .'pages.faq')->name('faq');

// Built-in offers callback
Route::any('offers/builtin/callback/{endpoint}', [Postback::class, 'verify'])
    ->name('offers.builtin.callback');

// Custom offers callback
Route::any('offers/custom/callback/{endPoint}', [OfferController::class, 'postBack'])
    ->name('offers.custom.callback');



Route::get('api/user/levelup', [SiteController::class, 'upUserLevel'])->name('site.upUserLevel');


