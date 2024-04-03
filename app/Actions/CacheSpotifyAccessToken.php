<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

class CacheSpotifyAccessToken
{
    use AsAction;

    public function handle($code): array
    {
        $session = new Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
            config('services.spotify.redirect')
        );

        $api = new SpotifyWebAPI();

        $session->requestAccessToken($code);
        $api->setOptions(['auto_refresh' => true]);
        $api->setAccessToken($session->getAccessToken());

        $data = [
            'authorization_code' => $code,
            'access_token'       => $session->getAccessToken(),
            'refresh_token'      => $session->getRefreshToken(),
            'expires_at'         => Carbon::parse($session->getTokenExpiration())->toDateTimeString(),
        ];

        $cacheFilePath = 'tokens/spotify.json';

        if (Storage::has($cacheFilePath)) {
            $startOfHour = now()->startOfHour()->toDateTimeString();
            Storage::move($cacheFilePath, "tokens/backup/spotify-$startOfHour.json");
            Storage::delete($cacheFilePath);
        }

        Storage::put($cacheFilePath, json_encode($data));

        return $data;
    }
}
