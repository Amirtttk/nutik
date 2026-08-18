<?php
$validate_filds = validator([
]);
if ($validate_filds["status"]) {
    $table = 'pages';
    $fields = [
        'title_page' => $_POST['title_page'],
        'keywords' => $_POST['keywords'],
        'description' => $_POST['description'],
        'schema' => $_POST['schema'],
    ];
    if (updateRecordToDatabase($table, $fields, $_POST['id'],'id')) {
        responseJson([
            'text' => ' ویرایش اطلاعات صفحه با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text' => 'در ویرایش اطلاعات صفحه مشکلی پیش امده است',
            'type' => 'error',
            'status' => 400,
            'error' => initFormErrors(),
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



