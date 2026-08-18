<?php

$validate_fields = validator([
    'title' => 'required',
    'category_id' => 'required',
    'brand_id' => 'required',
    'length' => 'required',
    'width' => 'required',
    'height' => 'required',
    'actualWeight' => 'required',
    'short_description' => 'required',
    'description' => 'required',
]);

if (!$validate_fields['status']) {
    responseJson([
        'text' => 'لطفا فیلد ها را وارد کنید',
        'type' => 'error',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
    exit;
}

$productId = (int)POST('id');
if (!$productId) {
    responseJson([
        'text' => 'شناسه محصول نامعتبر است',
        'type' => 'error',
        'status' => 400,
    ]);
    exit;
}

$uploadDir = PATH_UPLOADS_DIR . 'images/products/';

$oldProduct = getOneProduct($productId);
if (!$oldProduct) {
    responseJson([
        'text' => 'محصول یافت نشد',
        'type' => 'error',
        'status' => 404,
    ]);
    exit;
}
$oldImages = json_decode($oldProduct['images'], true) ?? [];

// ❗ حذف تصاویر دقیقاً با رشته‌ای که JS می‌فرستد
$deletedImages = !empty($_POST['deleted_images'])
    ? explode(",", $_POST['deleted_images'])
    : [];

foreach ($deletedImages as $del) {

    $del = trim($del); // فقط حذف space اضافی اول/آخر

    if (!$del) continue;

    // از آرایه حذف شود اگر دقیقاً وجود دارد
    $key = array_search($del, $oldImages);

    if ($key !== false) {

        // حذف فایل از سرور
        $filePath = $uploadDir . $del;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        // حذف از آرایه
        unset($oldImages[$key]);
        $oldImages = array_values($oldImages);

        // اگر تصویر حذف شده تصویر اصلی بود
        if ($del === $oldProduct['main_image']) {
            $mainImage = !empty($oldImages) ? $oldImages[0] : null;
        }
    }
}
// ---- آپلود تصاویر جدید ----
$newImages = [];
$mainImageIndex = isset($_POST['main_image_index']) ? intval($_POST['main_image_index']) : 0;

if (!empty($_FILES['images']['name'][0])) {

    $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/gif'];

    foreach ($_FILES['images']['tmp_name'] as $index => $tmpPath) {

        $type = mime_content_type($tmpPath);
        $size = $_FILES['images']['size'][$index];

        if ($size > 2 * 1024 * 1024) {
            responseJson([
                'text' => 'حداکثر حجم مجاز برای هر تصویر ۲ مگابایت است',
                'type' => 'warning',
                'status' => 400
            ]);
            exit;
        }

        if (!in_array($type, $allowedTypes)) {
            responseJson([
                'text' => 'فرمت تصویر نامعتبر است',
                'type' => 'warning',
                'status' => 400
            ]);
            exit;
        }

        $fileName = time() . '_' . rand(1000, 9999) . '_' . $_FILES['images']['name'][$index];
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($tmpPath, $targetPath)) {

            $newImages[] = $fileName;

            if ($index === $mainImageIndex) {
                $mainImage = $fileName;
            }
        }
    }

    if (!isset($mainImage) && count($newImages)) {
        $mainImage = $newImages[0];
    }
}

// ---- نهایی‌سازی تصاویر ----

$finalImages = array_values(array_merge($oldImages, $newImages));

if (!empty($finalImages)) {
    $mainImage = $mainImage ?? $finalImages[0];
}

// ---- ذخیره در دیتابیس ----

$mainImage = $mainImage ?? ($finalImages[0] ?? $oldProduct['main_image'] ?? null);

$fields = [
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'category_id' => $_POST['child_id'],
    'brand_id' => $_POST['brand_id'],
    'stock' => !empty($_POST['stock']) ? $_POST['stock'] : null,
    'token' => !empty($_POST['token']) ? $_POST['token'] : null,
    'price' => $_POST['price'],
    'english_title' => $_POST['english_title'],
    'max_purchases' =>
        !empty($_POST['max_purchases']) ? (int)$_POST['max_purchases'] : null,
    'short_description' => $_POST['short_description'],
    'length' => (float)($_POST['length'] ?? 0),
    'width' => (float)($_POST['width'] ?? 0),
    'height' => (float)($_POST['height'] ?? 0),
    'actualWeight' => (float)($_POST['actualWeight'] ?? 0),
    'slug' => $_POST['slug'],
    'status' => (int)($_POST['status'] ?? 1),
    'special' => ($_POST['special'] == '1' || $_POST['special'] == 'on') ? 1 : 2,
    'tip' => !empty($_POST['tip']) ? $_POST['tip'] : null,
    'images' => json_encode($finalImages),
    'main_image' => $mainImage,
];
// قیمت ویژگی‌ها
if (isset($_POST['feature_price']) && is_array($_POST['feature_price'])) {
    $multiPrices = [];
    foreach ($_POST['feature_price'] as $index => $price) {
        $newId = uniqid('feature_', true);
        $multiPrices[] = [
            'id' => $newId,
            'price' => $price,
            'discount' => $_POST['feature_prices_discount'][$index] ?? 0,
            'color' => $_POST['feature_color'][$index] ?? '',
            'titleColor' => $_POST['feature_title_color'][$index] ?? '',
            'count' => $_POST['feature_count'][$index] ?? '',
            'max_purchase' => $_POST['feature_max_purchase'][$index] ?? '',
        ];
    }

    $fields['price'] = json_encode($multiPrices);
}
if (isset($_POST['feature_names']) && is_array($_POST['feature_names'])) {
    $specifications = [];
    foreach ($_POST['feature_names'] as $index => $name) {
        if (!empty($name) && !empty($_POST['feature_values'][$index])) {
            $specifications[] = [
                'name' => $name,
                'value' => $_POST['feature_values'][$index]
            ];
        }
    }
    if (!empty($specifications)) {
        $fields['technical'] = json_encode($specifications);
    } else {
        $fields['technical'] = null;
    }
}
$keywords = $_POST['keywords'];
$keywordsArray = explode(',', $keywords);

$seoData = [
    'title' => $_POST['title'],
    'keywords' => $keywordsArray,
    'seo_description' => $_POST['seo_description'],
    'canonical' => $_POST['canonical'] ?: '',
];

$fields['seo'] = json_encode($seoData);

$dbError = '';
if (updateRecordToDatabase('products', $fields, $productId, 'id', $dbError)) {
    responseJson([
        'text' => 'محصول با موفقیت ویرایش شد',
        'type' => 'success',
        'status' => 200,
    ]);
} else {
    responseJson([
        'text' => 'خطا در ویرایش محصول' . ($dbError ? ': ' . $dbError : ''),
        'type' => 'error',
        'status' => 500,
        'error' => $dbError,
    ]);
}