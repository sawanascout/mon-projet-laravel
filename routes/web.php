<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AuthController,
    ClientController,
    AdminController,
    ProduitsController,
    PaniersController,
    CommandesController,
    LigneCommandesController,
    AvisController,
    ProfilController,
    CategoriesController,
    ElementsPaniersController,
    HistoriqueCommandesController,
    ParrainageController,
    PaiementController,
    ProduitPersonnaliseController
};

// ================= ADMIN ===================
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Paiements
    Route::resource('paiements', PaiementController::class)->except(['create'])->names('paiements');
Route::get('/personnalisations', [ProduitPersonnaliseController::class, 'indexAdmin'])->name('admin.custom.index');
Route::put('/personnalisations/{id}/statut', [ProduitPersonnaliseController::class, 'updateStatut'])->name('admin.custom.update-statut');

    // Utilisateurs & admins
    Route::post('/ajout-admin', [AdminController::class, 'store'])->name('ajout-admin');
    Route::post('/grant', [AdminController::class, 'addPrivileges'])->name('grant');
    Route::delete('/admins/{id}', [AdminController::class, 'destroyAdmin'])->name('admins.destroy');
    Route::post('/admins', [AdminController::class, 'storeAdmin'])->name('admins.storeAdmin');

    // Commandes
    Route::resource('commandes', CommandesController::class)->only(['index','update']);
    Route::post('/commandes/dates', [AdminController::class, 'commandesParDate'])->name('commandes.dates');
    Route::get('/commandes/json', [AdminController::class, 'getCommandesBetweenDates'])->name('commandes.json');
    Route::post('/commandes/statistiques', [CommandesController::class, 'commandesParDate'])->name('commandes-graphique');
    Route::post('/commandes/segments', [AdminController::class, 'commandesParSegment'])->name('commandes.segments');

    // Statistiques utilisateurs
    Route::post('/utilisateurs/segment', [AdminController::class, 'utilisateursParSegmentEtDate'])->name('utilisateurs.segment');
    Route::get('/clients-par-segment', [AdminController::class, 'clientsAyantCommandeParSegment'])->name('clients.segment');
    Route::get('/utilisateurs-commandes', [AdminController::class, 'utilisateursAvecCommandes'])->name('utilisateurs.commandes');
    Route::get('/clients-segment-role', [AdminController::class, 'clientsParSegmentEtRole'])->name('clients.segment.role');

    // Produits, catégories, avis, historique
    Route::get('produits-admin', [ProduitsController::class, 'indexadmin'])->name('produits.admin');
    Route::resource('produits', ProduitsController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('historiqueCommandes', HistoriqueCommandesController::class);
    Route::resource('produits.avis', AvisController::class)->only(['index'])->names('avis');

    // Graphique avis
    Route::get('/avis-graphique/{produitId}', [AdminController::class, 'avisGraphique'])->name('avis.graphique');
});

// ================= CLIENT ===================
Route::prefix('client')->middleware(['auth', 'is_client'])->name('client.')->group(function () {
    // Profil
    Route::get('/profil', [ClientController::class, 'profil'])->name('profil');
    Route::get('/profile', [ProfilController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilController::class, 'destroy'])->name('profile.destroy');

    // Commandes
    Route::resource('commandes', CommandesController::class)->only(['index', 'store', 'show']);
    Route::get('/commandes/create', [CommandesController::class, 'create'])->name('commandes.create');
    Route::get('/commandes/confirmation/{id}', [CommandesController::class, 'confirmation'])->name('commandes.confirmation');
    Route::get('/commandes/{id}/receipt', [CommandesController::class, 'downloadReceipt'])->name('commandes.receipt');
    Route::post('/commandes/{id}/terminee', [CommandesController::class, 'terminee'])->name('commandes.terminee');
    Route::post('/commandes/{id}/feedback', [CommandesController::class, 'feedback'])->name('commandes.feedback');
    Route::get('/mes-commandes', [CommandesController::class, 'mesCommandes'])->name('commandes.mes');
    Route::get('/suivi/{orderNumber}', [CommandesController::class, 'suivreParNumero'])->name('commandes-suivi');

    // Paiements
    Route::get('paiements/create/{commande_id}', [PaiementController::class, 'create'])->name('paiements.create');
    Route::post('paiements', [PaiementController::class, 'store'])->name('paiements.store');

    // Personnalisation produit
    Route::get('/custom/create', [ProduitPersonnaliseController::class, 'create'])->name('custom.create');
    Route::post('/custom', [ProduitPersonnaliseController::class, 'store'])->name('custom.store');

    // Parrainage
    Route::get('/mon-parrainage', [ParrainageController::class, 'index'])->name('parrainage.index');
    Route::get('/invite', [ParrainageController::class, 'invite'])->name('invite');
    Route::get('/parametres', [ClientController::class, 'parametres'])->name('parametres');
    // Affiche le formulaire de création d’un produit personnalisé
Route::get('/custom/create', [ProduitPersonnaliseController::class, 'create'])->name('custom.create');

// Traite l’envoi du formulaire de personnalisation
Route::post('/custom', [ProduitPersonnaliseController::class, 'store'])->name('custom.store');
Route::get('/custom', [ProduitPersonnaliseController::class, 'index'])->name('custom.index');


    // Panier
    Route::get('/panier', [PaniersController::class, 'index'])->name('panier-index');
    Route::post('/panier/ajouter/{produit_id}', [PaniersController::class, 'store'])->name('panier.ajouter');
    Route::delete('/panier/supprimer/{id}', [PaniersController::class, 'supprimer'])->name('panier.supprimer');
    Route::post('/panier/vider', [PaniersController::class, 'vider'])->name('panier.vider');
    Route::put('/panier/quantite/{id}', [PaniersController::class, 'mettreAJourQuantite'])->name('panier.quantite');
    Route::resource('panier/elements', ElementsPaniersController::class)->only(['update', 'destroy'])->names('panier-elements');
});

// ================= PUBLIC ===================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('produits', ProduitsController::class)->except(['create', 'edit']);
Route::resource('produits-personnalises', ProduitPersonnaliseController::class);

Route::get('/produits/recherche', [ProduitsController::class, 'find'])->name('produits.find');
Route::get('/produits/rechercher/{nom}', [ProduitsController::class, 'rechercher'])->name('produits.rechercher');

Route::get('/commandes/{commandeId}/lignes', [LigneCommandesController::class, 'index'])->name('commandes.lignes.index');
Route::get('/lignes-commandes/{id}', [LigneCommandesController::class, 'show'])->name('commandes.lignes.show');

// ================= AVIS ===================
Route::middleware('auth')->group(function () {
    Route::get('/produits/{produit_id}/avis/create', [AvisController::class, 'create'])->name('avis.create');
    Route::post('/produits/{produit_id}/avis', [AvisController::class, 'store'])->name('avis.store');
    Route::delete('/avis/{id}', [AvisController::class, 'destroy'])->name('avis.destroy');
});

// ================= AUTH ===================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('auth.client-login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register.form');
Route::post('/register', [AuthController::class, 'register'])->name('auth.client-register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/password/reset', [AuthController::class, 'showPasswordResetForm'])->name('auth.password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLink'])->name('auth.password.email');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('social.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::get('/auth/apple', [AuthController::class, 'redirectToApple'])->name('social.apple');
Route::get('/auth/apple/callback', [AuthController::class, 'handleAppleCallback']);
