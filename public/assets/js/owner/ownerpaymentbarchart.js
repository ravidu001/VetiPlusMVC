// Chart Configuration
const ctx = document.getElementById('paymentChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Income',
            data: [12000, 19000, 15000, 22000, 18000, 25000, 30000, 28000, 26000, 35000, 32000, 40000],
            backgroundColor: 'rgba(106, 13, 173, 0.7)',
            borderColor: 'rgba(106, 13, 173, 1)',
            borderWidth: 1
        }, {
            label: 'Expenses',
            data: [8000, 10000, 9000, 12000, 11000, 14000, 16000, 15000, 13000, 18000, 17000, 20000],
            backgroundColor: 'rgba(200, 162, 200, 0.7)',
            borderColor: 'rgba(200, 162, 200, 1)',
            borderWidth: 1
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
