<?= $this->extend('layouts/base'); ?>

<?= $this->section('css'); ?>
<!-- Adiciona o estilo CSS caso necessário -->
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container mx-auto p-6">

    <div class="mb-6 text-center">
        <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
        <canvas id="myChart"></canvas>
    </div>

    <div class="text-center">
        <a href="/clients" class="px-6 py-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Ver Todos os Clientes</a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');

    var segments = <?= json_encode($segments); ?>;
    var counts = <?= json_encode($counts); ?>;
    var distances = <?= json_encode($distances); ?>;

    var myChart = new Chart(ctx, {
        type: 'line', // Alterar para 'line' para um gráfico de linha
        data: {
            labels: segments,
            datasets: [{
                label: 'Cadastros',
                data: counts, 
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true // Preenchendo a área abaixo da linha
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            var distance = distances[tooltipItem.dataIndex];
                            return tooltipItem.label + ':'  + ' (Distância: ' + distance.toFixed(2) + ' km)';
                        }
                    }
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>
