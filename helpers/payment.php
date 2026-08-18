<?php

function requestSandboxPayment($parameter, $Amount, $merchantID, $description = 'پرداخت تستی', $callbackUrl = null, array $metadata = [])
{
    $CallbackURL = $callbackUrl ?: (CALL_BACK_URL . "?track_id=" . $parameter);
    $payload = [
        "merchant_id" => $merchantID,
        "amount" => (int) $Amount,
        "callback_url" => $CallbackURL,
        "description" => $description,
        "metadata" => array_merge([
            "mobile" => "09999999999",
            "email" => "test@gmail.com",
        ], $metadata),
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://sandbox.zarinpal.com/pg/v4/payment/request.json",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Accept: application/json",
        ],
    ]);
    $response = curl_exec($curl);
    $curlError = curl_error($curl);
    curl_close($curl);

    $result = json_decode($response, true);
    if (isset($result["data"]["authority"])) {
        return [
            'success' => true,
            'authority' => $result["data"]["authority"],
            'url' => "https://sandbox.zarinpal.com/pg/StartPay/" . $result["data"]["authority"] . "/ZarinGate",
            'raw' => $result,
        ];
    }

    return [
        'success' => false,
        'authority' => null,
        'url' => null,
        'error' => $curlError ?: json_encode($result["errors"] ?? "مشکل نامشخص"),
        'raw' => $result,
    ];
}

function apyKey_payment($parameter, $Amount, $merchantID, $description = 'پرداخت تستی', $callbackUrl = null, array $metadata = []) {
    $payment = requestSandboxPayment($parameter, $Amount, $merchantID, $description, $callbackUrl, $metadata);
    if ($payment['success']) {
        return $payment['url'];
    }
    return "خطا: " . ($payment['error'] ?? 'مشکل نامشخص');
}

function verifySandboxPayment($authority, $Amount, $merchantID)
{
    $payload = [
        "merchant_id" => $merchantID,
        "amount" => (int) $Amount,
        "authority" => (string) $authority,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://sandbox.zarinpal.com/pg/v4/payment/verify.json",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Accept: application/json",
        ],
    ]);
    $response = curl_exec($curl);
    $curlError = curl_error($curl);
    curl_close($curl);

    $result = json_decode($response, true);
    if (isset($result['data']['code']) && in_array((int) $result['data']['code'], [100, 101], true)) {
        return [
            'success' => true,
            'ref_id' => $result['data']['ref_id'] ?? null,
            'card_pan' => $result['data']['card_pan'] ?? null,
            'fee' => $result['data']['fee'] ?? 0,
            'raw' => $result,
        ];
    }

    return [
        'success' => false,
        'error' => $curlError ?: json_encode($result['errors'] ?? $result['data'] ?? 'خطا در تایید پرداخت'),
        'raw' => $result,
    ];
}
function verify_payment($status){
    if ($status == "NOK") {
        $status = 1;
    } else {
        $status = 10;
    }
    $description    = $_SESSION['description'];
    $tracking_code  = $_SESSION['random_cod'];
    $amount_payable = (int) $_SESSION['amount_payable'];
    $shippingCost   = (int) $_SESSION['shipping_cost'];
    // گرفتن آدرس از سشن
    $checkoutAddress = $_SESSION['checkout_address'] ?? [];
    // آماده سازی مقدار برای ذخیره در فیلد address
    if (isset($checkoutAddress['id'])) {
        // آدرس انتخابی → ذخیره id
        $addressValue = $checkoutAddress['id'];
    } else {
        // آدرس دستی → ذخیره JSON
        $addressValue = json_encode($checkoutAddress, JSON_UNESCAPED_UNICODE);
    }
    // مبلغ و اطلاعات کد تخفیف (در صورت وجود)
    $couponAmount = 0;
    $couponId     = null;
    if (!empty($_SESSION['checkout']['coupon'])) {
        $couponAmount = (int) ($_SESSION['checkout']['coupon']['discount'] ?? 0);
        $couponId     = (int) ($_SESSION['checkout']['coupon']['id'] ?? 0);
    }
    // پاکسازی سشن‌ها (شامل کوپن)
    unset(
        $_SESSION['random_cod'],
        $_SESSION['amount_payable'],
        $_SESSION['description'],
        $_SESSION['loginForPayment'],
        $_SESSION['shipping_cost'],
        $_SESSION['checkout']['coupon'],
        $_SESSION['checkout']['final_price']
    );
    if (isset($_SESSION['checkout']) && empty($_SESSION['checkout'])) {
        unset($_SESSION['checkout']);
    }
    $table = 'orders';
    $fields = [
        'id'             => NULL,
        'tracking_code'  => $tracking_code,
        'status'         => $status,
        'user_id'        => $_SESSION['user_sending'],
        'amount_payable' => $amount_payable,
        'shipping_cost'  => $shippingCost,
        'coupon'         => $couponAmount,
        'type'           => 4,
        'description'    => $description,
        'address'        => $addressValue,
    ];
    global $cn;
    if (insertRecordToDatabase($table, $fields)) {
        $lastInsertID = $cn->lastInsertId();
        $getUserRecordFromCart = getUserRecordFromCart($_SESSION['user_sending']);
        if ($getUserRecordFromCart) {
            foreach ($getUserRecordFromCart as $cart) {
                $product = getOneProduct($cart['product_id']);
                $variantId = $cart['variant_id'];
                $qty       = (int)$cart['quantity'];
                insertRecordToDatabase('order_product', [
                    'order_id'    => $lastInsertID,
                    'title'       => $product['title'],
                    'price'       => $cart['price'],
                    'product_id'  => $cart['product_id'],
                    'quantity'    => $qty,
                    'titleColor'  => $cart['titleColor'],
                    'color'       => $cart['color'],
                    'discount'    => $cart['discount'],
                    'variant_id'  => $variantId,
                ]);
                if (!empty($variantId)) {

                    $variants = json_decode($product['price'], true);

                    foreach ($variants as &$variant) {
                        if ($variant['id'] == $variantId) {

                            // کم کردن موجودی واریانت
                            $variant['count'] = max(
                                0,
                                (int)$variant['count'] - $qty
                            );

                            break;
                        }
                    }

                    // ذخیره مجدد JSON در دیتابیس
                    updateRecordToDatabase(
                        'products',
                        ['price' => json_encode($variants, JSON_UNESCAPED_UNICODE)],
                        $cart['product_id'],
                        'id'
                    );

                }
                else {
                    $newStock = max(
                        0,
                        (int)$product['stock'] - $qty
                    );
                    updateRecordToDatabase(
                        'products',
                        ['stock' => $newStock],
                        $cart['product_id'],
                        'id'
                    );
                }
            }

        }
        // ذخیره استفاده از کوپن در صورت پرداخت موفق و وجود کد تخفیف
        if ($status == 10 && $couponId > 0 && $couponAmount > 0) {
            insertRecordToDatabase('coupon_usage', [
                'coupon_id'        => $couponId,
                'user_id'          => $_SESSION['user_sending'],
                'order_id'         => $lastInsertID,
                'used_at'          => date('Y-m-d H:i:s'),
                'discount_applied'  => (string) $couponAmount,
            ]);
        }
    }
    if ($status == 10) {
        deleteCartUser($_SESSION['user_sending']);
        redirect("/checkoutComplete?tracking_code=$tracking_code");
    } else {
        redirect("/checkoutNoComplete?tracking_code=$tracking_code");
    }
}
