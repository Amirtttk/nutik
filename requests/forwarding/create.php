<?php
$validate_filds = validator([
    'min_weight' => 'required',
    'base_post_cost' => 'required',
]);
if ($validate_filds["status"]) {
    $table = 'forwarding';
    $fields = [
        'id' => NULL,
        'min_weight' => $_POST['min_weight'],
        'max_weight' => $_POST['max_weight'],
        'base_post_cost' => $_POST['base_post_cost'],
        'insurance_cost' => $_POST['insurance_cost'],
        'added_value_tax' => $_POST['added_value_tax'],
    ];
    if (insertRecordToDatabase($table, $fields)) {
        responseJson([
            'text' => 'نرخ نامه با موفقیت اضافه شد ',
            'type' => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text' => 'درایجاد نرخ نامه مشکلی پیش امده است',
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



