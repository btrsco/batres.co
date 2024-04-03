<?php

namespace App\Actions;

use App\Wrappers\Dribbble\Dribbble;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class CacheDribbbleAccessToken
{
    use AsAction;

    public function handle(string $code): array
    {
        $cacheFilePath = 'tokens/dribbble.json';

        if (Storage::exists($cacheFilePath)) {
            return json_decode(Storage::get($cacheFilePath), true);
        }

        $dribbbleApi = new Dribbble(
            clientId: config('services.dribbble.client_id'),
            clientSecret: config('services.dribbble.client_secret'),
            redirectUri: config('services.dribbble.redirect'),
        );

        $accessData = $dribbbleApi->getAccessToken($code);

        $data = [
            'authorization_code' => $code,
            'access_token'       => $accessData['access_token'],
            'created_at'         => Carbon::parse($accessData['created_at'])->toDateTimeString(),
            'token_type'         => $accessData['token_type'],
            'scope'              => $accessData['scope'],
        ];

        if (Storage::has($cacheFilePath)) {
            Storage::delete($cacheFilePath);
        }

        Storage::put($cacheFilePath, json_encode($data));

        return $data;
    }
}
