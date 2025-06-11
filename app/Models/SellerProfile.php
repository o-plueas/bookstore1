<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_name',
        'bio',
        'facebook_page',
        'website',
        'bank_account',
        'tax_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    
}