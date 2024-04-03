<?php

namespace App\Http\Controllers\Api;

use App\Actions\GetCurrentPlayback;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SpotifyController extends Controller
{
    public function nowPlaying(): JsonResponse
    {
        return response()->json(
            GetCurrentPlayback::run()->toArray()
        );
    }
}
