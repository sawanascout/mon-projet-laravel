<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GLOBALDROP</title>

    <!-- Bootstrap 5.3.3 CSS + JS bundle -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Styles & Icônes -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
      <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        :root {
            --mauve: #6f42c1;
            --vert-treillis: rgb(1, 32, 1);
            --blanc: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #b27fe4 0%, #6f42c1 100%);
        }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: white;
        }

        .navbar-custom .nav-link:hover {
            color: var(--vert-treillis);
        }

        .bg-mauve {
            background-color: var(--mauve);
        }

        #carousel-bar {
            font-weight: 500;
            font-size: 14px;
        }

        #carousel-text {
            transition: opacity 0.5s ease;
        }

        footer {
            background-color: var(--vert-treillis);
            color: white;
        }

        footer h3 {
            font-weight: 600;
            margin-bottom: 1rem;
            color: white;
        }

        footer svg {
            width: 24px;
            height: 24px;
            transition: transform 0.2s ease-in-out;
        }

        footer svg:hover {
            transform: scale(1.2);
        }

        .social-icons a {
            margin-right: 16px;
            color: white;
        }

        .social-icons a:hover {
            color: gold;
        }

        main.py-4 {
            min-height: 80vh;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
         .banniere-container {
      background-color: #6f42c1; /* Violet */
      overflow: hidden;
      position: relative;
      height: 200px;
    }

    .banniere-animée {
      position: absolute;
      white-space: nowrap;
      animation: defilement 5s linear infinite;
    }

    .banniere-animée img {
      height: 100%;
      object-fit: cover;
    }

    @keyframes defilement {
      0% {
        transform: translateX(-100%);
      }
      100% {
        transform: translateX(100%);
      }
    }

    :root {
      --primary-color: #7B4BB7; /* Mauve */
      --secondary-color: #3B8D54; /* Vert */
      --background-color: #f8f9fa;
      --text-color: #333;
    }

    body {
      background-color: var(--background-color);
      color: var(--text-color);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    /* Boutons */
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #693aa5;
    }

    .btn-outline-secondary {
      color: var(--secondary-color);
      border-color: var(--secondary-color);
      transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
      background-color: var(--secondary-color);
      color: white;
    }

    /* Cartes Produits */
    .card {
      border: 1px solid #ddd;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: scale(1.03);
      box-shadow: 0 10px 25px rgba(123, 75, 183, 0.2);
    }

    /* Bannière défilante */
    .banniere-info {
      background-color: var(--primary-color);
      color: white;
      text-align: center;
      padding: 0.6rem;
    }

    .text-mauve {
      color: var(--primary-color);
    }

    .produit-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
      border-top: 4px solid var(--secondary-color);
    }

    .produit-card:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 25px rgba(123, 75, 183, 0.2);
      border-color: var(--primary-color);
    }

    /* Vidéo publicité flottante */
    #videoAdBanner {
      position: fixed;
      top: 50px;
      left: 0;
      width: 100%;
      z-index: 1050;
      display: none;
      justify-content: center;
      align-items: center;
      padding: 0 1rem;
    }

    #videoAdBanner .video-container {
      position: relative;
      max-width: 600px;
      width: 100%;
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      border: 2px solid var(--primary-color);
    }

    #videoAdBanner video {
      width: 100%;
      height: auto;
      display: block;
      border-radius: 1rem;
      object-fit: cover;
    }

    #videoAdBanner button.close-btn {
      position: absolute;
      top: 8px;
      right: 8px;
      background: rgba(0,0,0,0.6);
      border: none;
      color: white;
      font-size: 24px;
      line-height: 1;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      cursor: pointer;
      z-index: 10;
    }

    #videoAdBanner button.sound-btn {
      position: absolute;
      bottom: 8px;
      right: 8px;
      background: rgba(0,0,0,0.6);
      border: none;
      color: white;
      font-size: 16px;
      padding: 4px 8px;
      border-radius: 12px;
      cursor: pointer;
      z-index: 10;
    }

    #videoAdBanner .overlay-text {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.4);
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 1rem;
      pointer-events: none;
    }

    </style>
</head>
<body>

    <!-- Barre d'annonce tournante -->
    <div class="bg-mauve text-white text-center py-1" id="carousel-bar">
        <span id="carousel-text">Livraison gratuite sur toutes les commandes</span>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">GLOBALDROP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            @include('partials.navbar')
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Produits</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Promos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="py-4 container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-5 pt-5 pb-3">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-4 mb-4">
                    <h3>Suivez-nous</h3>
                    <div class="social-icons d-flex justify-content-center justify-content-md-start">
                        <!-- WhatsApp -->
                        <a href="https://whatsapp.com/channel/0029VbAh2wrGZNCxxKYwbN3Q" target="_blank" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/globaldrop2025" target="_blank" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/share/19BrbhLzb2/" target="_blank" aria-label="Facebook">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <!-- TikTok -->
                        <a href="http://www.tiktok.com/@globaldrop41" target="_blank" aria-label="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h3>À propos</h3>
                    <p>GLOBALDROP, votre plateforme e-commerce fiable. Qualité, rapidité et sécurité garanties.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h3>Contact</h3>
                    <p>Email : support@globaldrop.com<br>Téléphone : +212 6 00 00 00 00</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-4 small text-secondary">
            &copy; {{ date('Y') }} Global Drop - La qualité au bout du clic, la sécurité en plus.
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        const messages = [
            "Livraison gratuite sur toutes les commandes",
            "Retour facile sous 30 jours",
            "Nouvelle collection disponible maintenant",
            "Profitez de 10% de réduction avec le code WELCOME"
        ];

        let currentMessage = 0;
        const carouselElement = document.getElementById("carousel-text");

        function rotateMessages() {
            carouselElement.style.opacity = 0;
            setTimeout(() => {
                currentMessage = (currentMessage + 1) % messages.length;
                carouselElement.textContent = messages[currentMessage];
                carouselElement.style.opacity = 1;
            }, 500);
        }

        setInterval(rotateMessages, 4000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
