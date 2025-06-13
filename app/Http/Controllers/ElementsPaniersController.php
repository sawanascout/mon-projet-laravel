<?php

namespace App\Http\Controllers;

use App\Models\Elements_Paniers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ElementsPaniersController extends Controller
{
public function update(Request $request, $id)
{
    $element = Elements_Paniers::findOrFail($id);

    if ($element->panier && $element->panier->user_id === Auth::id()) {
        $request->validate([
            'quantite' => 'required|integer|min:1|max:1000',
            // Si tu veux modifier aussi taille et couleur, tu peux les laisser en string :
            'taille' => 'nullable|string|max:255',
            'couleur' => 'nullable|string|max:255',
        ]);

        $element->quantite = $request->quantite;

        if ($request->filled('taille')) {
            $element->taille = $request->taille;
        }

        if ($request->filled('couleur')) {
            $element->couleur = $request->couleur;
        }

        $element->save();

        return redirect()->route('client.panier-index')->with('success', 'Quantité mise à jour.');
    }

    return redirect()->route('client.panier-index')->with('error', 'Accès refusé.');
}



    /**
     * Supprime un élément du panier.
     */
    public function destroy($id)
    {
        $element = Elements_Paniers::findOrFail($id);

        if ($element->panier->user_id !== Auth::id()) {
            abort(403);
        }

        $element->delete();

        return redirect()->route('client.panier-index')->with('success', 'Produit supprimé du panier.');
    }
}

