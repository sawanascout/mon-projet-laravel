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
        $panier = session()->get('panier', []);
        return view('cart.panier', compact('panier'));
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

        return redirect()->route('cart.panier')->with('success', 'Produit ajouté au panier.');
    }

    /**
     * Met à jour la quantité d’un élément.
     */
    public function update(Request $request, $id)
    {
         $quantite = max((int) $request->input('quantite', 1), 1);

        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            $panier[$id]['quantite'] = $quantite;
            session(['panier' => $panier]);
        }

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour.');
    }

    /**
     * Supprime un élément du panier.
     */
    public function clear()
    {
        session()->forget('panier');
        return redirect()->route('cart.index')->with('success', 'Panier vidé.');
    }

    /**
     * Vide tout le panier.
     */
    public function remove($id)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            unset($panier[$id]);
            session(['panier' => $panier]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier.');
    }
    public function add(Request $request, $id)
    {
        $produit = Produits::findOrFail($id);
        $quantite = max((int) $request->input('quantite', 1), 1);

        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            $panier[$id]['quantite'] += $quantite; // Incrémente
        } else {
            $panier[$id] = [
                'nom' => $produit->nom,
                'prix' => $produit->prix,
                'quantite' => $quantite,
                'photo' => $produit->photo ?? null,
            ];
        }

        session(['panier' => $panier]); // Sauvegarde propre

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier.');
    }

}
