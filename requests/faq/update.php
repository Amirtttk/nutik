<?php

$validate_filds = validator([
    'title' => 'required',
    'description' => 'required',
]);
if ($validate_filds["status"]) {
    $table = 'faq';
    $fields = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'type' => $_POST['type'],
    ];
    if (updateRecordToDatabase($table, $fields, $_POST['id'],'id')) {
        responseJson([
            'text' => ' ویرایش سوال متداول با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text' => 'در ویرایش سوال متداول مشکلی پیش امده است',
            'type' => 'error',
            'status' => 400,
        ]);
    }
} else {
    responseJson([
        'text' => 'فیلد ها را درست وارد کنید',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}



