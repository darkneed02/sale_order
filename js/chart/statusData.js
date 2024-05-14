document.addEventListener("DOMContentLoaded", function() {
    // Sample data (replace with your actual data)
    const statusData = {
        labels: ['ดำเนินการ', 'เสร็จสิ้น', 'ยกเลิก'],
        datasets: [{
            label: 'สถานะ',
            backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384'],
            data: [300, 100, 50] // จำนวนของแต่ละสถานะ
        }]
    };

    // Create a new Chart instance
    const chartCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(chartCtx, {
        type: 'doughnut',
        data: statusData,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});