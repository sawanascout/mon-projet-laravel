<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Commandes;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Liste tous les paiements (optionnel pour admin).
     */
    public function index()
    {
        $paiements = Paiement::with('commande')->latest()->get();
        return view('admin.paiements.index', compact('paiements'));
    }

    /**
     * Formulaire de paiement (optionnel si besoin d’un écran dédié).
     */
    public function create($commande_id)
    {
        $commande = Commandes::findOrFail($commande_id);
        return view('client.paiements.create', compact('commande'));
    }

    /**
     * Enregistrement du paiement.
     */
    public function store(Request $request)
    {
        $request->validate([
            'commandes_id' => 'required|exists:commandes,id',
            'montant' => 'required|numeric|min:0',
            'methode' => 'required|string|max:50',
        ]);

        $paiement = Paiement::create([
            'commandes_id' => $request->commandes_id,
            'montant' => $request->montant,
            'methode' => $request->methode,
            'statut' => 'en attente', // ou 'réussi', selon le traitement
        ]);

        return redirect()->route('client.commandes.show', $request->commandes_id)
                         ->with('success', 'Paiement enregistré avec succès.');
    }

    /**
     * Affichage d’un paiement spécifique.
     */
    public function show($id)
    {
        $paiement = Paiement::with('commande')->findOrFail($id);
        return view('admin.paiements.show', compact('paiement'));
    }

    /**
     * Modifier un paiement (si manuel).
     */
    public function edit($id)
    {
        $paiement = Paiement::findOrFail($id);
        return view('admin.paiements.edit', compact('paiement'));
    }

    /**
     * Mise à jour du paiement.
     */
    public function update(Request $request, $id)
    {
        $paiement = Paiement::findOrFail($id);

        $request->validate([
            'montant' => 'required|numeric|min:0',
            'methode' => 'required|string|max:50',
            'statut' => 'required|string|in:en attente,réussi,échoué',
        ]);

        $paiement->update($request->only('montant', 'methode', 'statut'));

        return redirect()->route('admin.paiements.index')->with('success', 'Paiement mis à jour.');
    }

    /**
     * Supprimer un paiement (facultatif).
     */
    public function destroy($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->back()->with('success', 'Paiement supprimé.');
    }
}

