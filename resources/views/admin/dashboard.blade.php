@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-4">Admin Dashboard</h1>

    <!-- Cartes d'informations -->
    <div class="row">
        <div class="col-lg-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Documents Totals</h5>
                    <p class="card-text display-4">{{ $totalDocuments }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs Totals</h5>
                    <p class="card-text display-4">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Répertoires Totals</h5>
                    <p class="card-text display-4">{{ $totalClassifications }}</p>
                </div>
            </div>
        </div>
    </div>

        <!-- Graphique pour les jours de la semaine -->
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">Sous-répertoires créés cette semaine</div>
                <div class="card-body">
                    <canvas id="weeklySubdirectoriesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Graphique pour les jours de la semaine
    var ctx2 = document.getElementById('weeklySubdirectoriesChart').getContext('2d');
    var weeklySubdirectoriesChart = new Chart(ctx2, {
        type: 'bar', // Type de graphique : bar
        data: {
            labels: {!! json_encode(array_keys($subdirectoriesPerDay)) !!}, // Les jours de la semaine (lundi à dimanche)
            datasets: [{
                label: 'Sous-répertoires créés',
                data: {!! json_encode(array_values($subdirectoriesPerDay)) !!}, // Les données pour chaque jour
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Commence l'axe Y à zéro
                }
            }
        }
    });
</script>
@endsection
