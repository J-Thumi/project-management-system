<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemProgressLog extends Model
{
    use HasUuid;

    public $timestamps = false;

    protected $fillable = [
        'daily_log_id',
        'quotation_item_id',
        'quantity_added',
    ];

    protected $casts = [
        'quantity_added' => 'decimal:2',
    ];

    public function dailyLog(): BelongsTo
    {
        return $this->belongsTo(DailyLog::class, 'daily_log_id');
    }

    public function quotationItem(): BelongsTo
    {
        return $this->belongsTo(QuotationItem::class, 'quotation_item_id');
    }
}