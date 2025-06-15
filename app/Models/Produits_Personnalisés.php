<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitPersonnalise extends Model
{
    use HasFactory;

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
     * Relation : un produit personnalisé appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accesseur pour afficher un statut lisible.
     */
    public function getStatutLabelAttribute()
    {
        return match ($this->statut) {
            'pending' => 'En attente',
            'approved' => 'Approuvé',
            'rejected' => 'Rejeté',
            default => 'Inconnu',
        };
    }
}
