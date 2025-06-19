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

    public function remove($id)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            unset($panier[$id]);
            session(['panier' => $panier]);
        }

        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier.');
    }

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

    public function clear()
    {
        session()->forget('panier');
        return redirect()->route('cart.index')->with('success', 'Panier vidé.');
    }

}
