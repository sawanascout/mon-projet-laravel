<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elements_Paniers extends Model
{
    use HasFactory;
    protected $table = 'elements_paniers'; 

    protected $fillable = [
        'paniers_id',
        'produits_id',
        'couleur',
        'taille',
        'quantite',
        'prix',
    ];

    /**
     * Relation : l'élément appartient à un panier
     */
    public function panier()
    {
        return $this->belongsTo(Paniers::class);
    }

    /**
     * Relation : l'élément correspond à un produit
     */
    public function produit()
    {
        return $this->belongsTo(Produits::class);
    }
}
