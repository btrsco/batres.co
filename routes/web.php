<?php

use App\Http\Controllers\CallbackController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'index'])
    ->name('index');

Route::get('/oauth/spotify/{key}', [OAuthController::class, 'spotify'])
    ->name('oauth.spotify');
Route::get('/oauth/dribbble/{key}', [OAuthController::class, 'dribbble'])
    ->name('oauth.dribbble');

Route::get('/callback/spotify', [CallbackController::class, 'spotify'])
    ->name('callback.spotify');
Route::get('/callback/dribbble', [CallbackController::class, 'dribbble'])
    ->name('callback.dribbble');
