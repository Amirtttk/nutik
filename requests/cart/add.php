<?php
// session_start();

$product_id = $_POST['product_id'] ?? null;
$variant_id = $_POST['variant_id'] ?? 'default';
$titleColor = $_POST['titleColor'] ?? null;
$color      = $_POST['color'] ?? null;

// محصول
$getOneProduct = getOneProduct($product_id);
if (!$getOneProduct) {
    responseJson(["status" => 400, "text" => "محصول یافت نشد"]);
}

// تصویر
$image = !empty($getOneProduct['main_image'])
    ? getProductImageUrl($getOneProduct['main_image'])
    : '';

// کلید سبد (خیلی مهم)
$itemKey = 'item_' . $product_id . '_' . $variant_id;

// محدودیت خرید
$max_purchase = (int)($getOneProduct['max_purchase'] ?? 1000);

// قیمت‌ها
$price = 0;
$discount = 0;
$availableCount = $max_purchase;

/**
 * ======================
 * محصول واریانتی واقعی
 * ======================
 */
if ($variant_id !== 'default' && !empty($getOneProduct['price'])) {

    $variants = json_decode($getOneProduct['price'], true);
    $selectedVariant = null;

    foreach ($variants as $v) {
        if ($v['id'] === $variant_id) {
            $selectedVariant = $v;
            break;
        }
    }

    if (!$selectedVariant) {
        responseJson(["status" => 400, "text" => "تنوع انتخابی معتبر نیست"]);
    }

    $price          = (float)$selectedVariant['price'];
    $discount       = (float)($selectedVariant['discount'] ?? $price);
    $availableCount = (int)($selectedVariant['count'] ?? $max_purchase);

    /**
     * ======================
     * محصول تک‌قیمتی
     * ======================
     */
} else {

    $variant_id = 'default';

    $price = (float)$getOneProduct['price'];
    $token = (int)($getOneProduct['token'] ?? 0);

    $discount = $token > 0
        ? $price - (($price * $token) / 100)
        : $price;

    $availableCount = (int)($getOneProduct['stock'] ?? $max_purchase);
}

/**
 * ======================
 * کاربر لاگین
 * ======================
 */
//dd($variant_id);
if (!empty($_SESSION['user_sending'])) {
    //dd($_SESSION['user_sending'],$product_id,$variant_id);
    $existing = getOneRecordFromCart2(
        $_SESSION['user_sending'],
        $product_id,
        $variant_id
    );
    if ($existing) {
        $items = getUserRecordFromCart($_SESSION['user_sending']);
        $totalQuantity = array_sum(array_column($items, 'quantity'));

        responseJson([
            "status" => 409,
            "type" => "info",
            "text" => "این محصول قبلاً به سبد خرید اضافه شده",
            "count" => $totalQuantity,
            "sumPrice" => sumCart($_SESSION['user_sending']),
            "itemsCart" => returnItemCart($items)
        ]);
    }

    insertRecordToDatabase('cart', [
        "user_id"    => $_SESSION['user_sending'],
        "product_id" => $product_id,
        "variant_id" => $variant_id,
        "titleColor" => $titleColor,
        "color"      => $color,
        "price"      => $price,
        "discount"   => $discount,
        "quantity"   => 1,
        "image"      => $image,
        "title"      => $getOneProduct['title'],
    ]);

    $items = getUserRecordFromCart($_SESSION['user_sending']);

    /**
     * ======================
     * کاربر مهمان (SESSION)
     * ======================
     */
} else {

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$itemKey])) {

        $totalQuantity = array_sum(
            array_column($_SESSION['cart'], 'quantity')
        );

        responseJson([
            "status" => 409,
            "type" => "info",
            "text" => "این محصول قبلاً به سبد خرید اضافه شده",
            "count" => $totalQuantity,
            "sumPrice" => sumCart(),
            "itemsCart" => $_SESSION['cart']
        ]);
    }

    $_SESSION['cart'][$itemKey] = [
        "product_id" => $product_id,
        "variant_id" => $variant_id,
        "titleColor" => $titleColor,
        "color"      => $color,
        "price"      => $price,
        "discount"   => $discount,
        "quantity"   => 1,
        "image"      => $image,
        "title"      => $getOneProduct['title'],
        "slug"       => $getOneProduct['slug']
    ];

    $items = $_SESSION['cart'];
}

// تعداد کل
$totalQuantity = array_sum(array_column($items, 'quantity'));

// پاسخ نهایی
responseJson([
    "status" => 200,
    "type" => "success",
    "text" => "محصول به سبد خرید اضافه شد",
    "count" => $totalQuantity,
    "sumPrice" => sumCart(isset($_SESSION['user_sending']) ? $_SESSION['user_sending'] : null),
    "itemsCart" => $items
]);
