<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'unit_price',
    ];

    // Un élément de commande appartient à une commande
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Un élément de commande correspond à un produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
