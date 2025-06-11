<?php

namespace App\Http\Controllers;

use App\Models\HistoriqueCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriqueCommandesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $commandes = HistoriqueCommande::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('admin.commandes-historique', compact('commandes'));
    }

    // Enregistrer une nouvelle commande dans l'historique
    public function store(Request $request)
    {
        $request->validate([
            'Numcommande' => 'required|string',
            'NbrCategories' => 'required|string',
            'NbrProduits' => 'required|string',
            'prix' => 'required|numeric',
        ]);

        HistoriqueCommande::create([
            'user_id' => Auth::id(),
            'Numcommande' => $request->Numcommande,
            'NbrCategories' => $request->NbrCategories,
            'NbrProduits' => $request->NbrProduits,
            'prix' => $request->prix,
        ]);

        return redirect()->back()->with('success', 'Commande enregistrée dans l’historique.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoriqueCommande  $historiqueCommandes
     * @return \Illuminate\Http\Response
     */
    public function show(HistoriqueCommande $historiqueCommandes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoriqueCommande  $historiqueCommandes
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoriqueCommande $historiqueCommandes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoriqueCommande  $historiqueCommandes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoriqueCommande $historiqueCommandes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoriqueCommande  $historiqueCommandes
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoriqueCommande $historiqueCommandes)
    {
        //
    }
}
