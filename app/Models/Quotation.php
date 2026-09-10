<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Quotation extends Model
{
    use HasUuid;

    protected $fillable = [
        'project_id',
        'version_number',
        'status',
        'total_amount',
        'created_by_user_id',
    ];

    protected $casts = [
        'version_number' => 'integer',
        'total_amount' => 'decimal:2',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class, 'quotation_id');
    }
    /**
     * Recalculate and persist the sum of all item prices.
     */
    public function recalculateTotal(): void
    {
        // DB generated stored column: quantity_quoted * unit_price
        $total = $this->items()->sum(DB::raw('quantity_quoted * unit_price'));

        $this->updateQuietly([
            'total_amount' => $total,
        ]);
    }
}