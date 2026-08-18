<?php
$validate_filds = validator([
    'title' => 'required',
    'description' => 'required',
]);
if ($validate_filds["status"]) {
    $table = 'notifications';
    $fields = [
        'id' => NULL,
        'title' => $_POST['title'],
        'description' => $_POST['description'],
    ];
    if (insertRecordToDatabase($table, $fields)) {
        responseJson([
            'text' => '  ایجاد پیغام  با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text' => 'درایجاد پیغام  مشکلی پیش امده است',
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



