<?php
    function sendLineMessage($userId, $message){
        $channelToken = 'rvSJuWMnkaKPRxOFjw0HGuyaVgiBkB5+VRHLaOan0GlGpec7DBZkRNbR45CGbWB78yvSDOXxwExhPPWubTj9RqhcSulgU7pol4KSSzEjMv5Y6uNC/PG57hab1nhFCOWi1v05eDvKO/arp7TttJoXgQdB04t89/1O/w1cDnyilFU=';
        $line_api = 'https://api.line.me/v2/bot/message/push';
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $channelToken
        );

        $post_data =  array('to' => $userId,
                'messages' => array(
                    array(
                        'type' => 'text',
                        'text' => $message
                    )
                )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $line_api);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
?>