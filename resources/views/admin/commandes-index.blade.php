@extends('layouts.app')

@section('content')
<h1>Commandes</h1>

<!-- Table -->
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Numéro de commande</th>
            <th>Utilisateur</th>
            <th>Statut</th>
            <th>Ville</th>
            <th>Commentaire</th>
            <th>Total</th>
            <th>Date de création</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande->order_number }}</td>
                <td>{{ $commande->user->name ?? 'N/A' }}</td> {{-- attention à la relation user --}}
                <td>{{ $commande->statut }}</td>
                <td>{{ $commande->city }}</td>
                <td>{{ $commande->commentaire }}</td>
                <td>{{ $commande->total }}</td>
                <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editStatusModal{{ $commande->id }}">
                        Modifier statut
                    </button>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="editStatusModal{{ $commande->id }}" tabindex="-1" aria-labelledby="editStatusModalLabel{{ $commande->id }}" aria-hidden="true">
              <div class="modal-dialog">
                <form action="{{ route('admin.commandes.updateStatus', $commande->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editStatusModalLabel{{ $commande->id }}">Modifier le statut de la commande {{ $commande->order_number }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <select name="statut" class="form-select" required>
                            <option value="en cours" {{ $commande->statut === 'en cours' ? 'selected' : '' }}>En cours</option>
                            <option value="expédiée" {{ $commande->statut === 'expédiée' ? 'selected' : '' }}>Expédiée</option>
                            <option value="livrée" {{ $commande->statut === 'livrée' ? 'selected' : '' }}>Livrée</option>
                            <option value="annulée" {{ $commande->statut === 'annulée' ? 'selected' : '' }}>Annulée</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                      <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
        @endforeach
    </tbody>
</table>


@endsection
