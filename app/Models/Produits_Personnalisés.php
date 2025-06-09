<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitPersonnalise extends Model
{
    protected $table = 'produits_personnalises';

    protected $fillable = [
        'user_id',
        'nom_complet',
        'genre',
        'image',
        'description',
        'statut',
    ];

    /**
     * Relation vers l'utilisateur ayant créé le produit personnalisé
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

