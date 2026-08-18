<?php
$validate_fields = validator([
]);
if ($validate_fields['status']) {
    $table = 'information';
    $fields = [
        'title_store' => $_POST['title_store'],
        'mobileHeather' => $_POST['mobileHeather'],
        'text' => $_POST['text'],
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