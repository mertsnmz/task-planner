<?php

namespace App\Services\ApiClient;

interface ApiClientInterface
{
    public function fetchTasks(): array;
}
