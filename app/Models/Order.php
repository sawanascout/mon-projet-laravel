<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'whatsapp_number', 'status', 'total','city','customer_name','commentaire','user_id','order_number','payment_method',
    ];

    // Une commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une commande contient plusieurs éléments de commande
    
    public function items()
{
    return $this->hasMany(OrderItem::class);
}

}
