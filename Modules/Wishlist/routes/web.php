<?php

use Illuminate\Support\Facades\Route;
use Modules\Wishlist\App\Http\Controllers\WishlistController;

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

Route::group(['as' => 'student.', 'prefix' => 'student', 'middleware' => ['auth:web', 'MaintenanceMode', 'HtmlSpecialchars']], function () {
    Route::get('wishlist', function() { abort(404); })->name('wishlist.index');
    Route::get('wishlist/create', function() { abort(404); })->name('wishlist.create');
    Route::post('wishlist', function() { abort(404); })->name('wishlist.store');
    Route::get('wishlist/{id}', function() { abort(404); })->name('wishlist.show');
    Route::get('wishlist/{id}/edit', function() { abort(404); })->name('wishlist.edit');
    Route::put('wishlist/{id}', function() { abort(404); })->name('wishlist.update');
    Route::delete('wishlist/{id}', function() { abort(404); })->name('wishlist.destroy');
});

