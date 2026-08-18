<?php
$count = checkLoginAttempts($_SERVER['REMOTE_ADDR'], time());
if($count < 5) {
    $fields = [
        "userIp" => $_SERVER['REMOTE_ADDR'],
        "time" => time(),
    ];
    if(insertRecordToDatabase("request_login", $fields)) {
        $code = generateDigit(6);
        $_SESSION['confirm_code'] = $code;
        $_SESSION['confirm_code_time'] = time();
        if($_SESSION['type_request'] == 'login') {
            //smsSender($_SESSION['mobile'], $code, null, null, SMS_SERVICE['templates']['login']);
            // send sms
        } else {
            //smsSender($_SESSION['mobile'], $code, null, null, SMS_SERVICE['templates']['register']);
            // send sms
        }
        responseJson([
            'text' => 'کد تایید جدید ارسال شد',
            'type' => 'success',
            'status' => 200,
            'code' => $code,
        ]);
    } else {
        responseJson([
            'status' => 1000,
        ]);
    }
} else {
    responseJson([
        'status' => 1000,
    ]);
}