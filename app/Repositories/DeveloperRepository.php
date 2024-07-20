<?php

namespace App\Repositories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Collection;

class DeveloperRepository extends BaseRepository
{
    public function __construct(Developer $model)
    {
        parent::__construct($model);
    }

    public function getDevelopersWithAssignments(): Collection
    {
        return $this->model->with('assignments.task')->get();
    }
}
