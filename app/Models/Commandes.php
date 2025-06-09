<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandes extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'statut',
        'city',
        'commentaire',
        'total',
        'methode_paiement',
    ];

    /**
     * Une commande appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Une commande a plusieurs lignes (produits commandés).
     */
    public function lignes()
    {
        return $this->hasMany(Ligne_Commandes::class);
    }
    public function paiement()
{
    return $this->hasOne(Paiement::class, 'commandes_id');
}

}
