<!DOCTYPE html>
<html>

<head>
    <title>Laravel Chart.js Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
</head>

<body>
    <div style="margin: auto;">
        <canvas id="barChart" width="1000" height="470"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('barChart').getContext('2d');
            var chartData = @json($chart_data);

            // Log the chartData to verify its structure
            console.log("chartData:", chartData);

            // Initialize totals array with zeros
            var totals = Array(chartData.labels.length).fill(0);

            // Calculate total values for each label (attribute)
            chartData.labels.forEach((label, index) => {
                chartData.datasets.forEach(dataset => {
                    totals[index] += parseFloat(dataset.data[index]);
                });
            });

            // Log the totals to verify the calculation
            console.log("totals:", totals);

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
                            },
                            ticks: {
                                beginAtZero: true,
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            formatter: function(value, context) {
                                var total = totals[context.dataIndex];
                                if (total > 0) {
                                    var percentage = (value / total * 100).toFixed(2);
                                    return percentage + '%';
                                } else {
                                    return '0%';
                                }
                            },
                            font: {
                                weight: 'bold'
                            }
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 30 // Add padding between legend and chart
                            }
                        }
                    },
                    layout: {
                        padding: {
                            top: 30,
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
