<?php

/**
 * @param $phone
 * @param $msg
 */
function sendSMS($phone,$msg) {

    if ($phone && $msg) {
        $email = urlencode(getSetting('API_LOGIN'));
        $api_key = getSetting('API_KEY');
        $sign = getSetting('SERVICE_NAME');

        \Ixudra\Curl\Facades\Curl::to('https://' .  $email . ':' .  $api_key . '@gate.smsaero.ru/v2/sms/send?number=' . $phone . '&text=' . $msg . '&sign=' .  $sign . '&channel=DIRECT')->get();
    }
}

