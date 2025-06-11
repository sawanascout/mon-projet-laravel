@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-box {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(111, 66, 193, 0.25);
        width: 100%;
        max-width: 400px;
    }

    .login-box h2 {
        color: #6f42c1;
        text-align: center;
        margin-bottom: 10px;
        font-size: 2rem;
    }

    .login-box p {
        text-align: center;
        color: #555;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .alert-error {
        background-color: #ffdddd;
        border-left: 5px solid #d9534f;
        color: #d9534f;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }

    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 2px solid #6f42c1;
        border-radius: 6px;
        font-size: 1rem;
    }

    button {
        background-color: #6f42c1;
        color: #fff;
        padding: 14px;
        width: 100%;
        border: none;
        border-radius: 6px;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .btn-link {
        background-color: transparent;
        color: #6f42c1;
        cursor: pointer;
        font-size: 1rem;
        text-decoration: underline;
        display: block;
        margin-top: 12px;
        text-align: center;
    }

    .btn-link:hover {
        color: #228B22;
    }
</style>

<div class="login-container">
    <form method="POST" action="{{ route('auth.client-login') }}" class="login-box">
        @csrf
        <h2>Connexion Client</h2>
        <p>Connectez-vous pour accéder à votre espace personnel</p>

        <!-- Affichage des erreurs -->
        @if (session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
        
        <button type="submit">Se connecter</button>
        
        <!-- Option mot de passe oublié -->
        <button type="button" class="btn-link" onclick="window.location='{{ route('auth.password.request') }}'">
            Mot de passe oublié ?
        </button>

        <button type="button" class="btn-link" onclick="window.location='{{ route('auth.register.form') }}'">
            Pas encore inscrit ? Créer un compte
        </button>
    </form>
</div>
@endsection
