<?php

$userId = isset($_SESSION['user_sending']) ? (int)$_SESSION['user_sending'] : null;
$code   = isset($_POST['code']) ? trim($_POST['code']) : '';

if ($code == '') {
    echo json_encode([
        'status' => 400,
        'type'   => 'warning',
        'text'   => 'کد تخفیف را وارد کنید'
    ]);
    exit;
}

/*-----------------------------
| جمع کل سبد خرید
------------------------------*/
$cartTotal = sumCart(true);

if ($cartTotal <= 0) {
    echo json_encode([
        'status' => 400,
        'type'   => 'error',
        'text'   => 'سبد خرید خالی است'
    ]);
    exit;
}

/*-----------------------------
| گرفتن اطلاعات کوپن
------------------------------*/
$coupon = getCouponByCode($code);

if (!$coupon) {
    echo json_encode([
        'status' => 400,
        'type'   => 'error',
        'text'   => 'کد تخفیف نامعتبر است'
    ]);
    exit;
}
/*-----------------------------
| وضعیت فعال / غیرفعال
------------------------------*/
if ((int)$coupon['status'] !== 1) {
    echo json_encode([
        'status' => 400,
        'type'   => 'error',
        'text'   => 'این کد تخفیف غیرفعال است'
    ]);
    exit;
}
/*-----------------------------
| تاریخ شروع و پایان (✅ timestamp)
------------------------------*/
$startTs = (int)$coupon['start_date'];
$endTs   = (int)$coupon['end_date'];
$nowTs   = time();
if ($nowTs < $startTs) {
    echo json_encode([
        'status' => 400,
        'type'   => 'warning',
        'text'   => 'کوپن هنوز فعال نشده است'
    ]);
    exit;
}
if ($nowTs > $endTs) {
    echo json_encode([
        'status' => 400,
        'type'   => 'warning',
        'text'   => 'کد تخفیف منقضی شده است'
    ]);
    exit;
}
/*-----------------------------
| محدودیت تعداد استفاده
------------------------------*/
$usedCount = getCouponUsageCount($coupon['id']);
if (!empty($coupon['usage_limit']) && $usedCount >= $coupon['usage_limit']) {
    echo json_encode([
        'status' => 400,
        'type'   => 'error',
        'text'   => 'ظرفیت این کوپن به پایان رسیده است'
    ]);
    exit;
}
/*-----------------------------
| محدودیت یکبار برای هر کاربر
------------------------------*/
if ((int)$coupon['once_per_user'] == 1) {
    if (!$userId) {
        echo json_encode([
            'status' => 401,
            'type'   => 'warning',
            'text'   => 'برای استفاده از این کوپن ابتدا وارد حساب کاربری شوید'
        ]);
        exit;
    }
    if (hasUserUsedCoupon($userId, $coupon['id'])) {
        echo json_encode([
            'status' => 400,
            'type'   => 'error',
            'text'   => 'شما قبلاً از این کوپن استفاده کرده‌اید'
        ]);
        exit;
    }
}
/*-----------------------------
| حداقل مبلغ خرید
------------------------------*/
if (!empty($coupon['min_purchase']) && $cartTotal < $coupon['min_purchase']) {
    echo json_encode([
        'status' => 400,
        'type'   => 'warning',
        'text'   => 'مبلغ سبد خرید کمتر از حداقل مجاز است'
    ]);
    exit;
}
/*-----------------------------
| محاسبه تخفیف
------------------------------*/
if ($coupon['discount_type'] === 'percent') {
    $discount = ($cartTotal * $coupon['discount_value']) / 100;
} else {
    $discount = $coupon['discount_value'];
}
$discount    = min($discount, $cartTotal);
$finalPrice = $cartTotal - $discount;
/*-----------------------------
| ذخیره در سشن
------------------------------*/
$_SESSION['checkout']['coupon'] = [
    'id'       => $coupon['id'],
    'code'     => $coupon['code'],
    'discount' => $discount
];
$_SESSION['checkout']['final_price'] = $finalPrice;
/*-----------------------------
| مبلغ نهایی همراه با هزینه ارسال
------------------------------*/
$shipping = (int) calculateShippingCostForCart(true);
$finalPriceWithShipping = $finalPrice + $shipping;
$cartTotalWithShipping  = $cartTotal + $shipping;
/*-----------------------------
| تاریخ شمسی برای نمایش
------------------------------*/
$startShamsi = jdate('Y/m/d', $startTs);
$endShamsi   = jdate('Y/m/d', $endTs);
/*-----------------------------
| خروجی AJAX
------------------------------*/
echo json_encode([
    'status'                      => 200,
    'text'                        => 'کد تخفیف با موفقیت اعمال شد',
    'discount'                    => $discount,
    'discount_formatted'          => number_format($discount),
    'final_price'                 => $finalPrice,
    'final_price_formatted'       => number_format($finalPrice),
    'final_price_with_shipping'   => $finalPriceWithShipping,
    'final_price_with_shipping_formatted' => number_format($finalPriceWithShipping),
    'cart_total_with_shipping'    => $cartTotalWithShipping,
    'cart_total_with_shipping_formatted' => number_format($cartTotalWithShipping),
    'cart_products_total'         => $cartTotal,
    'cart_products_total_formatted' => number_format($cartTotal),
    'start_date_shamsi'           => $startShamsi,
    'end_date_shamsi'             => $endShamsi
]);
