<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paniers;
use App\Models\Elements_Paniers;
use App\Models\Produits;

class PaniersController extends Controller
{
    /**
     * Affiche le panier de l'utilisateur connecté.
     */
    public function index()
    {
        $user = Auth::user();
        $panier = Paniers::firstOrCreate(['user_id' => $user->id]);
        $elements = $panier->elements()->with('produit')->get();

        return view('client.panier-index', compact('elements', 'panier'));
    }

    /**
     * Ajoute un produit au panier.
     */
    public function store(Request $request, $produit_id)
    {
        $user = Auth::user();
        $panier = Paniers::firstOrCreate(['user_id' => $user->id]);
        $request->validate([
        'couleur' => 'required|string',
        'quantite' => 'required|numeric|max:1000',
        'taille'=> 'required|string|max:1000',
        ]);

        $produit = Produits::findOrFail($produit_id);

        $element = Elements_Paniers::where('paniers_id', $panier->id)
            ->where('produits_id', $produit->id)
            ->first();

        if ($element) {
            $element->quantite += 1;
            $element->save();
        } else {
            Elements_Paniers::create([
                'paniers_id' => $panier->id,
                'produits_id' => $produit->id,
                'couleur' =>$request->couleur,
                'taille' =>$request->taille,
                'quantite' =>$request->quantite,
                'prix' => $produit->prix,
            ]);
        }

        return redirect()->route('client.panier-index')->with('success', 'Produit ajouté au panier.');
    }

    /**
     * Supprime un produit du panier.
     */
    public function supprimer($id)
    {
        $element = Elements_Paniers::findOrFail($id);

        if ($element->panier->user_id === Auth::id()) {
            $element->delete();
            return redirect()->route('client.panier-index')->with('success', 'Produit retiré du panier.');
        }

         return redirect()->route('client.panier-index')->with('error', 'Accès refusé.');

    }/**
     * Vide le panier de l'utilisateur.
     */

    public function vider()
    {
        $user = Auth::user();
        $panier = Paniers::where('user_id', $user->id)->first();

        if ($panier) {
            $panier->elements()->delete();
        }

        return redirect()->route('client.panier-index')->with('success', 'Panier vidé.');
    }
    
    public function mettreAJourQuantite(Request $request, $id)
    {
        $element = Elements_Paniers::findOrFail($id);
        $userId = Auth::id();

        if ($element->panier->user_id !== $userId) {
            return redirect()->route('client.panier-index')->with('error', 'Accès refusé.');
        }

        $quantite = max((int) $request->input('quantite', 1), 1);
        $element->quantité = $quantite;
        $element->prix = $element->produit->prix * $quantite; // Met à jour prix total pour cet élément
        $element->save();

        return redirect()->route('client.panier-index')->with('success', 'Quantité mise à jour.');
    }
}
