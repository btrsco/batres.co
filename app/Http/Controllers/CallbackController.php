<?php

namespace App\Http\Controllers;

use App\Actions\CacheDribbbleAccessToken;
use App\Actions\CacheSpotifyAccessToken;
use App\Wrappers\Dribbble\Dribbble;
use Illuminate\Http\Request;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIAuthException;

class CallbackController extends Controller
{
    public function spotify(Request $request)
    {
        $api = new SpotifyWebAPI();

        try {
            $accessData = CacheSpotifyAccessToken::run($request->code);
            $api->setAccessToken($accessData['access_token']);

            dd($api->me());
        } catch (SpotifyWebAPIAuthException $e) {
            return redirect()->route('oauth.spotify');
        }
    }

    public function dribbble(Request $request)
    {
        $dribbbleApi = new Dribbble(
            clientId: config('services.dribbble.client_id'),
            clientSecret: config('services.dribbble.client_secret'),
            redirectUri: config('services.dribbble.redirect')
        );

        $accessData = CacheDribbbleAccessToken::run($request->code);
    }
}
