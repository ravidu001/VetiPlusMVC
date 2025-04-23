document.addEventListener('DOMContentLoaded', function () {
    fetch('/AdminAppointment/monthlyChartData')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('appointmentChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(106, 13, 173, 0.7)');
            gradient.addColorStop(1, 'rgba(106, 13, 173, 0.1)');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Appointments',
                        data: data,
                        backgroundColor: gradient,
                        borderColor: '#6a0dad',
                        borderWidth: 2,
                        borderRadius: 10,
                        hoverBackgroundColor: '#6a0dad'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#6a0dad',
                            titleColor: 'white',
                            bodyColor: 'white',
                            cornerRadius: 5,
                            padding: 10
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)',
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeOutQuart'
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }
                }
            });
        })
        .catch(error => console.error('Chart fetch error:', error));
});
