@extends('layouts.admin')

@section('content')
<h2>Commandes du segment {{ $segment }} ({{ $start_date }} - {{ $end_date }})</h2>

<canvas id="segmentFilterChart" height="100"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('segmentFilterChart').getContext('2d');
    const segmentFilterChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Nombre de commandes',
                data: {!! json_encode($data) !!},
                backgroundColor: '#6610f2',
                borderColor: '#4e0ebf',
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

<a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Retour</a>
@endsection
