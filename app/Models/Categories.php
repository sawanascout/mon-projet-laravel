<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    /**
     * Relation : une catégorie a plusieurs produits.
     */
    public function produits()
    {
        return $this->hasMany(Produits::class);
    }
}
