<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    protected $table = 'produits';
    protected $casts = [
    'taille' => 'array',
    'couleur' => 'array',
];


    // Champs modifiables en masse
    protected $fillable = [
        'nom',
        'prix',
        'ancien_prix',
        'description',
        'categories_id',
        'photo',
        'disponible',
         'taille',
    'couleur',
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
    // Toujours retourner un tableau pour 'taille'
public function getTailleAttribute($value)
{
    return is_array($value) ? $value : json_decode($value, true);
}

// Toujours retourner un tableau pour 'couleur'
public function getCouleurAttribute($value)
{
    return is_array($value) ? $value : json_decode($value, true);
}
// App\Models\Produits.php



}
