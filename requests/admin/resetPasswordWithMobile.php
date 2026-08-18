<?php
$validate_filds = validator([
    'mobile' => 'required|mobile',
]);
if ($validate_filds["status"]) {
    $mobile = substr(POST("mobile"), 2);
    $getOneUserByMobile = getOneUserByMobile($mobile);
    if ($getOneUserByMobile) {
        $_SESSION['confirm_code'] = generateDigit(6);
        $_SESSION['mobile'] = POST('mobile');
        responseJson([
            'text' => 'کد تایید ارسال شد',
            'type' => 'success',
            'status' => 200,
            'code' => $_SESSION['confirm_code'],
        ]);
    } else {
        responseJson([
            'text' => 'هیچ ' . TYPES_USERS[$_SESSION['admin_info']['userType']][2] . ' یافت نشد',
            'type' => 'warning',
            'status' => 400,
        ]);
    }
} else {
    responseJson([
        'text' => 'لطفا فیلد را به درستی وارد کنید',
        'type' => 'warning',
        'status' => 400,
    ]);
}