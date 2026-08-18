<?php
$validate_fields = validator([
]);
if ($validate_fields['status']) {
    $table = 'information';
    $fields = [
        'color' => $_POST['color'],
        'color2' => $_POST['color2'],
        'color3' => $_POST['color3'],
        'theme' => $_POST['theme'],
        'font' => $_POST['font'],
    ];
    if (updateRecordToDatabase($table, $fields, POST('id'), 'id')) {
        responseJson([
            'text' => 'ویرایش اطلاعات تم سایت با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);
       
    } else {
        responseJson([
            'text' => 'در ویرایش اطلاعات تم سایت مشکلی پیش آمده است',
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