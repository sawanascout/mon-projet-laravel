<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    // Affiche tous les produits (filtrés si utilisateur connecté avec segment)
    public function index(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }
if ($request->filled('category')) {
    $query->where('category', $request->category);
} else if (Auth::check() && Auth::user()->segment) {
    $segment = strtolower(trim(Auth::user()->segment));
    $query->whereRaw('LOWER(category) LIKE ?', ['%' . $segment . '%']);
}



    $products = $query->withAvg('reviews', 'rating')
                      ->where('available', true)
                      ->latest()
                      ->paginate(12);

    $products->getCollection()->transform(function ($product) {
        $product->rating = $product->reviews_avg_rating ?? 0;
        return $product;
    });


    return view('produits.index', compact('products'));
}


    // Affiche les produits par catégorie spécifique
    public function byCategory($category)
    {
        $products = Product::where('category', $category)
            ->where('available', true)
            ->withAvg('reviews', 'rating')
            ->get()
            ->transform(function ($product) {
                $product->rating = $product->reviews_avg_rating ?? 0;
                return $product;
            });

        return view('produits.category', compact('products', 'category'));
    }

    // Détail d'un produit
    public function show($id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        $averageRating = $product->averageRating();

        return view('produits.show', compact('product', 'averageRating'));
    }
}
