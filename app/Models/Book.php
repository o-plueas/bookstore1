<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seller_id',
        'category_id',
        'title',
        'slug',
        'description',
        'price',
        'cover_image',
        'file_path',
        'download_count',
        'featured'
    ];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items')
                    ->withPivot('price')
                    ->withTimestamps();
    }
}