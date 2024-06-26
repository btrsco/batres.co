<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CurrentPlaybackDto
{
    public function __construct(
        public string $name,
        public string $artist,
        public string $album,
        public ?string $url,
        public int $progress,
        public bool $isPlaying,
        public ?bool $isExplicit,
    ) {
        // ...
    }

    public static function fromResponse(array $response = null): self
    {
        try {
            return new self(
                $response['item']['name'],
                $response['item']['artists'][0]['name'],
                $response['item']['album']['name'],
                $response['item']['external_urls']['spotify'],
                $response['progress_ms'],
                $response['is_playing'],
                $response['item']['explicit'] ?? true
            );
        } catch (\Throwable $e) {
            return self::getRandom();
        }
    }

    public static function getRandom(): self
    {
        if (Cache::has('random-playback')) {
            $randomSong = Cache::get('random-playback');
        } else {
            $fallback    = Storage::get('fallback-songs.json');
            $randomSongs = collect(json_decode($fallback, true));
            $randomSong  = $randomSongs->random();

            Cache::put('random-playback', $randomSong, now()->addMinutes(5));
        }

        return new self(
            $randomSong['name'],
            $randomSong['artist'],
            $randomSong['album'],
            $randomSong['url'] ?? null,
            0,
            false,
            $randomSong['is_explicit'] ?? false
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'artist'      => $this->artist,
            'album'       => $this->album,
            'url'         => $this->url,
            'progress'    => $this->progress,
            'is_playing'  => $this->isPlaying,
            'is_explicit' => $this->isExplicit,
        ];
    }
}
