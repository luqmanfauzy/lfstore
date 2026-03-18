<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'date',
        'customer_name',
        'total_purchases',
        'shipping_cost',
        'payment_method',
        'discount_name',
        'discount_nominal',
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
