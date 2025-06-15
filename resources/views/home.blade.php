@extends('layouts.app')

@section('title', 'GLOBALDROP - Accueil')

@section('content')

  <div class="banniere-container mb-4 rounded shadow">
    <div class="banniere-animée">
      <img src="{{ asset('images/baniere.png') }}" alt="Bannière animée" />
    </div>
  </div>

 
  <div class="container mt-5">
    <h1>Bienvenue sur GLOBALDROP !</h1>

    <section class="mt-6 py-6 bg-white border-top border-bottom border-gray-200">
      <div class="max-w-6xl mx-auto px-4 md:px-8 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">
          Pourquoi <span style="color:#ab3fd6;">choisir GlobalDrop</span> ?
        </h2>

        <div class="d-flex flex-column flex-md-row justify-content-between gap-4">

          <div class="flex-grow-1 bg-light rounded-xl p-4 shadow-sm border hover-shadow-sm mx-2">
            <div class="mb-2">
              <!-- Icône -->
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ab3fd6" viewBox="0 0 24 24"><path d="M3 16l4-4H3V8l5-5h11a2 2 0 012 2v12a2 2 0 01-2 2H5l-2 2v-4z"/></svg>
            </div>
            <h3 class="h5">Livraison rapide</h3>
            <p>Nous livrons rapidement partout au Togo grâce à notre logistique performante.</p>
          </div>

          <div class="flex-grow-1 bg-light rounded-xl p-4 shadow-sm border hover-shadow-sm mx-2">
            <div class="mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ab3fd6" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 1.343-3 3v3h6v-3c0-1.657-1.343-3-3-3z"/><path d="M20 12v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6"/></svg>
            </div>
            <h3 class="h5">Prix compétitifs</h3>
            <p>Profitez des meilleurs tarifs sur des produits tendance et de qualité.</p>
          </div>

          <div class="flex-grow-1 bg-light rounded-xl p-4 shadow-sm border hover-shadow-sm mx-2">
            <div class="mb-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ab3fd6" viewBox="0 0 24 24"><path d="M12 11c.828 0 1.5-.672 1.5-1.5S12.828 8 12 8s-1.5.672-1.5 1.5S11.172 11 12 11z"/><path d="M4 6h16M4 10h16M10 14h4"/></svg>
            </div>
            <h3 class="h5">Paiement sécurisé</h3>
            <p>Notre plateforme garantit des paiements sûrs et protégés à 100 %.</p>
          </div>

        </div>
      </div>
    </section>

    <p class="mt-4">Découvrez nos derniers produits :</p>

    <div class="row mb-5 produit-highlight">
      @forelse($produits->take(4) as $produit)
      <div class="col-md-3 mb-4">
        <div class="card produit-card">
          @if($produit->photo)
          <img src="{{ asset('storage/' . $produit->photo) }}" class="card-img-top" alt="Photo du produit">
          @endif
          <div class="card-body">
            <h5 class="text-mauve">{{ $produit->nom }}</h5>
            <p>Prix : {{ number_format($produit->prix, 2) }} €</p>
            <p>Catégorie : {{ $produit->categorie->nom ?? 'N/A' }}</p>
          </div>
          <div class="card-footer text-center">
            <a href="{{ route('produits.show', $produit) }}" class="btn btn-primary">Voir détails</a>
          </div>
        </div>
      </div>
      @empty
      <p>Aucun produit disponible actuellement.</p>
      @endforelse

      <div class="text-center mt-4">
        <a href="{{ route('produits.index') }}" class="btn btn-outline-secondary">Voir tous les produits</a>
      </div>
    </div>

  </div>

  <!-- Bannière vidéo flottante -->
  <div id="videoAdBanner" class="d-flex">
    <div class="video-container">
      <button id="closeVideoAd" class="close-btn" aria-label="Fermer la vidéo">&times;</button>
      <button id="toggleSound" class="sound-btn" aria-label="Activer ou désactiver le son">🔇 Son</button>
      <a href="http://www.tiktok.com/@globaldrop41" target="_blank" rel="noopener noreferrer" tabindex="0" style="display:block;position:relative;z-index:5;">
        <video id="adVideo" autoplay muted loop playsinline>
          <source src="{{ asset('videos/ma-video.mp4') }}" type="video/mp4" />
          Votre navigateur ne prend pas en charge la lecture vidéo.
        </video>
        <div class="overlay-text">
          <h2>🔥 Découvrez nos offres exclusives sur TikTok !</h2>
          <p>⚡ Dépêchez-vous, les stocks sont limités !</p>
        </div>
      </a>
    </div>
  </div>

  <!-- Bouton WhatsApp flottant -->
  <a href="https://wa.me/22890171179" target="_blank" class="position-fixed bottom-0 end-0 m-4 bg-success text-white p-3 rounded-circle shadow-lg d-flex align-items-center justify-content-center" aria-label="Contact WhatsApp" style="width:56px; height:56px;">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="28" height="28">
      <path d="M20.52 3.48a11.91 11.91 0 0 0-16.84 0 11.91 11.91 0 0 0-2.55 12.93L2 21l4.69-1.23a11.92 11.92 0 0 0 13.83-16.29zM12 19a7 7 0 0 1-3.68-1.03l-.26-.15-2.21.58.59-2.15-.17-.28A7 7 0 1 1 12 19zm3.44-4.33c-.2-.1-1.18-.58-1.36-.65s-.31-.1-.44.1-.51.65-.62.78-.23.15-.43.05a5.7 5.7 0 0 1-1.68-1.04 6.37 6.37 0 0 1-1.18-1.46c-.12-.2 0-.31.08-.41s.19-.23.29-.34a.5.5 0 0 0 .07-.46c-.07-.15-.44-1.06-.6-1.46s-.32-.34-.44-.34-.26-.02-.4-.02a.83.83 0 0 0-.6.29 2.55 2.55 0 0 0-.77 1.83 4.42 4.42 0 0 0 .84 2.11 9.14 9.14 0 0 0 4.32 3.71 5.09 5.09 0 0 0 2.26.39 3.54 3.54 0 0 0 2.26-1.44 3.68 3.68 0 0 0 .25-1.42c0-.24-.18-.34-.38-.44z" />
    </svg>
  </a>

  <!-- Bootstrap JS + Popper (optionnel, pour bootstrap JS components) -->

@endsection
@push('scripts')
  <script>
    const adBanner = document.getElementById('videoAdBanner');
    const closeBtn = document.getElementById('closeVideoAd');
    const toggleSoundBtn = document.getElementById('toggleSound');
    const video = document.getElementById('adVideo');

    // Affiche la vidéo après 15 secondes
    setTimeout(() => {
      adBanner.style.display = 'flex';
    }, 15000);

    // Fermer la vidéo et la faire réapparaître après 60 secondes
    closeBtn.addEventListener('click', () => {
      adBanner.style.display = 'none';
      setTimeout(() => {
        adBanner.style.display = 'flex';
      }, 60000);
    });

    // Activer / désactiver le son
    toggleSoundBtn.addEventListener('click', () => {
      if (video.muted) {
        video.muted = false;
        video.volume = 1;
        toggleSoundBtn.textContent = '🔊 Muet';
      } else {
        video.muted = true;
        toggleSoundBtn.textContent = '🔇 Son';
      }
    });
  </script>
  @endpush


