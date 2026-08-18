<?php

/*-----------------------------
| حذف کوپن از سشن
------------------------------*/
if (isset($_SESSION['checkout']['coupon'])) {
    unset($_SESSION['checkout']['coupon']);
}
if (isset($_SESSION['checkout']['final_price'])) {
    unset($_SESSION['checkout']['final_price']);
}

/*-----------------------------
| محاسبه مبالغ بدون تخفیف
------------------------------*/
$cartTotal = (int) sumCart(true);
$shipping  = (int) calculateShippingCostForCart(true);
$cartTotalWithShipping = $cartTotal + $shipping;

echo json_encode([
    'status'                        => 200,
    'text'                          => 'کد تخفیف حذف شد',
    'discount'                      => 0,
    'discount_formatted'            => '0',
    'cart_total_with_shipping'      => $cartTotalWithShipping,
    'cart_total_with_shipping_formatted' => number_format($cartTotalWithShipping),
    'cart_products_total'            => $cartTotal,
    'cart_products_total_formatted'  => number_format($cartTotal),
    'final_price_with_shipping'     => $cartTotalWithShipping,
    'final_price_with_shipping_formatted' => number_format($cartTotalWithShipping),
]);
