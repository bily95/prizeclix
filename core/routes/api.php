<?php


use App\Http\Controllers\SiteController;
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

Route::middleware('auth:api')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::name('api.')->group(function ()
{
    Route::get('/load-offers', [SiteController::class, 'loadOffers'])->name('load-offers');
    Route::get('/load-sidebar-category', [SiteController::class, 'getSidebarCategory'])->name('load-sidebar-category');
});