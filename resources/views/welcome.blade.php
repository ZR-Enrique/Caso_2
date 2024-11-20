@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="hero-section text-center" style="background-color: #f8f9fa; padding: 50px 0;">
    <h1>Bienvenido a Caso2Tech</h1>
    <p>Soluciones innovadoras para tu negocio</p>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Contactos</h5>
                    <p class="card-text">Muestra la cantidad de contactos registrados.</p>
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary">Ver Contactos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Campañas Activas</h5>
                    <p class="card-text">Revisa las campañas de marketing activas.</p>
                    <a href="#" class="btn btn-primary">Ver Campañas</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Etiquetas Disponibles</h5>
                    <p class="card-text">Gestiona las etiquetas para clasificar tus contactos.</p>
                    <a href="{{ route('tags.index') }}" class="btn btn-primary">Ver Etiquetas</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="text-center">Estadísticas Recientes</h2>
    <div class="row">
        <div class="col-md-4">
            <canvas id="barChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="pieChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfica de Barras (ya existente)
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
            datasets: [{
                label: 'Nuevos Contactos',
                data: [12, 19, 3, 5],
                backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfica Circular
    var ctxPie = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Contactos Activos', 'Contactos Inactivos'],
            datasets: [{
                data: [60, 40], // Ejemplo de datos para contactos activos/inactivos
                backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    // Gráfica de Líneas
    var ctxLine = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
            datasets: [{
                label: 'Crecimiento de Contactos',
                data: [5, 10, 15, 20],
                fill: false,
                borderColor: 'rgba(153, 102, 255, 1)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<footer class="bg-dark text-white text-center p-4 mt-5">
    <p>&copy; 2024 Caso2Tech - Todos los derechos reservados</p>
    <a href="#" class="text-white">Política de Privacidad</a> | 
    <a href="#" class="text-white">Términos y Condiciones</a>
</footer>

@endsection
