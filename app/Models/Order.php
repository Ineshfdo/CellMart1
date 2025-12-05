<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'delivery_address',
        'products',
        'total_amount',
        'currency',
        'status'
    ];

    protected $casts = [
        'products' => 'array',
    ];

    /**
     * Get the user that owns the order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
