<!DOCTYPE html>
<html>
<head>
    <title>Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<h1>Chart Example</h1>
<div>
    <label for="chartType">Chart Type:</label>
    <select id="chartType" name="chartType">
        <option value="bar">Bar Chart</option>
        <option value="pie">Pie Chart</option>
        <option value="line">Line Chart</option>
    </select>
    <button id="generateChartBtn">Generate Chart</button>
</div>
<canvas id="chartCanvas"></canvas>

<script>
    var chartTypeSelect = document.getElementById('chartType');
    var generateChartBtn = document.getElementById('generateChartBtn');
    var chartCanvas = document.getElementById('chartCanvas');
    var chartData = {!! json_encode($chartData) !!};
    var currentChart = null;

    generateChartBtn.addEventListener('click', function() {
        var chartType = chartTypeSelect.value;
        renderChart(chartType);
    });

    function renderChart(chartType) {
        if (currentChart) {
            currentChart.destroy();
        }

        var ctx = chartCanvas.getContext('2d');
        currentChart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Number of Rooms',
                    data: chartData.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
    }

    renderChart('bar');
</script>
</body>
</html>
