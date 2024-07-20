<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    protected $fillable = ['developer_id', 'task_id', 'week', 'duration', 'provider'];

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Developer::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
