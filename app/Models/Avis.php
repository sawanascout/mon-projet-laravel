<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = 'avis';

    // Les champs modifiables en masse
    protected $fillable = [
        'produits_id',
        'user_id',
        'note',
        'commentaire',
    ];

    /**
     * Relation vers le produit concerné par l'avis
     */
    public function produit()
    {
        return $this->belongsTo(Produits::class);
    }

    /**
     * Relation vers l'utilisateur qui a posté l'avis
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
