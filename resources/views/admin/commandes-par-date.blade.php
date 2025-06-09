@extends('layouts.admin')

@section('content')
<h2>Commandes du {{ $start_date }} au {{ $end_date }}</h2>
<canvas id="commandesChart" height="100"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('commandesChart').getContext('2d');
    const commandesChart = new Chart(ctx, {
        type: 'bar', // ou 'line'
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Nombre de commandes',
                data: {!! json_encode($data) !!},
                backgroundColor: '#6f42c1',
                borderColor: '#59359c',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
@if($commandes->isEmpty())
    <p>Aucune commande trouvée.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Date</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->user->name ?? 'Inconnu' }}</td>
                    <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                    <td>{{ $commande->total }} CFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Retour</a>
@endsection
