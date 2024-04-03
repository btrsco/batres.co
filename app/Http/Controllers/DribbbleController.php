<?php

namespace App\Http\Controllers;

use App\Actions\GetRecentShots;

class DribbbleController extends Controller
{
    public function recentShots()
    {
        return response()->json(GetRecentShots::run());
    }
}
