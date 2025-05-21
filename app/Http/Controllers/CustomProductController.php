<?php

namespace App\Http\Controllers;

use App\Models\CustomProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomProductController extends Controller
{
    public function create()
    {
        return view('custom.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'fullname' => 'required|string|max:255',
        'gender' => 'required|in:homme,femme',
        'image_path' => 'required|image',
        'description' => 'nullable|string',
    ]);

    // Stockage de l'image dans le disque 'public'
    $path = $request->file('image_path')->store('custom_products', 'public');

    // Création de la demande personnalisée
    $customProduct = CustomProduct::create([
        'fullname' => $request->fullname,
        'gender' => $request->gender,
        'image_path' => $path,
        'description' => $request->description,
        'status' => 'pending',
    ]);

    // URL publique de l'image uploadée
    $imageUrl = asset('storage/' . $path);

    // Message WhatsApp pré-rempli
    $message = "Bonjour, je souhaite commander un produit personnalisé.\nVoici le lien vers mon image : $imageUrl\nMerci de me contacter.";

    // Encode le message pour URL
    $whatsappMessage = urlencode($message);

    // Numéro WhatsApp du responsable (format international sans +)
    $whatsappNumber = '212723455155'; // Remplace par le vrai numéro

    // URL WhatsApp
    $whatsappUrl = "https://wa.me/$whatsappNumber?text=$whatsappMessage";

    // Rediriger vers la page de confirmation avec URL WhatsApp
    return view('custom.success', compact('imageUrl', 'whatsappUrl'));
}

}
