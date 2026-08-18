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
        'text' => 'لطفا تمام فیلدهای الزامی را وارد کنید',
        'type' => 'error',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
    exit;
}
$uploadDir = PATH_UPLOADS_DIR . 'images/products/';
$uploadedImages = [];
$mainImage = null;
$mainImageIndex = isset($_POST['main_image_index']) ? (int)$_POST['main_image_index'] : 0;
if (!empty($_FILES['images']['name'][0])) {
    $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/gif'];
    foreach ($_FILES['images']['tmp_name'] as $index => $tmpPath) {
        $type = mime_content_type($tmpPath);
        $size = $_FILES['images']['size'][$index];
        if ($size > 2 * 1024 * 1024) {
            responseJson([
                'text' => 'حداکثر حجم هر تصویر ۲ مگابایت است',
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
        $fileName = time() . '_' . rand(1000, 9999) . '_' . basename($_FILES['images']['name'][$index]);
        $targetPath = $uploadDir . $fileName;

        if (move_uploaded_file($tmpPath, $targetPath)) {
            $uploadedImages[] = $fileName;
            if ($index === $mainImageIndex) {
                $mainImage = $fileName;
            }
        }
    }
    if (!$mainImage && !empty($uploadedImages)) {
        $mainImage = $uploadedImages[0];
    }
}
$fields = [
    'id' => null,
    'title' => $_POST['title'],
    'english_title' => $_POST['english_title'] ?? null,
    'slug' => $_POST['slug'] ?? '',
    'short_description' => $_POST['short_description'],
    'description' => $_POST['description'],
    'category_id' => $_POST['child_id'],
    'brand_id' => $_POST['brand_id'],
    'length' => (float)$_POST['length'],
    'width' => (float)$_POST['width'],
    'height' => (float)$_POST['height'],
    'actualWeight' => (float)$_POST['actualWeight'],
    'max_purchases' => $_POST['max_purchases'] ?: null,
    'token' => $_POST['token'] ?: null,
    'status' => (int)$_POST['status'],
    'special' => ($_POST['special'] == 'on' || $_POST['special'] == 1) ? 1 : 2,
    'tip' => $_POST['tip'] ?: null,
    'images' => json_encode($uploadedImages, JSON_UNESCAPED_UNICODE),
    'main_image' => $mainImage,
    'created_at' => date('Y-m-d H:i:s'),
];
if (!empty($_POST['feature_price']) && is_array($_POST['feature_price'])) {
    $multiPrices = [];
    $totalStock = 0;
    foreach ($_POST['feature_price'] as $index => $price) {
        if ($price === '') continue;
        $count = (int)($_POST['feature_count'][$index] ?? 0);
        $totalStock += $count;
        $multiPrices[] = [
            'id' => uniqid('feature_', true),
            'price' => (int)$price,
            'discount' => (int)($_POST['feature_prices_discount'][$index] ?? 0),
            'color' => $_POST['feature_color'][$index] ?? '',
            'titleColor' => $_POST['feature_title_color'][$index] ?? '',
            'count' => $count,
            'max_purchase' => (int)($_POST['feature_max_purchase'][$index] ?? 0),
        ];
    }
    if (empty($multiPrices)) {
        responseJson([
            'text' => 'حداقل یک قیمت معتبر وارد کنید',
            'type' => 'error',
            'status' => 400
        ]);
        exit;
    }
    $fields['price'] = json_encode($multiPrices, JSON_UNESCAPED_UNICODE);
    $fields['stock'] = $totalStock;
} else {
    if (empty($_POST['price'])) {
        responseJson([
            'text' => 'قیمت محصول وارد نشده است',
            'type' => 'error',
            'status' => 400
        ]);
        exit;
    }
    $fields['price'] = (int)$_POST['price'];
    $fields['stock'] = (int)($_POST['stock'] ?? 0);
}
if (!empty($_POST['feature_names']) && is_array($_POST['feature_names'])) {
    $technical = [];
    foreach ($_POST['feature_names'] as $index => $name) {
        if ($name === '') continue;
        $technical[] = [
            'name' => $name,
            'value' => $_POST['feature_values'][$index] ?? ''
        ];
    }
    $fields['technical'] = json_encode($technical, JSON_UNESCAPED_UNICODE);
}
$keywordsArray = !empty($_POST['keywords'])
    ? array_map('trim', explode(',', $_POST['keywords']))
    : [];
$fields['seo'] = json_encode([
    'title' => $_POST['title'],
    'keywords' => $keywordsArray,
    'seo_description' => $_POST['seo_description'] ?? '',
    'canonical' => $_POST['canonical'] ?? '',
], JSON_UNESCAPED_UNICODE);
if (insertRecordToDatabase('products', $fields)) {
    responseJson([
        'text' => 'محصول با موفقیت ذخیره شد',
        'type' => 'success',
        'status' => 200,
    ]);
} else {
    responseJson([
        'text' => 'خطا در ثبت محصول',
        'type' => 'error',
        'status' => 500,
    ]);
}