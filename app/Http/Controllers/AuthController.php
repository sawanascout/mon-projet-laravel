<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Paniers;
use Illuminate\Support\Facades\DB;
use Exception;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Traite la connexion
     */
  public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Redirection en fonction du rôle
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Connexion administrateur réussie.');
        } else {
            return redirect()->route('client.profil')->with('success', 'Connexion réussie.');
        }
    }

    return back()->withErrors([
        'email' => 'Les identifiants sont incorrects.',
    ])->onlyInput('email');
}


    /**
     * Affiche le formulaire d'inscription
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Traite l'inscription
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'segment'=> 'required|string|max:255',
            'telephone'=> 'required|string|max:255',
            'referral_code' => 'nullable|string|exists:users,referral_code', // nouveau
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'segment'=> $request->segment,
            'password' => Hash::make($request->password),
            'role'=>'client',
            'telephone'=> $request->telephone
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Inscription réussie (admin).');
        } else {
        Paniers::create([
            'user_id' => $user->id,
        ]);
        return redirect()->route('profil')->with('success', 'Inscription réussie (client).');
        };
    }


    /**
     * Déconnexion de l'utilisateur
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Déconnexion réussie.');
    }
     public function showPasswordResetForm()
    {
        return view('auth.password-reset');
    }

    // Envoi du lien de réinitialisation
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Logique d'envoi du lien ici (Laravel Password Reset)
        return back()->with('success', 'Lien de réinitialisation envoyé.');
    }

    // Connexion via Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('email', $user->getEmail())->first();
        if ($existingUser) {
            Auth::login($existingUser);
            return redirect()->route('password.dashboard');
        }

        $newUser = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make('defaultpassword'),
        ]);

        Auth::login($newUser);
        return redirect()->route('password.dashboard');
    }

    // Connexion via Apple
    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleAppleCallback()
    {
        $user = Socialite::driver('apple')->user();

        $existingUser = User::where('email', $user->getEmail())->first();
        if ($existingUser) {
            Auth::login($existingUser);
            return redirect()->route('password.dashboard');
        }

        $newUser = User::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => Hash::make('defaultpassword'),
        ]);

        Auth::login($newUser);
        return redirect()->route('password.dashboard');
    }

    /**
     * Créer un utilisateur MySQL.
     */
    
}


