<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Developer extends Model
{
    protected $fillable = ['name', 'efficiency'];

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }
}
