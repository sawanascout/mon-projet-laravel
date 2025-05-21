<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomProductController;
use App\Http\Controllers\CartController;

Route::get('/', [ProductController::class, 'index'])->name('produits.index');
Route::get('/categorie/{category}', [ProductController::class, 'byCategory'])->name('produits.category');
Route::get('/produit/{id}', [ProductController::class, 'show'])->name('produits.show');
Route::get('/commandes/create/{product?}', [OrderController::class, 'create'])->name('commandes.create');
Route::get('/commandes/confirmation/{id}', [OrderController::class, 'confirmation'])->name('commandes.confirmation');
Route::post('/custom/upload-image', [CustomProductController::class, 'uploadImage'])->name('custom.uploadImage');

Route::get('/custom/create', [CustomProductController::class, 'create'])->name('custom.create');
Route::post('/custom/store', [CustomProductController::class, 'store'])->name('custom.store');



Route::post('/commande', [OrderController::class, 'store'])->name('commandes.store');
Route::view('/commande/succes', 'client.orders.success')->name('commandes.success');
Route::get('/commandes/{id}/recu', [OrderController::class, 'downloadReceipt'])->name('commandes.receipt');

Route::post('/commandes', [OrderController::class, 'store'])->name('commandes.store');

Route::delete('/panier/supprimer/{id}', [CartController::class, 'remove'])->name('cart.remove');


Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/panier/supprimer/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::post('/products/{product}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
