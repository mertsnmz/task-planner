<?php

namespace App\Console\Commands;

use App\Services\TaskService;
use Illuminate\Console\Command;

class PlanTasks extends Command
{
    protected $signature = 'tasks:plan';

    protected $description = 'Plan tasks for developers to complete in the shortest time';

    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        parent::__construct();
        $this->taskService = $taskService;
    }

    public function handle(): void
    {
        $weeks = $this->taskService->planTasks();
        $this->info("All tasks are planned to be completed in {$weeks} weeks.");
    }
}
