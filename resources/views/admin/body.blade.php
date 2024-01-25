<style>
    .bar-chart-section {
        padding: 20px;
    }

    .bar-chart-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .bar-chart-block {
        background-color: #2d3035;
        border: 1px solid #dddddd31;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .bar-chart-block canvas {
        width: 100%;
        height: auto;
    }
</style>

<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
        </div>
    </div>
    <section class="bar-chart-section">
        <div class="bar-chart-container">
            <div class="bar-chart-block">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    fetch('/getChartData')
        .then(response => response.json())
        .then(data => {
            console.log('Data:', data);

            const dates = data.map(entry => entry.date);
            const postCounts = data.map(entry => entry.post_count);
            // const userCounts = data.map(entry => entry.user_count);

            // console.log('Dates:', dates);
            // console.log('Post Counts:', postCounts);
            // console.log('User Counts:', userCounts);

            // Get the canvas element for the line chart
            const lineChartCanvas = document.getElementById("lineChart").getContext("2d");

            // Create the line chart

            new Chart(lineChartCanvas, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [
                        {
                            label: 'Total Posts Over Time',
                            data: postCounts,
                            fill: true,
                            borderColor: '#DB6574',
                            pointStyle: 'circle',
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 2,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: false,
                        //  stacked: true,


                        },

                    },
                },
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});


</script>
