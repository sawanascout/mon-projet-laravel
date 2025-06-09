<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paniers extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
     ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }

  public function elements()
{
    return $this->hasMany(Elements_Paniers::class, 'paniers_id');
}
}
