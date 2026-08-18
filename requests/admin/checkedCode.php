<?php
$validate_filds = validator([
    'code' => 'required|code',
]);
if ($validate_filds["status"]) {
    if (POST('code') == $_SESSION['confirm_code']) {
        responseJson([
            'text' => 'کد تایید شد ، پسورد جدید را وارد کنید',
            'type' => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text' => 'کد وارد شده اشتباه میباشد',
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