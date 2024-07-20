<?php

namespace App\Services\ApiClient;

use InvalidArgumentException;

class ApiClientFactory
{
    public function createClient(string $client): ApiClientInterface
    {
        return match ($client) {
            'mockOne' => new MockOneClient(),
            'mockTwo' => new MockTwoClient(),
            default => throw new InvalidArgumentException("Invalid client: $client"),
        };
    }
}
