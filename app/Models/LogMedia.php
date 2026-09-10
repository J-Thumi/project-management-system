<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogMedia extends Model
{
    use HasUuid;

    protected $table = 'log_media';
    public $timestamps = false;

    protected $fillable = [
        'daily_log_id',
        'project_id',
        'uploaded_by_user_id',
        'media_type',
        'file_url',
        'is_render_comparison_source',
    ];

    protected $casts = [
        'is_render_comparison_source' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (LogMedia $media) {
            if ($media->dailyLog) {
                $media->project_id = $media->dailyLog->project_id;
                $media->uploaded_by_user_id = $media->uploaded_by_user_id ?? $media->dailyLog->supervisor_id ?? auth()->id();
            }
        });
    }

    public function dailyLog(): BelongsTo
    {
        return $this->belongsTo(DailyLog::class, 'daily_log_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by_user_id');
    }
}