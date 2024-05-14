$(document).ready(function() {
    const menuItems = document.querySelectorAll('.nav-item');     // วนลูปผ่านเมนูทั้งหมด    
    menuItems.forEach(item => {         // ตรวจสอบ URL และเปรียบเทียบกับ href ของเมนู
        if (window.location.href.includes(item.querySelector('.nav-link').getAttribute('href'))) {             // ถ้า URL ตรงกับ href ของเมนู ให้เพิ่มคลาส 'active'            
            item.classList.add('active'); } 
    });
    
    const links = document.querySelectorAll('.collapse-item');     // วนลูปผ่านลิงก์ทั้งหมด    
    links.forEach(link => {         // ตรวจสอบ URL และเปรียบเทียบกับ href ของลิงก์
    if (window.location.href.includes(link.getAttribute('href'))) {             // ถ้า URL ตรงกับ href ของลิงก์ ให้เพิ่มคลาส 'active'            
        link.classList.add('active'); } 
    }); 
});