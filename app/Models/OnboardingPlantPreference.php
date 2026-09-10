<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OnboardingPlantPreference extends Model
{
    use HasUuid;

    public $timestamps = false;

    protected $fillable = [
        'onboarding_id',
        'catalog_item_id',
        'custom_plant_name',
    ];

    public function onboardingRequest(): BelongsTo
    {
        return $this->belongsTo(OnboardingRequest::class, 'onboarding_id');
    }

    public function catalogItem(): BelongsTo
    {
        return $this->belongsTo(MasterItemCatalog::class, 'catalog_item_id');
    }
}