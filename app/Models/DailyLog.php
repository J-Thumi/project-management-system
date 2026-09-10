<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DailyLog extends Model
{
    use HasUuid;

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'supervisor_id',
        'log_date',
        'summary_notes',
    ];

    protected $casts = [
        'log_date' => 'date',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(LogMedia::class, 'daily_log_id');
    }

    public function itemProgressLogs(): HasMany
    {
        return $this->hasMany(ItemProgressLog::class, 'daily_log_id');
    }
}