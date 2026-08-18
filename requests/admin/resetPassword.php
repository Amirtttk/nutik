<?php
$validate_filds = validator([
    'password' => 'required|password',
    'newPassword' => 'required|password',
    'repeatNewPassword' => 'required|password',
]);
if ($validate_filds["status"]) {
    $getOneUserByPassword = getOneUserByPassword(POST('password'), TYPES_USERS[$_SESSION['admin_info']['userType']][0]);
    if ($getOneUserByPassword) {
        if (POST("newPassword") == POST("repeatNewPassword")) {
            $password = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);

            $fields = [
                "password" => $password
            ];
            if (updateRecordToDatabase(TYPES_USERS[$_SESSION['admin_info']['userType']][0], $fields, $_SESSION['admin_info']['userID'], "userID")) {
                responseJson([
                    'text' => 'رمز عبور با موفقیت ویرایش شد ',
                    'type' => 'success',
                    'status' => 200,
                ]);
            }
        } else {
            responseJson([
                'text' => 'رمز عبور جدید با تکرارش برابر نیست',
                'type' => 'warning',
                'status' => 400,
            ]);
        }
    } else {
        responseJson([
            'text' => 'رمز عبور وارد شده اشتباه می باشد',
            'type' => 'warning',
            'status' => 400,
        ]);
    }
} else {
    responseJson([
        'text' => 'لطفا فیلد ها را به درستی وارد کنید',
        'type' => 'warning',
        'status' => 400,
    ]);
}