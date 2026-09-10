<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasUuid;

    protected $fillable = [
        'title',
        'client_id',
        'designer_id',
        'supervisor_id',
        'property_address',
        'property_size_sqm',
        'status',
    ];

    protected $casts = [
        'property_size_sqm' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function designer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function onboardingRequest(): HasOne
    {
        return $this->hasOne(OnboardingRequest::class, 'project_id');
    }

    public function stages(): HasMany
    {
        return $this->hasMany(ProjectStage::class, 'project_id')->orderBy('sequence_order');
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class, 'project_id');
    }

    public function dailyLogs(): HasMany
    {
        return $this->hasMany(DailyLog::class, 'project_id');
    }
}