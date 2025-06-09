<?php

namespace App\Http\Controllers;

use App\Models\Produits;

class HomeController extends Controller
{
    public function index()
    {
        $produits = Produits::with('categorie')->latest()->take(8)->get(); // Par exemple, les 8 derniers produits
        return view('home', compact('produits'));
    }
}
