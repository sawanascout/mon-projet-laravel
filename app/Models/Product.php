<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description','rating', 'price', 'image', 'available','category',
    ];

    // Un produit peut apparaître dans plusieurs éléments de commandes
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function reviews()
{
    return $this->hasMany(Review::class);
}

public function averageRating()
{
    return round($this->reviews()->avg('rating'), 1);
}
public function category()
{
    return $this->belongsTo(Category::class);
}


}
