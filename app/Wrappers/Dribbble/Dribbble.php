<?php

namespace App\Wrappers\Dribbble;

use Exception;
use Illuminate\Support\Facades\Http;

class Dribbble
{
    public string  $url         = 'https://api.dribbble.com/v2';
    public string  $tokenUrl    = 'https://dribbble.com/oauth/token';
    public ?string $accessToken = null;

    public function __construct(
        public string $clientId,
        public string $clientSecret,
        public string $redirectUri,
    ) {}

    public function getAccessToken(string $authCode): array
    {
        return $this->post($this->tokenUrl, [
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code'          => $authCode,
        ]);
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @throws Exception
     */
    public function getShots(): array
    {
        if ( ! $this->accessToken) {
            throw new Exception('Access token is required to fetch shots');
        }

        return $this->get($this->url . '/user/shots');
    }

    private function get(string $url, array $query = []): array
    {
        $url = ! empty($query) ? $url . '?' . http_build_query($query) : $url;

        return $this->request('GET', $url);
    }

    private function post(string $url, array $data): array
    {
        return $this->request('POST', $url, $data);
    }

    /**
     * @throws Exception
     */
    private function request(string $method, string $url, array $data = []): array
    {
        $headers = [
            'Accept' => 'application/json',
        ];

        if ($this->accessToken) {
            $headers['Authorization'] = 'Bearer ' . $this->accessToken;
        }

        $response = Http::withHeaders($headers)
            ->$method(
                $url,
                $data
            );

        if ($response->failed()) {
            throw new Exception('Failed to fetch data from Dribbble API');
        }

        return $response->json();
    }
}
