<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
        .btn-purple {
    background-color: #6f42c1;
    border-color: #6f42c1;
}
.btn-purple:hover {
    background-color:rgb(29, 155, 153);
    border-color:rgb(53, 156, 105);
}
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<body>

<nav>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-success">Tableau de bord</a> 
    
    <a class="btn btn-primary" href="{{ route('admin.produits') }}">Voir produits</a>
    <a class="btn btn-success" href="{{ route('admin.categories.index') }}">Voir catégories</a>
    <a class="btn btn-warning" href="{{ route('admin.commandes.index') }}">Voir commandes</a>
    <!-- Ajoute d’autres liens si besoin -->
</nav>

<hr>

@yield('content')

</body>
</html>
