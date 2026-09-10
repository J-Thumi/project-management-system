<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterItemCatalog extends Model
{
    use HasUuid;

    protected $table = 'master_items_catalog';
    public $timestamps = false;

    protected $fillable = [
        'category',
        'common_name',
        'botanical_name',
        'sun_requirements',
        'water_needs',
        'mature_size',
        'unit_of_measure',
        'default_unit_price',
        'Supplier_name',
    ];

    protected $casts = [
        'default_unit_price' => 'decimal:2',
    ];

    public function quotationItems(): HasMany
    {
        return $this->hasMany(QuotationItem::class, 'catalog_item_id');
    }
}