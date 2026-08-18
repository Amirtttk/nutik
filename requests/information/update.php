<?php
$validate_fields = validator([
]);
if ($validate_fields['status']) {
    $table = 'information';
    $fields = [
        'title_store' => $_POST['title_store'],
        'title1' => $_POST['title1'],
        'mobileHeather' => $_POST['mobileHeather'],
        'mobileHeather2' => $_POST['mobileHeather2'],
        'address' => $_POST['address'],
        'working_hours' => $_POST['working_hours'],
        'text' => $_POST['text'],
        'text2' => $_POST['text2'],
        'text3' => $_POST['text3'],
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