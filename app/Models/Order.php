<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_time',
        'total',
        'paid',
        'delivery',
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'total' => 'decimal:2',
        'paid' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getFormattedDateAttribute()
    {
        return $this->date_time->format('M d, Y H:i');
    }
}
