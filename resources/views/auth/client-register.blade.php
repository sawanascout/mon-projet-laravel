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
    }

    .register-card h2 {
        text-align: center;
        color: #7B4BB7;
        margin-bottom: 25px;
        font-weight: bold;
    }

    input, select {
        width: 100%;
        padding: 12px 14px;
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

    .btn-link {
        background: none;
        border: none;
        color: #7B4BB7;
        text-align: center;
        display: block;
        margin-top: 12px;
        text-decoration: underline;
        cursor: pointer;
        transition: color 0.3s ease;
        font-size: 0.95rem;
    }

    .btn-link:hover {
        color: #3B8D54;
    }

    small {
        color: #d9534f;
    }
</style>

<div class="register-container">
    <form method="POST" action="{{ route('auth.client-register') }}" class="register-card">
        <h2>Créer un compte</h2>
        @csrf

        <input type="text" name="name" placeholder="Nom" value="{{ old('name') }}" required>
        @error('name') <small>{{ $message }}</small> @enderror

        <input type="text" name="prenom" placeholder="Prénom" value="{{ old('prenom') }}" required>
        @error('prenom') <small>{{ $message }}</small> @enderror

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        @error('email') <small>{{ $message }}</small> @enderror

        <input type="password" name="password" placeholder="Mot de passe" required>
        @error('password') <small>{{ $message }}</small> @enderror

        <input type="password" name="password_confirmation" placeholder="Confirmation mot de passe" required>

        <input type="text" name="telephone" placeholder="Numéro de téléphone" value="{{ old('telephone') }}" required>
        @error('telephone') <small>{{ $message }}</small> @enderror

        <select name="segment" required>
            <option value="" disabled {{ old('segment') ? '' : 'selected' }}>Choisissez votre segment</option>
            <option value="homme" {{ old('segment') == 'homme' ? 'selected' : '' }}>Homme</option>
            <option value="femme" {{ old('segment') == 'femme' ? 'selected' : '' }}>Femme</option>
            <option value="jeune_homme" {{ old('segment') == 'jeune_homme' ? 'selected' : '' }}>Jeune homme (≤ 30 ans)</option>
            <option value="jeune_femme" {{ old('segment') == 'jeune_femme' ? 'selected' : '' }}>Jeune femme (≤ 30 ans)</option>
        </select>
        @error('segment') <small>{{ $message }}</small> @enderror

        <button type="submit">S'inscrire</button>

        <button type="button" class="btn-link" onclick="window.location='{{ route('auth.login.form') }}'">
            Déjà inscrit ? Se connecter
        </button>
    </form>
</div>
@endsection
