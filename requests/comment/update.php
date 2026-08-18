<?php

$validate_filds = validator([
    'text_admin' => 'required',
]);
if ($validate_filds["status"]) {
    $table = 'comments';
    $fields = [
        'text_admin' => $_POST['text_admin'],
    ];
    if (updateRecordToDatabase($table, $fields, $_POST['id'],'id')) {
        responseJson([
            'text' => 'نظر شما با موفقیت ثبت گردید ',
            'type' => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text' => 'در ارسال نظر مشکلی پیش امده است',
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


