<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Produits;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    /**
     * Affiche la liste des avis pour un produit donné
     */
    public function index($produit_id)
    {
        $produit = Produits::findOrFail($produit_id);
        $avis = $produit->avis()->with('user')->get();

        return view('admin.avis-index', compact('produit', 'avis'));
    }

    /**
     * Affiche le formulaire de création d'un avis pour un produit
     */
    public function create($produit_id)
    {
        $produit = Produits::findOrFail($produit_id);
        return view('client.avis-create', compact('produit'));
    }

    /**
     * Enregistre un nouvel avis en base
     */
    public function store(Request $request, $produit_id)
    {
        if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour laisser un avis.');
    }
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string',
        ]);

        $produit = Produits::findOrFail($produit_id);

        Avis::updateOrCreate(
            [
                'produits_id' => $produit->id,
                'user_id' => Auth::id(),
            ],
            [
                'note' => $request->note,
                'commentaire' => $request->commentaire,
            ]
        );

        return redirect()->route('produits.show', $produit_id)
                         ->with('success', 'Votre avis a bien été enregistré.');
    }

    /**
     * Supprime un avis
     */
    public function destroy($id)
    {
        $avis = Avis::findOrFail($id);

        // Vérifie que l'utilisateur est le propriétaire de l'avis ou un admin
        if ($avis->user_id === Auth::id() || Auth::user()->role === 'admin') {
            $avis->delete();
            return back()->with('success', 'Avis supprimé.');
        }

        return back()->with('error', 'Action non autorisée.');
    }
}
