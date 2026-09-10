<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuotationItem extends Model
{
    use HasUuid;

    public $timestamps = false;

    protected $fillable = [
        'quotation_id',
        'catalog_item_id',
        'item_name',
        'category',
        'supplier_name',
        'quantity_quoted',
        'quantity_installed',
        'unit_price',
    ];

    protected $casts = [
        'quantity_quoted' => 'decimal:2',
        'quantity_installed' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::saved(function (QuotationItem $item) {
            $item->quotation->recalculateTotal();
        });

        static::deleted(function (QuotationItem $item) {
            $item->quotation->recalculateTotal();
        });
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }

    public function catalogItem(): BelongsTo
    {
        return $this->belongsTo(MasterItemCatalog::class, 'catalog_item_id');
    }

    public function progressLogs(): HasMany
    {
        return $this->hasMany(ItemProgressLog::class, 'quotation_item_id');
    }
}