<?php
$validate_fields = validator([
]);
if ($validate_fields['status']) {
    $table = 'advertising_banner';
    $fields = [
        'link' => $_POST['link'],
        'title' => $_POST['title'],
        'description' => $_POST['description'],
    ];
    if (updateRecordToDatabase($table, $fields, POST('id'), 'id')) {
        responseJson([
            'text' => '                                        ویرایش  بنر تبلیغ محصول با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
        ]);
       
    } else {
        responseJson([
            'text' => 'در ویرایش  بنر مشکلی پیش آمده است',
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