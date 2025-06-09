@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des commandes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('commandes.create') }}" class="btn btn-primary mb-3">Nouvelle commande</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Date</th>
                <th>Montant total</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                    <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                    <td>{{ number_format($commande->montant_total, 2) }} €</td>
                    <td>{{ ucfirst($commande->statut) }}</td>
                    <td>
                        <a href="{{ route('commandes.show', $commande) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('commandes.edit', $commande) }}" class="btn btn-sm btn-warning">Modifier</a>

                        <form action="{{ route('commandes.destroy', $commande) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Supprimer cette commande ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">Aucune commande trouvée.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
