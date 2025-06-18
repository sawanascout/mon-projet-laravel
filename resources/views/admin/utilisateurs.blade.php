@extends('layouts.app')

@section('content')
<h1>Clients regroupés par segment et par rôle</h1>

@foreach($clientsGroupes as $segment => $roles)
    <h2>Segment : {{ $segment }}</h2>

    @foreach($roles as $role => $clients)
        <h3>Rôle : {{ $role }}</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <!-- Autres colonnes si besoin -->
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->telephone }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@endforeach

@endsection
