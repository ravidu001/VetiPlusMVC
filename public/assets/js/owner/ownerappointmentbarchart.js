// Ensure the DOM is fully loaded before creating the chart
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('appointmentChart');

    // Check if the canvas exists
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Appointments',
                    data: [65, 59, 80, 81, 56, 55],
                    borderColor: '#6a0dad',
                    backgroundColor: 'rgba(106, 13, 173, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Canceled',
                    data: [28, 48, 40, 19, 86, 27],
                    borderColor: '#8F53B4',
                    backgroundColor: 'rgba(143, 83, 180, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Appointments'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    }
                }
            }
        });
    } else {
        console.error('Canvas element not found');
    }
});
