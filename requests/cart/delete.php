<?php
$product_id = $_POST['product_id'] ?? null;
$variant_id = $_POST['variant_id'] ?? 'default';
if (!$product_id) {
    responseJson([
        "status" => 400,
        "text"   => "شناسه محصول نامعتبر است",
        "type"   => "error",
    ]);
}
// کلید آیتم (دقیقاً مطابق add)
$itemKey = 'item_' . $product_id . '_' . $variant_id;
/**
 * =========================
 * کاربر لاگین (دیتابیس)
 * =========================
 */
if (!empty($_SESSION['user_sending'])) {

    $existing = getOneRecordFromCart(
        $_SESSION['user_sending'],
        $product_id,
        $variant_id
    );

    if (!$existing) {
        responseJson([
            "status" => 404,
            "text"   => "این آیتم در سبد خرید وجود ندارد",
            "type"   => "warning",
        ]);
    }

    deleteItemFromCart($existing['id']);

    $items = getUserRecordFromCart($_SESSION['user_sending']);

    responseJson([
        "status"    => 200,
        "text"      => "محصول با موفقیت از سبد خرید حذف شد",
        "type"      => "success",
        "count"     => $items ? array_sum(array_column($items, 'quantity')) : 0,
        "sumPrice"  => sumCart($_SESSION['user_sending']),
        "itemsCart" => returnItemCart($items),
    ]);
}

/**
 * =========================
 * کاربر مهمان (SESSION)
 * =========================
 */
else {

    if (!isset($_SESSION['cart'][$itemKey])) {
        responseJson([
            "status" => 404,
            "text"   => "این آیتم در سبد خرید وجود ندارد",
            "type"   => "warning",
        ]);
    }

    unset($_SESSION['cart'][$itemKey]);

    $totalQuantity = array_sum(
        array_column($_SESSION['cart'], 'quantity')
    );

    responseJson([
        "status"    => 200,
        "text"      => "محصول با موفقیت از سبد خرید حذف شد",
        "type"      => "success",
        "count"     => $totalQuantity,
        "sumPrice"  => sumCart(),
        "itemsCart" => $_SESSION['cart'],
    ]);
}
