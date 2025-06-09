@extends('layouts.app')

@section('content')
    <h1>Modifier mon profil</h1>

    <form method="POST" action="{{ route('client.profile.update') }}">
        @csrf

        <input type="text" name="nom" value="{{ old('nom', $client->nom) }}" placeholder="Nom" required>
        <input type="text" name="prenom" value="{{ old('prenom', $client->prenom) }}" placeholder="Prénom" required>
        <input type="email" name="email" value="{{ old('email', $client->email) }}" placeholder="Email" required>

        <hr>
        <p>Changer le mot de passe (optionnel)</p>
        <input type="password" name="password" placeholder="Nouveau mot de passe">
        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe">

        <button type="submit">Enregistrer</button>
    </form>
@endsection
