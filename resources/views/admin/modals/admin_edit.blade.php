@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center text-primary">Modifier l'administrateur</h1>

    {{-- Erreurs --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire de modification --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $admin->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $admin->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" name="telephone" class="form-control" id="telephone" value="{{ old('telephone', $admin->telephone) }}" required>
                </div>

                <div class="mb-3">
                    <label for="segment" class="form-label">Segment</label>
                    <select name="segment" class="form-select" id="segment" required>
                        <option value="">-- Choisir un segment --</option>
                        <option value="homme" {{ old('segment', $admin->segment) == 'homme' ? 'selected' : '' }}>Homme</option>
                        <option value="femme" {{ old('segment', $admin->segment) == 'femme' ? 'selected' : '' }}>Femme</option>
                        <option value="jeune_homme" {{ old('segment', $admin->segment) == 'jeune_homme' ? 'selected' : '' }}>Jeune homme (≤ 30 ans)</option>
                        <option value="jeune_femme" {{ old('segment', $admin->segment) == 'jeune_femme' ? 'selected' : '' }}>Jeune femme (≤ 30 ans)</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
