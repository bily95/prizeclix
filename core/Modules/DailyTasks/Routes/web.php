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


Route::prefix('dailytasks')->group(function () {
    Route::get('/', 'DailyTasksController@index')->name('dailytasks');
    Route::get('/claim/{task_id}', 'DailyTasksController@claim')->name('dailytasks.claim');
});

Route::name('moder.dailytasks.')->prefix('moder/dailytasks')->middleware(['auth', 'permission:admin'])->group(function () {
    Route::get('list', 'AdminController@index')->name('index');
    Route::get('edit/{task_id}', 'AdminController@edit')->name('edit');
    Route::post('store', 'AdminController@store')->name('store');
    Route::post('update/{task_id}', 'AdminController@update')->name('update');
    Route::get('delete/{id}', 'AdminController@destroy')->name('delete');
    Route::get('history', 'AdminController@history')->name('history');
});
