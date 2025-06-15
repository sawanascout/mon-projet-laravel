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
        $panier = Paniers::where('user_id', $user->id)->first();

        $elements = $panier ? $panier->elements()->with('produit')->get() : collect();

        $total = $elements->reduce(function ($carry, $element) {
            return $carry + ($element->prix * $element->quantite);
        }, 0);

        return view('client.panier-index', compact('elements', 'total'));
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
            'taille' => 'required|string',
            'quantite' => 'required|integer|min:1|max:1000',
        ]);

        $produit = Produits::findOrFail($produit_id);

        $element = Elements_Paniers::where([
            ['paniers_id', $panier->id],
            ['produits_id', $produit->id],
            ['couleur', $request->couleur],
            ['taille', $request->taille],
        ])->first();

        if ($element) {
            $element->quantite += $request->quantite;
            $element->prix = $produit->prix * $element->quantite;
            $element->save();
        } else {
            Elements_Paniers::create([
                'paniers_id'   => $panier->id,
                'produits_id'  => $produit->id,
                'couleur'      => $request->couleur,
                'taille'       => $request->taille,
                'quantite'     => $request->quantite,
                'prix'         => $produit->prix * $request->quantite,
            ]);
        }

        return redirect()->route('client.panier-index')->with('success', 'Produit ajouté au panier.');
    }

    /**
     * Met à jour la quantité d’un élément.
     */
    public function update(Request $request, $id)
    {
        $element = Elements_Paniers::with('panier')->findOrFail($id);

        if ($element->panier->user_id !== Auth::id()) {
            return redirect()->route('client.panier-index')->with('error', 'Accès refusé.');
        }

        $request->validate([
            'quantite' => 'required|integer|min:1|max:1000',
        ]);

        $element->quantite = $request->quantite;
        $element->prix = $element->produit->prix * $request->quantite;
        $element->save();

        return redirect()->route('client.panier-index')->with('success', 'Quantité mise à jour.');
    }

    /**
     * Supprime un élément du panier.
     */
    public function supprimer($id)
    {
        $element = Elements_Paniers::with('panier')->findOrFail($id);

        if ($element->panier->user_id === Auth::id()) {
            $element->delete();
            return redirect()->route('client.panier-index')->with('success', 'Produit retiré du panier.');
        }

        return redirect()->route('client.panier-index')->with('error', 'Accès refusé.');
    }

    /**
     * Vide tout le panier.
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
}
