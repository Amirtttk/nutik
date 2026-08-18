<?php
$validate_filds = validator([
    'title' => 'required',
]);
if ($validate_filds["status"]) {
    $table = 'category';
    $fields = [
        'title' => $_POST['title'],
    ];
    if (updateRecordToDatabase($table, $fields, $_POST['id'],'id')) {
        responseJson([
            'text' => ' ویرایش اطلاعات دسته بندی با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text' => 'در ویرایش دسته بندی مشکلی پیش امده است',
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



