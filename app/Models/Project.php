<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\ProjectStatusEnum;

class Project extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'duration',
        'client_id',
        'company_id',
    ];

    protected $casts = [
        'duration' => 'integer',
        'status' => ProjectStatusEnum::class,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function tasks() : HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function calculateDuration() : void
    {
        // Calculate the sum of durations of all related tasks
        $totalDuration = $this->tasks()->sum('duration');

        // Update the project's duration
        $this->duration = $totalDuration;
        $this->save();
    }

    public function updateStatus() : void
    {
        $tasks = $this->tasks()->get();

        // Check if any task is pending
        $anyTaskPending = $tasks->contains(function ($task) {
            return $task->status === 'pending';
        });

        // Check if all tasks are done
        $allTasksDone = $tasks->every(function ($task) {
            return $task->status === 'done';
        });

        // Check if every task has failed
        $allTasksFailed = $tasks->every(function ($task) {
            return $task->status === 'failed';
        });

        // Update the project's status
        if ($anyTaskPending) {
            $this->status = 'pending';
        } elseif ($allTasksFailed) {
            $this->status = 'failed';
        } elseif ($allTasksDone) {
            $this->status = 'done';
        } else {
            $this->status = 'new';
        }

        $this->save();
    }
}
