<?php
$validate_filds = validator([
    'newPasswordSubmit' => 'required|password',
    'repeatNewPasswordSubmit' => 'required|password',
]);
if ($validate_filds["status"]) {
    if (POST("newPasswordSubmit") == POST("repeatNewPasswordSubmit")) {
        $password = password_hash($_POST['newPasswordSubmit'], PASSWORD_BCRYPT);

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
        'text' => 'لطفا فیلد ها را به درستی وارد کنید',
        'type' => 'warning',
        'status' => 400,
    ]);
}