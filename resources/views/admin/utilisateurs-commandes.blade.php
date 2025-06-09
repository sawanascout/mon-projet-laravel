@extends('layouts.admin')

@section('content')
<h1>Utilisateurs avec au moins une commande</h1>

<h2>Nombre d'utilisateurs par segment</h2>
<ul>
    @foreach($nombreParSegment as $segment => $count)
        <li><strong>{{ $segment }}</strong> : {{ $count }} utilisateur(s)</li>
    @endforeach
</ul>

@foreach($utilisateurs as $segment => $usersSegment)
    <h3>Segment : {{ $segment }}</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Nombre de commandes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usersSegment as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->commandes->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

@endsection
