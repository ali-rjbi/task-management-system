<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = false;

    public function task(): HasOne
    {
        return $this->hasOne(Task::class, 'status_id');
    }
}
