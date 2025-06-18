<div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="createAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.admins.storeAdmin') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createAdminModalLabel">Créer un nouvel admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>

        <div class="modal-body">

          {{-- Affichage des erreurs --}}
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
          </div>

          <div class="mb-3">
            <label for="segment" class="form-label">Segment</label>
            <select class="form-select" id="segment" name="segment" required>
              <option value="" disabled {{ old('segment') ? '' : 'selected' }}>Choisissez votre segment</option>
              <option value="homme" {{ old('segment') == 'homme' ? 'selected' : '' }}>Homme</option>
              <option value="femme" {{ old('segment') == 'femme' ? 'selected' : '' }}>Femme</option>
              <option value="jeune_homme" {{ old('segment') == 'jeune_homme' ? 'selected' : '' }}>Jeune homme (≤ 30 ans)</option>
              <option value="jeune_femme" {{ old('segment') == 'jeune_femme' ? 'selected' : '' }}>Jeune femme (≤ 30 ans)</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Créer</button>
        </div>
      </div>
    </form>
  </div>
</div>
