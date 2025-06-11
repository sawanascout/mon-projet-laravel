<?php

namespace App\Http\Controllers;

use App\Models\HistoriqueCommandes;
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
        $commandes = HistoriqueCommandes::where('user_id', Auth::id())
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

        HistoriqueCommandes::create([
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
     * @param  \App\Models\HistoriqueCommandes  $historiqueCommandes
     * @return \Illuminate\Http\Response
     */
    public function show(HistoriqueCommandes $historiqueCommandes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoriqueCommandes  $historiqueCommandes
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoriqueCommandes $historiqueCommandes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoriqueCommandes  $historiqueCommandes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoriqueCommandes $historiqueCommandes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoriqueCommandes  $historiqueCommandes
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoriqueCommandes $historiqueCommandes)
    {
        //
    }
}
