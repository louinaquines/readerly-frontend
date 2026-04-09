<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class ApiService
{
    protected string $baseUrl;
    protected ?string $token = null;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
    }

    public function login(string $email, string $password): array
    {
        try {
            $response = Http::post("{$this->baseUrl}/api/auth/login", [
                'email'    => $email,
                'password' => $password,
            ]);

            return $response->json() ?? [];
        } catch (ConnectionException) {
            return ['message' => 'Unable to reach the API server. Please try again later.'];
        }
    }

    public function register(array $data): array
    {
        try {
            $response = Http::post("{$this->baseUrl}/api/auth/register", $data);
            return $response->json() ?? [];
        } catch (ConnectionException) {
            return ['message' => 'Unable to reach the API server. Please try again later.'];
        }
    }

    public function withToken(string $token): static
    {
        $this->token = $token;
        return $this;
    }

    public function get(string $endpoint): array
    {
        try {
            return Http::withToken($this->token ?? '')
                ->get("{$this->baseUrl}/{$endpoint}")
                ->json() ?? [];
        } catch (ConnectionException) {
            return ['message' => 'Unable to reach the API server.'];
        }
    }

    public function post(string $endpoint, array $data): array
    {
        try {
            return Http::withToken($this->token ?? '')
                ->post("{$this->baseUrl}/{$endpoint}", $data)
                ->json() ?? [];
        } catch (ConnectionException) {
            return ['message' => 'Unable to reach the API server.'];
        }
    }

    public function delete(string $endpoint): array
    {
        try {
            return Http::withToken($this->token ?? '')
                ->delete("{$this->baseUrl}/{$endpoint}")
                ->json() ?? [];
        } catch (ConnectionException) {
            return [];
        }
    }
}