@extends('layouts.admin')

@section('content')
<h1>Modifier la Catégorie</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.categories-update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nom">Nom de la catégorie</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom', $category->nom) }}" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
</form>
@endsection
