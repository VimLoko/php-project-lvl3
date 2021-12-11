<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UrlController;
use \App\Http\Controllers\MainPageController;
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

Route::get('/', [MainPageController::class, 'index'])->name('main');

Route::resource('urls', UrlController::class)
    ->only(['index', 'store', 'show'])
    ->names([
        'index' => 'urls.index',
        'store' => 'urls.store',
        'show' => 'urls.show',
    ]);
