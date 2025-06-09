@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
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
        margin-bottom: 25px;
        font-size: 0.95rem;
    }

    input, select {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        border: 2px solid #6f42c1;
        border-radius: 6px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    input:focus, select:focus {
        border-color: rgb(3, 41, 3);
        box-shadow: 0 0 5px rgba(3, 41, 3, 0.3);
        outline: none;
    }

    button {
        background-color: #6f42c1;
        color: #fff;
        padding: 14px;
        width: 100%;
        border: none;
        border-radius: 6px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        font-weight: bold;
    }

    button:hover {
        background-color: rgb(5, 40, 5);
        transform: translateY(-2px);
    }

    .btn-link {
        background-color: transparent;
        color: #6f42c1;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        text-decoration: underline;
        padding: 0;
        display: block;
        margin-top: 15px;
        text-align: center;
    }

    .btn-link:hover {
        color: #228B22;
    }

    ::placeholder {
        color: #999;
    }
</style>

<div class="login-container">
    <form method="POST" action="{{ route('auth.client-login') }}" class="login-box">
        @csrf
        <h2>Connexion Client</h2>
        <p>Connectez-vous pour accéder à votre espace personnel</p>

        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Mot de passe" required />
        
        <button type="submit">Se connecter</button>
        
        <button type="button" class="btn-link" onclick="window.location='{{ route('auth.register.form') }}'">
            Pas encore inscrit ? Créer un compte
        </button>
    </form>
</div>

@endsection
