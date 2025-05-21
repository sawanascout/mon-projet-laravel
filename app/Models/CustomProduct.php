<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomProduct extends Model
{
        protected $fillable = ['fullname', 'gender', 'description', 'image_path', 'status',];

    // Un produit personnalisé appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
