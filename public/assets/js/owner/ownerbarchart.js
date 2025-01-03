const revenueCtx = document.getElementById('revenueChart').getContext('2d');
const growthCtx = document.getElementById('growthChart').getContext('2d');

const revenueChart = new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Revenue',
            data: [1200, 1900, 3000, 2500, 3200, 4000],
            borderColor: 'rgba(106, 13, 173, 1)',
            backgroundColor: 'rgba(106, 13, 173, 0.2)',
            borderWidth: 2,
            fill: true,
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const growthChart = new Chart(growthCtx, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Clients',
            data: [50, 100, 150, 200, 250, 300],
            backgroundColor: 'rgba(106, 13, 173, 0.5)',
            borderColor: 'rgba(106, 13, 173, 1)',
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
