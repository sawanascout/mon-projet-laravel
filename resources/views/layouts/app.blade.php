<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GLOBALDROP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
    /* Couleurs personnalisées */
    :root {
        --mauve: #6f42c1;
        --vert-treillis: rgb(1, 32, 1);
        --blanc: #ffffff;
    }
.star-rating {
  font-size: 1.2rem; /* taille des étoiles */
  color: #ccc;       /* couleur des étoiles "inactives" */
}

.star-rating .filled {
  color: gold;       /* couleur des étoiles "pleines" */
}

    /* Bouton mauve personnalisé */
    .btn-mauve {
        background-color: var(--mauve);
        border-color: var(--mauve);
        color: white;
    }

    .btn-mauve:hover, 
    .btn-mauve:focus, 
    .btn-mauve:active {
        background-color: #5a359a;
        border-color: #5a359a;
        color: white;
    }

    /* Navbar */
    .navbar-custom {
        background: linear-gradient(90deg, #b27fe4 0%, #6f42c1 100%);
    }

    .navbar-custom .navbar-brand,
    .navbar-custom .nav-link,
    .navbar-custom .navbar-text {
        color: var(--blanc);
    }
    .navbar-custom .nav-link:hover {
        color: var(--vert-treillis);
    }

    /* Footer */
    footer {
        background-color: var(--vert-treillis);
        color: var(--blanc);
    }
            body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
        .btn-purple {
    background-color:rgba(83, 61, 5, 0.66);
    border-color: #6f42c1;
}
.btn-purple:hover {
    background-color:rgb(29, 155, 153);
    border-color:rgb(53, 156, 105);
}

    /* Main content padding */
    main.py-4 {
        min-height: 80vh;
    }
</style>

</head>
<body>

    @include('partials.navbar')

    <main class="py-4 container">
        @yield('content') 
    </main>

    <footer class="text-center py-3">
        <p>Suivez-nous :</p>
        <a href="https://www.facebook.com/share/19BrbhLzb2/" target="_blank"><i class="fab fa-facebook fa-lg mx-2"></i></a>
        <a href="https://instagram.com/votrepage" target="_blank"><i class="fab fa-instagram fa-lg mx-2"></i></a>
        <a href="https://www.tiktok.com/@globaldrop4" target="_blank"><i class="fab fa-tiktok fa-lg mx-2"></i></a>
         <a href="https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q" target="_blank"><i class="fab fa-whatsapp fa-lg mx-2"></i></a>

        {{-- Section Contacts --}}
            <div >
                <h2>Contactez-nous</h2>
                <ul class="list-unstyled">
                    <li><strong>Adresse :</strong> Adidogomé, LOME-TOGO</li>
                    <li><strong>Téléphone :</strong>+212 663-198444</li>
                    <li><strong>Email :</strong> globaldrop2428@gmail.com</li>
                </ul>
            </div>
        &copy; {{ date('Y') }} GLOBAL DROP
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
