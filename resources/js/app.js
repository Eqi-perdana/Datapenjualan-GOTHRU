import './bootstrap';
import Chart from 'chart.js/auto';

// Contoh render chart otomatis
document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById('myChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April'],
                datasets: [{
                    label: 'Penjualan',
                    data: [12, 19, 3, 5],
                    borderWidth: 1,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    }
});
