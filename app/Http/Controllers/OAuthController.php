<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpotifyWebAPI\Session;

class OAuthController extends Controller
{
    public function dribbble(Request $request, string $key)
    {
        if ($key !== config('services.dribbble.url_key')) {
            abort(404);
        }

        return redirect(
            'https://dribbble.com/oauth/authorize?' . http_build_query([
                'client_id'    => config('services.dribbble.client_id'),
                'redirect_uri' => config('services.dribbble.redirect'),
                'scope'        => 'public',
                'state'        => csrf_token(),
            ])
        );
    }

    public function spotify(Request $request, string $key)
    {
        if ($key !== config('services.spotify.url_key')) {
            abort(404);
        }

        $session = new Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')
        );

        return redirect(
            $session->getAuthorizeUrl([
                'scope' => [
                    'user-read-email',
                    'user-read-playback-state',
                ],
            ])
        );
    }
}
