<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product',
        'price',
        'store',
        'store_link',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
