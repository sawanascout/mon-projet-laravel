<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20|unique:clients',
            'adresse' => 'nullable|string|max:255',
            'segmentation' => 'nullable|string|max:50',
        ]);

        Client::create($validated);

        return redirect()->back()->with('success', 'Inscription réussie !');
    }
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email',
        'password' => 'required|string|confirmed|min:6',
    ]);

    $client = Client::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Authentifier client directement ou rediriger vers la page commande
    // Auth::guard('client')->login($client);

    return redirect()->route('produits.index')->with('success', 'Inscription réussie, vous pouvez passer commande.');
}

}
