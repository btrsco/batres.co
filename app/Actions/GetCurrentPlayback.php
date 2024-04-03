<?php

namespace App\Actions;

use App\DataTransferObjects\CurrentPlaybackDto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIException;

class GetCurrentPlayback
{
    use AsAction;

    public function handle(): CurrentPlaybackDto
    {
        if (!Storage::has('tokens/spotify.json')) {
            return CurrentPlaybackDto::getRandom();
        }

        $accessData       = json_decode(Storage::get('tokens/spotify.json'), true);
        $accessExpiration = Carbon::parse($accessData['expires_at']);
        $api              = new SpotifyWebAPI();

        // Refresh the access token if it's about to expire
        if ($accessExpiration->isBefore(now()->addMinutes(5)) || $accessExpiration->isPast()) {
            $accessData = RefreshSpotifyAccessToken::run($accessData);
        }

        try {
            $api->setAccessToken($accessData['access_token']);
            $response = to_array($api->getMyCurrentPlaybackInfo());
        } catch (SpotifyWebAPIException $e) {
            ray($e)->red()->label('GetCurrentPlayback');

            if ($e->getMessage() === 'The access token expired') {
                $accessData = RefreshSpotifyAccessToken::run();
                $api->setAccessToken($accessData['access_token']);
                $response   = to_array($api->getMyCurrentPlaybackInfo());
                ray($response)->green()->label('GetCurrentPlayback (after refresh)');
            } else {
                $response = null;
            }
        }

        if (!$response) {
            return Cache::has('last-playback')
                ? CurrentPlaybackDto::fromResponse(Cache::get('last-playback'))
                : CurrentPlaybackDto::getRandom();
        }

        Cache::remember('current-playback', now()->addSeconds(30), fn() => $response);
        Cache::forever('last-playback', $response);

        return CurrentPlaybackDto::fromResponse($response);
    }
}
