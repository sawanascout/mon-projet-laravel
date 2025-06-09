<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    protected $table = 'produits';

    // Champs modifiables en masse
    protected $fillable = [
        'nom',
        'prix',
        'ancien_prix',
        'description',
        'categories_id',
        'photo',
        'disponible',
    ];

    /**
     * Relation vers la catégorie du produit
     */

    /**
     * Optionnel : si tu veux récupérer les avis liés au produit
     */
    public function avis()
    {
        return $this->hasMany(Avis::class, 'produits_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }

    /**
     * Relation : un produit peut apparaître dans plusieurs lignes de commande.
     */
    public function lignes_Commande()
    {
        return $this->hasMany(Ligne_Commandes::class);
    }

    public function Elements()
    {
        return $this->hasMany(Elements_Paniers::class);
    }

    /**
     * Relation : un produit peut être présent dans plusieurs paniers.
     */
    public function paniers()
    {
        return $this->hasMany(Paniers::class);
    }
}
