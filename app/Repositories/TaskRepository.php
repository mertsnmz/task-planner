<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function getAllOrderedByDuration(): Collection
    {
        return $this->model->orderBy('estimated_duration', 'desc')->get();
    }

    public function updateOrCreate(array $attributes): Task
    {
        return $this->model->updateOrCreate(
            ['provider' => $attributes['provider'], 'external_id' => $attributes['external_id']],
            $attributes
        );
    }
}
