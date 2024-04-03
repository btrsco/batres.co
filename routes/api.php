<?php

use App\Http\Controllers\Api\SpotifyController;
use App\Http\Controllers\DribbbleController;
use Illuminate\Support\Facades\Route;

Route::get('/spotify/now-playing', [SpotifyController::class, 'nowPlaying'])
    ->name('spotify.now-playing');
