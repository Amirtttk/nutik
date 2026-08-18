<?php

$validate_filds = validator([
    'description' => 'required',
]);
if ($validate_filds["status"]) {
    $table = 'aboutus';
    $fields = [
        'description' => $_POST['description'],
    ];
    if (updateRecordToDatabase($table, $fields, $_POST['id'],'id')) {
        responseJson([
            'text' => ' ویرایش درباره ما با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text' => 'در ویرایش درباره ما مشکلی پیش امده است',
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



