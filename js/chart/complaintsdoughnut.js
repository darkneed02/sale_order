document.addEventListener("DOMContentLoaded", function() {
    // Sample data (replace with your actual data)
    const doughnutData = {
        labels: ['ไฟฟ้า', 'ปะปา', 'ถนน-ทางเท้า', 'ตัดต้นไม้', 'คูระบายน้ำ', 'เหตุสร้างความรำคาญ', 'อื่นๆ'],
        datasets: [{
            label: 'จำนวนการร้องเรียน',
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF8C00', '#FFD700'],
            data: [50, 30, 20, 10, 5, 8, 12] // จำนวนของแต่ละประเภทการร้องเรียน
        }]
    };

    // Create a new Chart instance
    const chartCtx = document.getElementById('complaintsdoughnutChart').getContext('2d');
    const complaintsdoughnutChart = new Chart(chartCtx, {
        type: 'doughnut',
        data: doughnutData,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
});