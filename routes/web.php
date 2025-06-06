<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ParrainageController;
use App\Http\Controllers\ProfileController;

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');


// Page d’accueil (produits)
Route::get('/', [ProductController::class, 'index'])->name('produits.index');

// --------- PRODUITS ---------
Route::prefix('produits')->group(function () {
    Route::get('/{id}', [ProductController::class, 'show'])->name('produits.show');
});

Route::get('/categorie/{category}', [ProductController::class, 'byCategory'])->name('produits.category');

// --------- COMMANDES ---------


Route::view('/commande/succes', 'client.orders.success')->name('commandes.success');

// --------- PRODUITS PERSONNALISÉS ---------
Route::prefix('custom')->group(function () {
    Route::get('/create', [CustomProductController::class, 'create'])->name('custom.create');
    Route::post('/store', [CustomProductController::class, 'store'])->name('custom.store');
    Route::post('/upload-image', [CustomProductController::class, 'uploadImage'])->name('custom.uploadImage');
});

// --------- PANIER ---------
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// --------- AVIS PRODUITS ---------
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
// web.php



Route::get('/mon-parrainage', [ParrainageController::class, 'index'])->name('parrainage.index');
Route::get('/invite', [ParrainageController::class, 'invite'])->name('invite');


// --------- ROUTES PROTÉGÉES (si besoin) ---------
Route::middleware(['auth'])->group(function () {
Route::get('/create/{product?}', [OrderController::class, 'create'])->name('commandes.create');
    Route::post('/', [OrderController::class, 'store'])->name('commandes.store');
    Route::get('/confirmation/{id}', [OrderController::class, 'confirmation'])->name('commandes.confirmation');
    Route::get('/{id}/recu', [OrderController::class, 'downloadReceipt'])->name('commandes.receipt');
    Route::post('/{id}/finaliser', [OrderController::class, 'finaliser'])->name('commandes.finaliser');
    Route::get('/terminee/{id}', [OrderController::class, 'terminee'])->name('commandes.terminee');
    Route::post('/commandes/feedback/{id}', [OrderController::class, 'feedback'])->name('commandes.feedback');

Route::get('/mes-commandes', [OrderController::class, 'mesCommandes'])->name('commandes.mes-commandes');
Route::get('/mon-parrainage', [ParrainageController::class, 'index'])->name('parrainage.index');

});


Route::get('/dashboard', function () {
    return redirect()->route('produits.index');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
