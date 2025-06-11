<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoriqueCommande extends Model
{
    use HasFactory;

    protected $table = 'historique_commandes';

    protected $fillable = [
        'user_id',
        'Numcommande',
        'NbrCategories',
        'NbrProduits',
        'prix',
    ];

    // Relation : une commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
