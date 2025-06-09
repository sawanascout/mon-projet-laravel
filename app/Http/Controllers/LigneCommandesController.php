<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ligne_Commandes;
use App\Models\Commandes;
use App\Models\Produits;

class LigneCommandesController extends Controller
{
    /**
     * Affiche toutes les lignes d'une commande spécifique (pour admin ou client).
     */
    public function index($commandeId)
    {
        $lignes = Ligne_Commandes::where('commandes_id', $commandeId)->with('produit')->get();

        return view('commandes.lignes-index', compact('lignes', 'commandeId'));
    }

    /**
     * Affiche une ligne spécifique.
     */
    public function show($id)
    {
        $ligne = Ligne_Commandes::with('produit')->findOrFail($id);

        return view('commandes.lignes-show', compact('ligne'));
    }

    /**
     * Formulaire de création (optionnel, pour usage admin par exemple).
     */

}
