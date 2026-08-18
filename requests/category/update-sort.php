<?php
global $cn;

$validate = validator([]);
if (!$validate['status']) {
    responseJson([
        'status' => 422,
        'type' => 'warning',
        'text' => 'اطلاعات نامعتبر است'
    ]);
}

$id   = (int) POST('id');
$sort = (int) POST('sort');

/**
 * دریافت sort فعلی دسته (فقط level 0)
 */
$stmt = $cn->prepare("
    SELECT sort 
    FROM category 
    WHERE id = ? AND level = 0
");
$stmt->execute([$id]);
$current = $stmt->fetch();

if (!$current) {
    responseJson([
        'status' => 403,
        'type' => 'error',
        'text' => 'این دسته مجاز به تغییر ترتیب نیست'
    ]);
}

$currentSort = (int) $current['sort'];

/**
 * اگر تغییری نکرده
 */
if ($currentSort === $sort) {
    responseJson([
        'status' => 200,
        'type' => 'success',
        'text' => 'بدون تغییر'
    ]);
}

/**
 * بررسی وجود sort تکراری فقط بین level 0
 */
$stmt = $cn->prepare("
    SELECT id 
    FROM category 
    WHERE sort = ? 
      AND level = 0 
      AND id != ?
");
$stmt->execute([$sort, $id]);
$duplicate = $stmt->fetch();

try {
    $cn->beginTransaction();

    /**
     * اگر sort تکراری بود، فقط همون دسته اصلی جابه‌جا میشه
     */
    if ($duplicate) {
        $cn->prepare("
            UPDATE category 
            SET sort = ? 
            WHERE id = ? AND level = 0
        ")->execute([$currentSort, $duplicate['id']]);
    }

    /**
     * آپدیت دسته اصلی فعلی
     */
    $cn->prepare("
        UPDATE category 
        SET sort = ? 
        WHERE id = ? AND level = 0
    ")->execute([$sort, $id]);

    $cn->commit();

    responseJson([
        'status' => 200,
        'type' => 'success',
        'text' => 'ترتیب نمایش ذخیره شد'
    ]);

} catch (Exception $e) {

    $cn->rollBack();

    responseJson([
        'status' => 500,
        'type' => 'error',
        'text' => 'خطا در ذخیره ترتیب'
    ]);
}
