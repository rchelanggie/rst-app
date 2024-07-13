<!DOCTYPE html>
<html>

<head>
    <title>Laravel Chart.js Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>

<body>
    <div style="margin: auto;">
        <canvas id="barChart" width="700" height="470"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('barChart').getContext('2d');
            var chartData = @json($chart_data);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: chartData.datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Result'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Value'
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            formatter: function(value, context) {
                                return value;
                            },
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });

            myChart.options.animation = {
                onComplete: function() {
                    var chartUrl = myChart.toBase64Image();
                    fetch('{{ route('save.chart') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                image: chartUrl
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Chart saved:', data.image_url);
                            document.getElementById('chart-url').value = data.image_url;
                        });
                }
            };
        });
    </script>
    <input type="hidden" id="chart-url" name="chart_url">
</body>

</html>
