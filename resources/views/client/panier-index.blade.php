@extends('layouts.app')

@section('content')
<h1>Votre Panier</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($elements->isEmpty())
    <p>Votre panier est vide.</p>
@else
    <table class="table table-bordered table-striped">
        <thead class="thead-light">
            <tr>
                <th>Produit</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($elements as $element)
            <tr>
                @if ($element->produit)
                    <td>{{ $element->produit->nom }}</td>
                    <td>{{ ucfirst($element->couleur) }}</td>
                    <td>{{ strtoupper($element->taille) }}</td>
                    <td>{{ number_format($element->quantite) }}</td>
                    <td>{{ number_format($element->produit->prix, 2) }} CFA</td>
                    <td>{{ number_format($element->produit->prix * $element->quantite, 2) }} CFA</td>
                @else
                    <td colspan="6" class="text-danger">Produit supprimé</td>
                @endif
                <td>
                    <!-- Supprimer -->
                    <form action="{{ route('client.panier.supprimer', $element->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                    </form>

                    <!-- Modifier (ouvre le modal) -->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modifierModal-{{ $element->id }}">
                        Modifier
                    </button>
                </td>
            </tr>

            <!-- Modal de modification -->
            <div class="modal fade" id="modifierModal-{{ $element->id }}" tabindex="-1" aria-labelledby="modifierModalLabel-{{ $element->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('client.panier-elements.update', $element->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modifierModalLabel-{{ $element->id }}">Modifier le produit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label" for="quantite-{{ $element->id }}">Quantité</label>
                                    <input type="number" name="quantite" id="quantite-{{ $element->id }}" class="form-control" value="{{ $element->quantite }}" min="1" max="1000" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Couleur</label>
                                    <select name="couleur" class="form-select" required>
                                        <option value="" disabled>Choisir une couleur</option>
                                        @foreach($element->produit->couleur ?? [] as $couleur)
                                            <option value="{{ $couleur }}" {{ $element->couleur === $couleur ? 'selected' : '' }}>
                                                {{ ucfirst($couleur) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Taille</label>
                                    <select name="taille" class="form-select" required>
                                        <option value="" disabled>Choisir une taille</option>
                                        @foreach($element->produit->taille ?? [] as $taille)
                                            <option value="{{ $taille }}" {{ $element->taille === $taille ? 'selected' : '' }}>
                                                {{ strtoupper($taille) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-success">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>

    <p class="mt-4"><strong>Total panier : </strong> 
        {{ number_format($elements->reduce(function($carry, $item) {
            return $item->produit ? $carry + ($item->produit->prix * $item->quantite) : $carry;
        }, 0), 2) }} CFA
    </p>
    <a href="{{ route('produits.index') }}" class="btn btn-secondary mt-2">Continuer vos achats</a>
    <a href="" class="btn btn-info mt-2">Valider le panier</a>

@endif
@endsection
