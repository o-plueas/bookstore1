<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MarketingCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'book_id',
        'fb_campaign_id',
        'name',
        'status',
        'budget',
        'metrics'
    ];

    protected $casts = [
        'metrics' => 'array'
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}