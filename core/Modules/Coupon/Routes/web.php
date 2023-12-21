<?php


use Illuminate\Support\Facades\Route;
use Modules\Coupon\Http\Controllers\AdminController;

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



Route::name('coupon.')->prefix('coupon')->group(function () {
    Route::post('/', 'CouponController@click')->name('click');
});

// admin Route
Route::name('moder.coupon.')->prefix('admin/coupon')->middleware(['auth', 'permission:admin'])->group(function () {

    Route::get('', [AdminController::class, 'index'])->name('index');
    Route::post('store', [AdminController::class, 'store'])->name('store');
    Route::get('edit', [AdminController::class, 'edit'])->name('edit');
    Route::post('update', [AdminController::class, 'update'])->name('update');
    Route::get('{id}/delete', [AdminController::class, 'destroy'])->name('destroy');
    Route::get('changeStatus/{id}', [AdminController::class, 'changeStatus'])->name('change-status');
    Route::get('history', [AdminController::class, 'history'])->name('history');
});
