<?php

namespace App\Console\Commands;

use App\Services\TaskService;
use Illuminate\Console\Command;

class FetchTasks extends Command
{
    protected $signature = 'tasks:fetch';

    protected $description = 'Fetch tasks from external APIs and save to database';

    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        parent::__construct();
        $this->taskService = $taskService;
    }

    public function handle(): void
    {
        $this->taskService->fetchTasks();
        $this->info('Tasks fetched successfully!');
    }
}
