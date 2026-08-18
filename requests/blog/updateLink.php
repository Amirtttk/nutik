<?php
// ابتدا ولیدیشن فیلدهای ورودی
$validate_fields = validator([
    'link_blog' => 'required',
]);

if ($validate_fields['status']) {
    // جدول مربوطه
    $table = 'information';
    $fields = [
        'link_blog'        => POST('link_blog'),
    ];
    $result = updateRecordToDatabase($table, $fields, POST('id'), 'id');
    if ($result) {
        responseJson([
            'text'   => 'لینک بنر مقالات با موفقیت ویرایش شد ',
            'type'   => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text'   => 'درویرایش مشکلی پیش آمده با پشتیبانی تماس بگیرید ',
            'type'   => 'warning',
            'status' => 400,
            'error'  => initFormErrors(),
        ]);
    }
} else {
    responseJson([
        'text'   => 'لطفاً تمامی فیلدها را به درستی تکمیل کنید.',
        'type'   => 'warning',
        'status' => 400,
        'error'  => initFormErrors(),
    ]);
}
