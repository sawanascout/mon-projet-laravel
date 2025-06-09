<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'commandes_id', 'montant', 'methode', 'statut',
    ];

    public function commande()
    {
        return $this->belongsTo(Commandes::class, 'commandes_id');
    }
}
