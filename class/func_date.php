<?php
    // แปลงวันที่ เป้น วันที่/เดือน/พ.ศ.

    function converToThaiDate($date) {
        $dateTime = new DateTime($date);

        // แปลงปี ค.ศ เป็น พ.ศ.
        $year = $dateTime->format('Y') + 543;
        $month = $dateTime->format('m');
        $day = $dateTime->format('d');

        return sprintf('%02d/%02d/%02d', $day,$month,$year);
    }

    function converdate($date_dc){
        $dateTime = new DateTime($date_dc);
    
        // นำปี, เดือน, และวันออกมา
        $year = $dateTime->format('Y');
        $month = $dateTime->format('m');
        $day = $dateTime->format('d');
        
        // ฟอร์แมตวันที่เป็น dd/mm/yyyy (พ.ศ.)
        return sprintf('%02d/%02d/%d', $day, $month, $year);
    }

?>