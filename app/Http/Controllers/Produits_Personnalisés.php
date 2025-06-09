<?php

namespace App\Http\Controllers;

use App\Models\ProduitPersonnalise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProduitPersonnaliseController extends Controller
{
    /**
     * Affiche la liste des produits personnalisés de l'utilisateur connecté.
     */
    public function index()
    {
        $produits = ProduitPersonnalise::where('user_id', Auth::id())->latest()->get();
        return view('produits_personnalises.index', compact('produits'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        return view('produits_personnalises.create');
    }

    /**
     * Enregistre un nouveau produit personnalisé.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'genre' => 'required|string|max:50',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits_personnalises', 'public');
        }

        ProduitPersonnalise::create([
            'user_id' => Auth::id(),
            'nom_complet' => $request->nom_complet,
            'genre' => $request->genre,
            'description' => $request->description,
            'image' => $imagePath,
            'statut' => 'en attente', // Par défaut
        ]);

        return redirect()->route('client.profil')->with('success', 'Produit personnalisé créé avec succès.');
    }

    /**
     * Affiche un produit personnalisé.
     */
    public function show($id)
    {
        $produit = ProduitPersonnalise::findOrFail($id);

        if ($produit->user_id !== Auth::id()) {
            abort(403);
        }

        return view('produits_personnalises.show', compact('produit'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit($id)
    {
        $produit = ProduitPersonnalise::findOrFail($id);

        if ($produit->user_id !== Auth::id()) {
            abort(403);
        }

        return view('produits_personnalises.edit', compact('produit'));
    }

    /**
     * Mise à jour d'un produit personnalisé.
     */
    public function update(Request $request, $id)
    {
        $produit = ProduitPersonnalise::findOrFail($id);

        if ($produit->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'genre' => 'required|string|max:50',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }
            $produit->image = $request->file('image')->store('produits_personnalises', 'public');
        }

        $produit->update([
            'nom_complet' => $request->nom_complet,
            'genre' => $request->genre,
            'description' => $request->description,
        ]);

        return redirect()->route('produits_personnalises.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprimer un produit personnalisé.
     */
    public function destroy($id)
    {
        $produit = ProduitPersonnalise::findOrFail($id);

        if ($produit->user_id !== Auth::id()) {
            abort(403);
        }

        if ($produit->image) {
            Storage::disk('public')->delete($produit->image);
        }

        $produit->delete();

        return redirect()->route('produits_personnalises.index')->with('success', 'Produit supprimé avec succès.');
    }
}
