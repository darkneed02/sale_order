document.addEventListener("DOMContentLoaded", function() {
    // Sample data (replace with your actual data)
    const monthlyData = {
        labels: ['มกราคม', 'กุมพาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม'],
        datasets: [{
            label: 'จำนวนการร้องเรียน',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: [190, 120, 900, 500, 150]
        }]
    };

    // Create a new Chart instance
    const chartCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = new Chart(chartCtx, {
        type: 'bar',
        data: monthlyData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
