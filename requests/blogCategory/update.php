<?php
// ابتدا ولیدیشن فیلدهای ورودی
$validate_fields = validator([
    'title' => 'required',  // عنوان دسته‌بندی نباید خالی باشد
]);

if ($validate_fields['status']) {
    // جدول مربوطه
    $table = 'blog_categories';
    $fields = [
        'title'        => POST('title'),          // عنوان دسته‌بندی
    ];
    $result = updateRecordToDatabase($table, $fields, POST('id'), 'id');
    if ($result) {
        responseJson([
            'text'   => 'دسته‌بندی با موفقیت ویرایش شد.',
            'type'   => 'success',
            'status' => 200,
        ]);
    } else {
        responseJson([
            'text'   => 'در هنگام ویرایش دسته‌بندی مشکلی پیش آمده است.',
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
function reassignOrphanCategories($previousParentId, $newParentId = 0) {
    global $cn;
    $query = "UPDATE blog_categories SET parent_id = :newParentId WHERE parent_id = :previousParentId";
    $stmt = $cn->prepare($query);
    $stmt->bindParam(':newParentId', $newParentId);
    $stmt->bindParam(':previousParentId', $previousParentId);
    $stmt->execute();
}

