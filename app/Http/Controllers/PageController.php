<?php

namespace App\Http\Controllers;

use App\Actions\GetCurrentPlayback;
use App\Actions\GetRecentShots;

class PageController extends Controller
{
    public function index()
    {
        return inertia('Home', [
            'nowPlaying' => GetCurrentPlayback::run()->toArray(),
            'recentShots' => GetRecentShots::run(),
            'availableForWork' => env('AVAILABLE_FOR_WORK', false),
        ]);
    }
}
