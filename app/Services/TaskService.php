<?php

namespace App\Services;

use App\Repositories\AssignmentRepository;
use App\Repositories\DeveloperRepository;
use App\Repositories\TaskRepository;
use App\Services\ApiClient\ApiClientFactory;

class TaskService
{
    protected TaskRepository $taskRepository;

    protected AssignmentRepository $assignmentRepository;

    protected DeveloperRepository $developerRepository;

    protected ApiClientFactory $apiClientFactory;

    public function __construct(
        TaskRepository $taskRepository,
        AssignmentRepository $assignmentRepository,
        DeveloperRepository $developerRepository,
        ApiClientFactory $apiClientFactory
    ) {
        $this->taskRepository = $taskRepository;
        $this->assignmentRepository = $assignmentRepository;
        $this->developerRepository = $developerRepository;
        $this->apiClientFactory = $apiClientFactory;
    }

    public function fetchTasks(): void
    {
        $clients = ['mockOne', 'mockTwo'];

        foreach ($clients as $clientName) {
            $client = $this->apiClientFactory->createClient($clientName);
            $tasks = $client->fetchTasks();

            foreach ($tasks as $task) {
                $attributes = [
                    'provider' => $clientName,
                    'external_id' => $task['id'] ?? $task['task_id'],
                    'value' => $task['value'] ?? $task['zorluk'],
                    'estimated_duration' => $task['estimated_duration'] ?? $task['sure'],
                ];
                $this->taskRepository->updateOrCreate($attributes);
            }
        }
    }

    public function planTasks(): int
    {
        $developers = $this->developerRepository->all()->toArray();
        $tasks = $this->taskRepository->getAllOrderedByDuration()->toArray();
        $maxWeeklyHours = 45;
        $week = 1;

        usort($tasks, function ($a, $b) {
            return ($b['value'] * $b['estimated_duration']) - ($a['value'] * $a['estimated_duration']);
        });

        foreach ($tasks as $task) {
            usort($developers, function ($a, $b) {
                return $this->getTotalDuration($a) - $this->getTotalDuration($b);
            });

            foreach ($developers as &$developer) {
                $adjustedDuration = ($task['value'] * $task['estimated_duration']) / $developer['efficiency'];
                $adjustedDuration = round($adjustedDuration, 2);

                if ($this->getTotalDuration($developer) + $adjustedDuration <= $maxWeeklyHours) {
                    $this->assignmentRepository->create([
                        'developer_id' => $developer['id'],
                        'task_id' => $task['id'],
                        'week' => $week,
                        'duration' => $adjustedDuration,
                        'provider' => $task['provider'],
                    ]);

                    if (! isset($developer['assignments'])) {
                        $developer['assignments'] = [];
                    }
                    $developer['assignments'][] = ['duration' => $adjustedDuration];

                    break;
                }
            }
        }

        return $week;
    }

    private function getTotalDuration($developer): float
    {
        $total = 0;
        if (isset($developer['assignments'])) {
            foreach ($developer['assignments'] as $assignment) {
                $total += $assignment['duration'];
            }
        }

        return $total;
    }

    public function getDevelopersWithAssignments(): array
    {
        return $this->developerRepository->getDevelopersWithAssignments()->toArray();
    }
}
