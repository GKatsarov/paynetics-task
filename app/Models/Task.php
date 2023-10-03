<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'duration',
        'project_id',
    ];

    protected static function boot() : void
    {
        parent::boot();

        static::saved(function ($task) {
            $task->updateProjectStatusAndTime();
        });

        static::deleted(function ($task) {
            $task->updateProjectStatusAndTime();
        });
    }

    public function updateProjectStatusAndTime() : void
    {
        // Retrieve the associated project for this task
        $project = $this->project;

        // Update project status and time based on tasks
        if ($project) {
            // Update project status logic based on tasks
            $project->updateStatus();
            // Update project status and time
            $project->calculateDuration();
        }
    }

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    function minutesToHoursMinutes($minutes) : string
    {
        // Calculate hours and minutes
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        // Format as HH:mm
        $formattedTime = sprintf('%02d:%02d', $hours, $remainingMinutes);

        return $formattedTime;
    }
}
