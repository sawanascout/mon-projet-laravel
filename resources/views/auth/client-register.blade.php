@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #f8f9fa, #e8eaf6);
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
    }

    .register-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .register-card {
        background-color: #ffffff;
        padding: 40px 30px;
        border-radius: 15px;
        box-shadow: 0 8px 24px rgba(123, 75, 183, 0.25);
        width: 100%;
        max-width: 420px;
        text-align: center;
    }

    .register-card h2 {
        color: #7B4BB7;
        margin-bottom: 25px;
        font-weight: bold;
    }

    input, select {
        width: 100%;
        padding: 12px;
        margin-bottom: 16px;
        border: 2px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    input:focus, select:focus {
        border-color: #3B8D54;
        box-shadow: 0 0 0 3px rgba(59, 141, 84, 0.15);
        outline: none;
    }

    button[type="submit"] {
        background-color: #7B4BB7;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 6px;
        font-size: 1.1rem;
        font-weight: bold;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #693aa5;
    }

    .btn-social {
        width: 100%;
        padding: 12px;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 12px;
        transition: background-color 0.3s ease;
    }

    .btn-google {
        background-color: #ffffff;
        border: 2px solid #ddd;
        color: #333;
    }

    .btn-google:hover {
        background-color: #f1f1f1;
    }

    .btn-apple {
        background-color: #000;
        color: #fff;
        border: none;
    }

    .btn-apple:hover {
        background-color: #333;
    }

    .divider {
        text-align: center;
        font-size: 0.9rem;
        color: #888;
        margin: 16px 0;
        position: relative;
    }

    .divider::before, .divider::after {
        content: '';
        display: inline-block;
        width: 45%;
        height: 1px;
        background-color: #ddd;
        vertical-align: middle;
    }

    .divider span {
        padding: 0 12px;
    }
</style>

<div class="register-container">
    <div class="register-card">
        <h2>Créer un compte</h2>

        <!-- Connexion rapide -->
      <a href="{{ route('social.google') }}" class="btn-social btn-google">
    <i class="bi bi-google"></i>

    Continuer avec Google
</a>

        <a href="{{ route('social.apple') }}" class="btn-social btn-apple">
            <i class="bi bi-apple"></i> Continuer avec Apple
        </a>


        <!-- Formulaire traditionnel -->
        <form method="POST" action="{{ route('auth.client-register') }}">
            @csrf

            <input type="text" name="name" placeholder="Nom" value="{{ old('name') }}" required>
            <input type="text" name="prenom" placeholder="Prénom" value="{{ old('prenom') }}" required>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="password_confirmation" placeholder="Confirmation mot de passe" required>
            <input type="text" name="telephone" placeholder="Numéro de téléphone" value="{{ old('telephone') }}" required>

            <select name="segment" required>
                <option value="" disabled selected>Choisissez votre segment</option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="jeune_homme">Jeune homme (≤ 30 ans)</option>
                <option value="jeune_femme">Jeune femme (≤ 30 ans)</option>
            </select>

            <button type="submit">S'inscrire</button>
        </form>

        <button type="button" class="btn-link" onclick="window.location='{{ route('auth.login.form') }}'">
            Déjà inscrit ? Se connecter
        </button>
    </div>
</div>
@endsection
