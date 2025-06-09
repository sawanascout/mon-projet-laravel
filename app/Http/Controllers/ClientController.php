<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paniers;
use App\Models\ElementPaniers;
use App\Models\Produits;
use App\Models\Commandes;
use App\Models\Ligne_Commandes;

class ClientController extends Controller
{
    /**
     * Affiche le profil du client connecté.
     */
    public function profil()
{
    $client = Auth::user();

    if ($client->role !== 'client') {
        abort(403, 'Accès refusé.');
    }

    $panier = $client->panier; // Relation dans User

    $elements = $panier ? $panier->elements()->with('produit')->get() : collect();

    $commandes = Commandes::where('user_id', $client->id)
        ->with('lignes.produit')
        ->latest()
        ->get();

    return view('client.profil', compact('client', 'panier', 'elements', 'commandes'));
}

}
