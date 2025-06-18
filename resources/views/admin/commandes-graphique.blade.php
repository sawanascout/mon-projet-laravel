@extends('layouts.app')

@section('content')
<h1>Commandes entre {{ $start_date }} et {{ $end_date }}</h1>

<canvas id="commandesChart" width="600" height="400"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('commandesChart').getContext('2d');

    const commandesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dates),
            datasets: [{
                label: 'Nombre de commandes',
                data: @json($totals),
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'time',
                    time: {
                        parser: 'YYYY-MM-DD',
                        unit: 'day',
                        displayFormats: {
                            day: 'DD/MM/YYYY'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>
<h1>Commandes entre {{ $start_date }} et {{ $end_date }}</h1>

<canvas id="chart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($dates),
            datasets: [{
                label: 'Nombre de commandes',
                data: @json($totals),
                backgroundColor: 'rgba(54, 162, 235, 0.5)'
            }]
        }
    });
</script>



@endsection
