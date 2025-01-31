<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
        }

        .part2header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eef2f5;
        }

        .part2header p {
            font-size: 1.5em;
            font-weight: 500;
            color: #2d3748;
            margin:5px;
        }

        #selectweek {
            padding: 5px 10px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.95em;
            color: #4a5568;
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 1em;
            padding-right: 40px;
        }

        #selectweek:hover {
            border-color: #ab5fe1;
            background-color: #f7fafc;
        }

        #selectweek:focus {
            border-color: #6A0DAD;
            box-shadow: 0 0 0 3px rgba(106, 13, 173, 0.15);
        }

        .chart-container {
            height: 400px;
            margin-top: 30px;
            padding: 20px;
            border-radius: 12px;
            background: linear-gradient(to right, #f7fafc, white);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 25px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        .stat-value {
            font-size: 1.8em;
            font-weight: 600;
            color: #6A0DAD;
            margin: 10px 0 5px;
        }

        .stat-label {
            color: black;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="dashcontent">
        <div class="part1">
            <div class="part2header">
                <p>📊 Weekly Capacity Overview</p>
                <label for="options">
                    <select name="option" id="selectweek">
                        <option value="thisweek">This Week</option>
                        <option value="lastweek">Last Week</option>
                    </select>
                </label>
            </div>
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-value">400</div>
                    <div class="stat-label">Appointments</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-value" id="peakDay">Tues</div>
                    <div class="stat-label">Busiest Day</div>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="appointmentsChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const appointmentsData = {
            thisweek: {
                labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                data: [45, 65, 85, 55, 70, 75, 50]
            },
            lastweek: {
                labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                data: [40, 60, 80, 65, 55, 70, 45]
            }
        };

        const updateStats = (data) => {
            const average = (data.reduce((a, b) => a + b, 0) / data.length).toFixed(1);
            const maxValue = Math.max(...data);
            const peakDayIndex = data.indexOf(maxValue);
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            document.getElementById('averageOccupancy').textContent = average + '%';
            document.getElementById('peakOccupancy').textContent = maxValue + '%';
            document.getElementById('peakDay').textContent = days[peakDayIndex];
        };

        const ctx = document.getElementById('appointmentsChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, '#ab5fe1');
        gradient.addColorStop(1, 'rgba(171, 95, 225, 0.2)');

        let appointmentsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: appointmentsData.thisweek.labels,
                datasets: [{
                    label: 'Capacity',
                    data: appointmentsData.thisweek.data,
                    backgroundColor: gradient,
                    borderColor: '#6A0DAD',
                    borderWidth: 2,
                    borderRadius: 7,
                    barThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + '%';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            },
                            stepSize: 20,
                            font: {
                                size: 12
                            },
                            color: 'black'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            color: 'black'
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });

        // Initialize stats
        updateStats(appointmentsData.thisweek.data);

        document.getElementById('selectweek').addEventListener('change', function(e) {
            const selectedWeek = e.target.value;
            appointmentsChart.data.labels = appointmentsData[selectedWeek].labels;
            appointmentsChart.data.datasets[0].data = appointmentsData[selectedWeek].data;
            appointmentsChart.update();
            updateStats(appointmentsData[selectedWeek].data);
        });
    </script>
</body>
</html>