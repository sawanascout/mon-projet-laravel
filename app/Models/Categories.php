<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
    ];

    /**
     * Relation : une catégorie a plusieurs produits.
     */
 public function produits()
{
    return $this->hasMany(Produits::class, 'category_id'); // ✅ clé étrangère correcte
}

    protected static function booted()
{
    static::saving(function ($category) {
        $category->slug = Str::slug($category->name);
    });
}
}
