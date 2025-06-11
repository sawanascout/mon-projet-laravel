 <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action="{{ route('admin.commandes.dates') }}" method="POST">
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="dateModalLabel">Filtrer les commandes par date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Date de début</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Filtrer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
            </div>
        </div>
    </div>