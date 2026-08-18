<?php
$count = checkLoginAttempts($_SERVER['REMOTE_ADDR'], time());
$count2 = checkLoginAttempts($_SERVER['REMOTE_ADDR'], time(), 'req');
$text = '';
$status = 400;
if ($count < 5 && $count2 < 15) {
    $validate_filds = validator([
        'mobile' => 'required|mobile',
    ]);
    if ($validate_filds["status"]) {
        $getUserByMobile = getUserByMobile((int) substr(POST('mobile'), 2));
        $code = generateDigit(6);
        $_SESSION['confirm_code'] = $code;
        $_SESSION['confirm_code_time'] = time();
        $_SESSION['mobile'] = (int) substr(POST('mobile'), 2);
        if ($count < 5) {
            $_SESSION['type_request'] = 'login';
            if ($getUserByMobile) {
                $fields = [
                    "userIp" => $_SERVER['REMOTE_ADDR'],
                    "time" => time(),
                ];
                if (insertRecordToDatabase("request_login", $fields)) {
                    $_SESSION['yesLogin'] = true;
                    //smsSender(POST('mobile'), $code, null, null, SMS_SERVICE['templates']['login']);
                    // send sms
                    responseJson([
                        'text' => 'کد تایید ارسال شد',
                        'type' => 'success',
                        'status' => 200,
                        'code' => $_SESSION['confirm_code'],
                    ]);

                } else {
                    $text = 'مشکلی در ارسال کد تایید رخ داده است , لطفا دوباره امتحان کنید';
                }
            } else {
                $fields = [
                    "userIp" => $_SERVER['REMOTE_ADDR'],
                    "time" => time(),
                ];
                if (insertRecordToDatabase("request_login", $fields)) {
                    $_SESSION['yesLogin'] = false;
                    $_SESSION['type_request'] = 'register';
                    //smsSender(POST('mobile'), $code, null, null, SMS_SERVICE['templates']['register']);
                    // send sms
                    responseJson([
                        'text' => 'کد تایید ارسال شد',
                        'type' => 'success',
                        'status' => 200,
                        'code' => $_SESSION['confirm_code'],
                    ]);
                } else {
                    $text = 'مشکلی در ارسال کد تایید رخ داده است , لطفا دوباره امتحان کنید';
                }
            }
        }
    } else {
        $text = 'شماره تلفن را به درستی وارد کنید';
    }
} else {
    $status = 500;
    $text = 'شما به علت فعالیت غیر مجاز توسط سایت بلاک شدید , 10 دقیقه دیگر دوباره امتحان کنید';
}

$fields = [
    "userIp" => $_SERVER['REMOTE_ADDR'],
    "time" => time(),
    "type" => 'req',
];
insertRecordToDatabase("request_login", $fields);
responseJson([
    'text' => $text,
    'type' => 'warning',
    'status' => $status,
]);