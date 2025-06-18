@extends('layouts.app')

@section('content')
<h1>Avis pour le produit : {{ $produit->nom ?? $produit->name }}</h1>

<p>Moyenne des notes : {{ $moyenne }} / 5</p>
<p>Taux de satisfaction : {{ $tauxSatisfaction }} %</p>

<canvas id="avisChart" width="600" height="400"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('avisChart').getContext('2d');
    
    const avisChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($notes),
            datasets: [{
                label: 'Nombre d\'avis',
                data: @json($avisCounts),
                backgroundColor: 'rgba(75, 192, 192, 0.7)'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>

@endsection
