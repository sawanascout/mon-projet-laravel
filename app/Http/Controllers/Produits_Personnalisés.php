<?php

namespace App\Http\Controllers;

use App\Models\ProduitPersonnalise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitPersonnaliseController extends Controller
{
    /**
     * Affiche le formulaire de création d’un produit personnalisé.
     */
    public function index()
{
    $demandes = ProduitPersonnalise::where('user_id', Auth::id())->latest()->get();
    return view('custom.index', compact('demandes'));
}

    public function create()
    {
        return view('custom.create');
    }

    /**
     * Stocke une nouvelle demande de produit personnalisé.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'genre' => 'required|in:homme,femme',
            'image' => 'required|image',
            'description' => 'nullable|string',
        ]);

        // Stockage de l’image
        $path = $request->file('image')->store('custom_products', 'public');

        // Création de la demande personnalisée
        $produit = ProduitPersonnalise::create([
            'user_id' => Auth::id(),
            'nom_complet' => $request->nom_complet,
            'genre' => $request->genre,
            'image' => $path,
            'description' => $request->description,
            'statut' => 'pending',
        ]);

        // Lien de l’image
        $imageUrl = asset('storage/' . $path);

        // Message WhatsApp pré-rempli
        $message = "Bonjour, je souhaite commander un produit personnalisé.\nVoici le lien vers mon image : $imageUrl\nMerci de me contacter.";
        $whatsappMessage = urlencode($message);
        $whatsappNumber = '212723455155';
        $whatsappUrl = "https://wa.me/$whatsappNumber?text=$whatsappMessage";

        return view('custom.success', compact('imageUrl', 'whatsappUrl'));
    }
}
