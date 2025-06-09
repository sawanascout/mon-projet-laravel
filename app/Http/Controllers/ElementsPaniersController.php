<?php

namespace App\Http\Controllers;

use App\Models\Elements_Paniers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ElementsPaniersController extends Controller
{
   public function update(Request $request, $id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $element = Elements_Paniers::findOrFail($id);

        // Vérifie que l’élément appartient bien au panier de l’utilisateur connecté
        if ($element->panier->user_id !== Auth::id()) {
            abort(403);
        }

        $element->quantite = $request->quantite;
        $element->save();

        return redirect()->route('client.panier-index')->with('success', 'Quantité mise à jour.');
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

