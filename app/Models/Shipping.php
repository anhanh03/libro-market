<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'method',
        'tracking_number',
        'status',
        'estimated_delivery_date',
    ];

    protected $casts = [
        'estimated_delivery_date' => 'date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
