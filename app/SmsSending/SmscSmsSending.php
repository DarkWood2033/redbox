<?php

namespace App\SmsSending;

class SmscSmsSending implements SmsSending
{
    const LOGIN = 'rdbx';
    const PASSWORD = 'ea1c2o1m';

    public function send(string $phone_number, string $message): bool
    {
        $query = curl_init();
        curl_setopt_array($query, array(
            CURLOPT_URL => 'https://smsc.ru/sys/send.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'login' => self::LOGIN,
                'psw' => self::PASSWORD,
                'phones' => $phone_number,
                'mes' => $message,
            ])
        ));
        curl_exec($query);
        curl_close($query);
        return true;
    }
}
