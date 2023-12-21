<?php

use Illuminate\Support\Facades\Route;

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

Route::name('moder.leaderboard.')->prefix('moder/leaderboard')->middleware(['auth', 'permission:admin'])->group(function(){
    Route::get('list', 'AdminController@index')->name('index');
    Route::get('edit/{level_id}', 'AdminController@edit')->name('edit');
    Route::post('store', 'AdminController@store')->name('store');
    Route::post('update/{id}', 'AdminController@update')->name('update');
    Route::get('delete/{id}', 'AdminController@delete')->name('delete');
    Route::get('history', 'AdminController@history')->name('history');
});

Route::prefix('leaderboard')->group(function() {
    Route::get('/{type?}', 'LeaderboardController@index')->name('user.leaderboard');
    Route::get('/history/{type?}', 'LeaderboardController@history')->name('user.leaderboard.history');
    Route::get('/cron/{type?}', 'LeaderboardController@cronjob')->name('leaderboard.cronjob');
});
