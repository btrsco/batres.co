<?php

namespace App\Actions;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

class RefreshSpotifyAccessToken
{
    use AsAction;

    public function handle($accessData = null): array
    {
        if ($accessData === null) {
            $accessData = json_decode(Storage::get('tokens/spotify.json'), true);
        }

        $session = new Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')
        );

        $session->refreshAccessToken($accessData['refresh_token']);

        $api = new SpotifyWebAPI();
        $api->setOptions(['auto_refresh' => true]);
        $api->setAccessToken($session->getAccessToken());

        $data = [
            'authorization_code' => $accessData['authorization_code'],
            'access_token'       => $session->getAccessToken(),
            'refresh_token'      => $session->getRefreshToken(),
            'expires_at'         => now()->addSeconds($session->getTokenExpiration())->toDateTimeString(),
        ];

        $cacheFilePath = 'tokens/spotify.json';
        Storage::has($cacheFilePath) && Storage::delete($cacheFilePath);
        Storage::put($cacheFilePath, json_encode($data));

        return $data;
    }
}
