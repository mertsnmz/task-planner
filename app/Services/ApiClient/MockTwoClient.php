<?php

namespace App\Services\ApiClient;

use Illuminate\Support\Facades\Http;

class MockTwoClient implements ApiClientInterface
{
    public function fetchTasks(): array
    {
        $response = Http::get('https://raw.githubusercontent.com/WEG-Technology/mock/main/mock-two');

        return $response->json();
    }
}
