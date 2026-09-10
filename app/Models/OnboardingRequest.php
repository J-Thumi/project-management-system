<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OnboardingRequest extends Model
{
    use HasUuid;

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'project_type',
        'budget_min',
        'budget_max',
        'preferred_style',
        'inspiration_links',
        'additional_notes',
    ];

    protected $casts = [
        'budget_min' => 'decimal:2',
        'budget_max' => 'decimal:2',
        'inspiration_links' => 'array',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function plantPreferences(): HasMany
    {
        return $this->hasMany(OnboardingPlantPreference::class, 'onboarding_id');
    }
}