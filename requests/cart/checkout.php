<?php
$selectedAddressId = $_POST['selected_address_id'] ?? '';
$manual            = $_POST['manual_address'] ?? [];

if (!empty($selectedAddressId)) {
    $address = selectAdressById($selectedAddressId, $_SESSION['user_sending']);
    if ($address) {
        $_SESSION['checkout_address'] = $address;
    } else {
        echo json_encode([
            'status' => 400,
            'type'   => 'error',
            'text'   => 'آدرس انتخاب‌شده معتبر نیست',
            'error'  => 'آدرس انتخاب‌شده در سیستم یافت نشد.',
        ]);
        exit;
    }
} else {
    $required = ['name','family','province_id','city_id','address','mobile','post_code'];
    foreach ($required as $r) {
        if (empty($manual[$r])) {
            echo json_encode([
                'status' => 400,
                'type'   => 'error',
                'text'   => 'لطفا آدرس راوارد کرده یا از آدرس های قبلی انتخاب کنید',
                'error'  => 'همه‌ی فیلدهای آدرس را پر کنید',
            ]);
            exit;
        }
    }
    $_SESSION['checkout_address'] = $manual;
}
$getInformation = getInformation();
$totalCartPrice =  sumCart(true);
$shippingCost   = calculateShippingCostForCart(true);
$_SESSION['amount_payable'] = $totalCartPrice;
$_SESSION['shipping_cost']  = $shippingCost;
$finalPrice = $totalCartPrice + $shippingCost;
// ❗ شرط مهم: مبلغ باید بیشتر از صفر باشد
if ($finalPrice <= 0) {
    echo json_encode([
        'status' => 400,
        'type'   => 'error',
        'text'   => 'مبلغ سفارش نامعتبر است',
        'error'  => 'امکان انتقال به درگاه با مبلغ صفر وجود ندارد.',
    ]);
    exit;
}
$_SESSION['description'] = $_POST['description'] ?? '';
$random_cod = generateDigit();
$_SESSION['random_cod'] = $random_cod;
$url_idpay = apyKey_payment(
    $random_cod,
    $finalPrice * 10,
    $getInformation['zarinpal']
);
if ($url_idpay) {
    echo json_encode([
        'status' => 200,
        'type'   => 'success',
        'text'   => 'در حال اتصال به درگاه پرداخت',
        'url'    => $url_idpay
    ]);
} else {
    echo json_encode([
        'status' => 500,
        'type'   => 'error',
        'text'   => 'خطا در اتصال به درگاه پرداخت',
        'error'  => 'در حال حاضر امکان اتصال به درگاه وجود ندارد.'
    ]);
}
