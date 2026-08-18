<?php
$validate_filds = validator([
    'shipping_code' => 'required',
]);
if ($validate_filds["status"]) {
    $table = 'orders';
    $fields = [
        'shipping_code' => $_POST['shipping_code'],
    ];
    if (updateRecordToDatabase($table, $fields, $_POST['orderId'], 'id')) {
        responseJson([
            'text' => 'کد رهگیری با موفقیت ثبت گردید و برای کاربر ارسال شد',
            'type' => 'success',
            'status' => 200,
            'shipping_code' => $_POST['shipping_code'],

        ]);
    } else {
        responseJson([
            'text' => 'در ثبت کدرهگیری مشکلی پیش امده است',
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

