<?php

namespace App\Actions;

use App\DataTransferObjects\CurrentPlaybackDto;
use App\Wrappers\Dribbble\Dribbble;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIException;

class GetRecentShots
{
    use AsAction;

    /**
     * @throws Exception
     */
    public function handle(): array
    {
        $cacheFilePath = 'fallback-shots.json';

        if (Storage::exists($cacheFilePath)) {
            $data = json_decode(Storage::get($cacheFilePath), true);

            if (Carbon::parse($data['last_updated'])->diffInHours() < 24) {
                return $data['shots'];
            }
        }

        $accessData       = json_decode(Storage::get('tokens/dribbble.json'), true);
        $api = new Dribbble(
            clientId: config('services.dribbble.client_id'),
            clientSecret: config('services.dribbble.client_secret'),
            redirectUri: config('services.dribbble.redirect'),
        );

        $api->setAccessToken($accessData['access_token']);

        $response = $api->getShots();

        $data = [
            'shots' => $response,
            'last_updated' => Carbon::now()->toDateTimeString(),
        ];

        if (Storage::has($cacheFilePath)) {
            Storage::delete($cacheFilePath);
        }

        Storage::put($cacheFilePath, json_encode($data));

        return $response;
    }
}
