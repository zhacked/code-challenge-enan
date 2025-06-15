<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;

class RandomUserApiService
{
    public function fetch(int $count = 100, string $nationality = 'AU'): array
    {
        $response = Http::get(config('services.randomuser.url'), [
            'results' => config('services.randomuser.results'),
            'nat' => config('services.randomuser.nat'),
        ]);

        return $response->json('results') ?? [];
    }
}
