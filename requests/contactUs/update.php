<?php
$validate_fields = validator([
]);
if ($validate_fields['status']) {
    $table = 'information';
    $fields = [
        'email' => $_POST['email'],
        'post_code' => $_POST['post_code'],
        'address' => $_POST['address'],
        'working_hours' => $_POST['working_hours'],
    ];
    if (updateRecordToDatabase($table, $fields, POST('id'), 'id')) {
        responseJson([
            'text' => 'ویرایش اطلاعات سایت  با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);

    } else {
        responseJson([
            'text' => 'در ویرایش اطلاعات سایت  مشکلی پیش آمده است',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
    }
} else {
    responseJson([
        'text' => 'فلید ها را به درستی پر کنید',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}
