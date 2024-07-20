<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(): View|Factory|Application
    {
        $developersWithAssignments = $this->taskService->getDevelopersWithAssignments();

        return view('tasks.index', [
            'developers' => $developersWithAssignments,
        ]);
    }
}
