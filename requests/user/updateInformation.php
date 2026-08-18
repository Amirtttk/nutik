<?php
$validate_filds = validator([
    'userFullName' => 'required',
    'gender' => 'required',
]);
if ($validate_filds["status"]) {
    $fields = [
        "userFullName" => $_POST["userFullName"],
        "gender" => $_POST["gender"],
    ];
    if (updateRecordToDatabase("users_info_public", $fields, $_SESSION['user_sending'], "userID")) {
        responseJson([
            'text' => 'ویرایش اطلاعات با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);

    } else {
        responseJson([
            'text' => 'مشکلی در ویرایش اطلاعات رخ داده است',
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