<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'payment_id',
        'status',
        'transaction_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'order_items')
                    ->withPivot('price')
                    ->withTimestamps();
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}