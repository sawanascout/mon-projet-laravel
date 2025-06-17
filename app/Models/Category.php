<?php
namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name'];

    public function products()
    {
        return $this->hasMany(Produits::class);
    }

protected static function booted()
{
    static::saving(function ($category) {
        $category->slug = Str::slug($category->name);
    });
}

}

