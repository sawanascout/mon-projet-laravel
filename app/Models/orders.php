<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'whatsapp_number', 'status', 'total','city','address','customer_name',
    ];

    // Une commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une commande contient plusieurs éléments de commande
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
