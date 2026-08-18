<?php

$product_id = (int)($_POST['product_id'] ?? 0);
$variant_id = $_POST['variant_id'] ?? 'default';
$action     = $_POST['item'] ?? null;

if (!$product_id || !$action) {
    responseJson(["status" => 400, "text" => "درخواست نامعتبر است"]);
}

$getOneProduct = getOneProduct($product_id);
if (!$getOneProduct) {
    responseJson(["status" => 404, "text" => "محصول یافت نشد"]);
}

$itemKey = 'item_' . $product_id . '_' . $variant_id;

$maxPurchase = (int)($getOneProduct['max_purchases'] ?? 0);
$stock       = (int)($getOneProduct['stock'] ?? 0);
if ($variant_id !== 'default' && !empty($getOneProduct['price'])) {
    $variants = json_decode($getOneProduct['price'], true);
    if (is_array($variants)) {
        foreach ($variants as $v) {
            if (($v['id'] ?? '') === $variant_id) {
                $stock = (int)($v['count'] ?? $stock);
                if (!empty($v['max_purchases'])) {
                    $maxPurchase = (int)$v['max_purchases'];
                }
                break;
            }
        }
    }
}
if ($stock <= 0) {
    responseJson([
        "status" => 400,
        "type"   => "warning",
        "text"   => "این محصول ناموجود است"
    ]);
}
function checkLimit($quantity, $maxPurchase, $stock)
{
    if ($quantity > $stock) {
        responseJson([
            "status" => 400,
            "type"   => "warning",
            "text"   => "تنها {$stock} عدد از این محصول موجود است",
        ]);
    }
    if ($maxPurchase > 0 && $quantity > $maxPurchase) {
        responseJson([
            "status" => 400,
            "type"   => "warning",
            "text"   => "حداکثر تعداد مجاز خرید {$maxPurchase} عدد است",
        ]);
    }
}
if (!empty($_SESSION['user_sending'])) {
    $userId = $_SESSION['user_sending'];
    $existing = getOneRecordFromCart2($userId, $product_id, $variant_id);
    if (!$existing) {
        responseJson(["status" => 404, "text" => "آیتم در سبد یافت نشد"]);
    }
    $quantity = (int)$existing['quantity'];
    if ($action === 'yes') {
        $quantity++;
        checkLimit($quantity, $maxPurchase, $stock);
    }
    if ($action === 'no') {
        if ($quantity <= 1) {
            responseJson([
                "status" => 400,
                "type"   => "warning",
                "text"   => "تعداد نمی‌تواند کمتر از 1 باشد",
            ]);
        }
        $quantity--;
    }
    updateRecordToDatabase('cart', [
        'quantity' => $quantity
    ], $existing['id'], 'id');
    $items = getUserRecordFromCart($userId);
    responseJson([
        "status"   => 200,
        "type"     => "success",
        "text"     => "تعداد به‌روزرسانی شد",
        "quantity" => $quantity,
        "count"    => array_sum(array_column($items, 'quantity')),
        "sumPrice" => sumCart(false),
        "itemsCart"=> returnItemCart($items),
        "maxPurchase" => $maxPurchase,
    ]);
}

if (!isset($_SESSION['cart'][$itemKey])) {
    responseJson(["status" => 404, "text" => "آیتم در سبد یافت نشد"]);
}

$quantity = (int)$_SESSION['cart'][$itemKey]['quantity'];

if ($action === 'yes') {
    $quantity++;
    checkLimit($quantity, $maxPurchase, $stock);
}

if ($action === 'no') {
    if ($quantity <= 1) {
        responseJson([
            "status" => 400,
            "type"   => "warning",
            "text"   => "تعداد نمی‌تواند کمتر از 1 باشد",
        ]);
    }
    $quantity--;
}

$_SESSION['cart'][$itemKey]['quantity'] = $quantity;

$totalQuantity = array_sum(array_column($_SESSION['cart'], 'quantity'));

responseJson([
    "status"   => 200,
    "type"     => "success",
    "text"     => "تعداد به‌روزرسانی شد",
    "quantity" => $quantity,
    "count"    => $totalQuantity,
    "sumPrice" => sumCart(false),
    "itemsCart"=> $_SESSION['cart'],
    "maxPurchase" => $maxPurchase,
]);
