<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ligne_Commandes extends Model
{
    use HasFactory;

    protected $table = 'ligne_commandes'; 

    protected $fillable = [
        'commande_id',
        'produits_id',
        'couleur',
        'taille',
        'quantite',
        'prix',
    ];

    /**
     * Relation : cette ligne appartient à une commande
     */
    public function commande()
    {
        return $this->belongsTo(Commandes::class);
    }

    /**
     * Relation : cette ligne contient un produit
     */
    public function produit()
    {
        return $this->belongsTo(Produits::class);
    }
}


