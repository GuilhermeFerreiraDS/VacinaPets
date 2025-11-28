<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Gráfico de Vacinas</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f9f9f9;
        padding: 20px;
    }

    .chart-container {
        width: 700px;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        margin: auto;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    canvas {
        width: 100% !important;
        max-width: 650px;
        height: 350px !important;
    }
</style>
</head>

<body>

<div class="chart-container">
    <h2>Vacinas Aplicadas por Ano</h2>
    <canvas id="vacinaChart"></canvas>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Dados de exemplo — edite os valores aqui
    const anos = ["2020", "2021", "2022", "2023", "2024", "2025"];
    const vacinas = [30, 45, 50, 70, 90, 110]; // quantidade de vacinas por ano

    const ctx = document.getElementById("vacinaChart").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: anos,
            datasets: [{
                label: "Vacinas aplicadas",
                data: vacinas,
                backgroundColor: "rgba(54, 162, 235, 0.6)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 2,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 10 }
                }
            }
        }
    });
</script>

</body>
</html>
