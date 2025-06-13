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

public function profil()
{
    // 1. Récupérer l'utilisateur connecté
    $client = Auth::user();

    // 2. Vérifier que l'utilisateur est bien un client
    if (!$client || $client->role !== 'client') {
        abort(403, 'Accès refusé.');
    }

    // 3. Récupérer le panier (relation dans User)
    $panier = $client->panier;

    // 4. Récupérer les éléments du panier avec les produits
    $elements = $panier ? $panier->elements()->with('produit')->get() : collect();

    // 5. Récupérer les commandes du client avec les lignes et les produits
    $commandes = Commandes::where('user_id', $client->id)
        ->with('lignes.produit')
        ->latest()
        ->get();

    // 6. Retourner la vue avec les données
    return view('client.profil', compact('client', 'panier', 'elements', 'commandes'));
}



}
