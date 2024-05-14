document.addEventListener("DOMContentLoaded", function() {
    // Sample data (replace with your actual data)
    const complaintTypesData = {
        labels: ['ไฟฟ้า', 'ปะปา', 'ถนน-ทางเท้า', 'ตัดต้นไม้', 'คูระบายน้ำ', 'เหตุสร้างความรำคาญ', 'อื่นๆ'],
        datasets: [{
            label: 'จำนวนการร้องเรียน',
            backgroundColor: '#36A2EB',
            borderColor: '#36A2EB',
            borderWidth: 1,
            data: [100, 80, 120, 50, 90, 60, 30] // จำนวนของแต่ละประเภทการร้องเรียน
        }]
    };

    // Create a new Chart instance
    const chartCtx = document.getElementById('complaintsChart').getContext('2d');
    const complaintsChart = new Chart(chartCtx, {
        type: 'bar',
        data: complaintTypesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});