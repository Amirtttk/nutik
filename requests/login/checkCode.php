<?php
$count = checkLoginAttempts($_SERVER['REMOTE_ADDR'], time());
$count2 = checkLoginAttempts($_SERVER['REMOTE_ADDR'], time(), 'req');
$text = '';
$status = 400;
if ($count < 5 && $count2 < 15) {
    $validate_filds = validator([
        'codeUser' => 'required|code',
    ]);
    if ($validate_filds["status"]) {
        if (isset($_SESSION['confirm_code'])) {
            if (POST('codeUser') == $_SESSION['confirm_code']) {
                if (isset($_SESSION['yesLogin']) && $_SESSION['yesLogin'] == true) {
                    $id = getUserByMobile($_SESSION['mobile'])['userID'];
                } else {
                    $fields = [
                        'userID' => null,
                        'userMobile' => (int) $_SESSION['mobile'],
                        'userAccLvl' => 4,
                        'userFullName' => "کاربر سایت",
                        'gender' => 1,
                        'status' => 1,
                    ];
                    insertRecordToDatabase('users_info_public', $fields);
                    global $cn;
                    $id = $cn->lastInsertId();
                }
                if(isset($_SESSION['admin_info'])) {
                    unset($_SESSION['admin_info']);
                }
                $_SESSION['user_sending'] = $id;

                $getUserLastLogin = getUserLastLogin($_SESSION['user_sending']);
                if ($getUserLastLogin) {
                    $fields = [
                        "date" => date('Y-m-d H:i:s')
                    ];
                    updateRecordToDatabase("users_last_login", $fields, $_SESSION['user_sending'], "userID");
                } else {
                    $fields = [
                        "userID" => $_SESSION['user_sending'],
                        "date" => date('Y-m-d H:i:s')
                    ];
                    insertRecordToDatabase("users_last_login", $fields);
                }
                if (isset($_SESSION['loginForPayment'])) {
                    $url = "checkout";
                }else{
                    $url = "dashboard";
                }
                if (!empty($_SESSION['user_sending']) && !empty($_SESSION['cart'])) {

                    $userId = (int)$_SESSION['user_sending'];

                    foreach ($_SESSION['cart'] as $itemKey => $item) {

                        $productId = (int)$item['product_id'];
                        $variantId = $item['variant_id'] ?? null;
                        $quantity  = (int)$item['quantity'];

                        // بررسی وجود آیتم در دیتابیس
                        $existing = getOneRecordFromCart(
                            $userId,
                            $productId,
                            $variantId
                        );

                        if ($existing) {
                            // اگر وجود داشت → جمع تعداد
                            $newQuantity = $existing['quantity'] + $quantity;

                            updateRecordToDatabase(
                                'cart',
                                ['quantity' => $newQuantity],
                                $existing['id'],
                                'id'
                            );

                        } else {
                            // اگر وجود نداشت → درج کامل آیتم
                            insertRecordToDatabase('cart', [
                                'user_id'    => $userId,
                                'product_id' => $productId,
                                'variant_id' => $variantId,
                                'titleColor' => $item['titleColor'] ?? null,
                                'color'      => $item['color'] ?? null,
                                'price'      => $item['price'],
                                'discount'   => $item['discount'],
                                'quantity'   => $quantity,
                                'image'      => $item['image'] ?? null,
                                'title'      => $item['title'],
                            ]);
                        }
                    }
                    // پاک کردن سشن بعد از انتقال
                    unset($_SESSION['cart']);
                }
                responseJson([
                    'text' => 'کمی صبر کنید',
                    'status' => 200,
                    'type' => 'success',
                    'url'=>$url
                ]);
            } else {
                $text = 'کد وارد شده اشتباه میباشد';
            }
        } else {
            responseJson([
                'text' => 'کد قبلی منقضی شده است , درخواست کد جدیدی کنید',
                'type' => 'warning',
                'status' => 400,
            ]);
        }
    } else {
        $text = 'کد را به درستی وارد کنید';
    }
} else {
    $status = 500;
    $text = 'شما به علت فعالیت غیر مجاز توسط سایت بلاک شدید , 10 دقیقه دیگر دوباره امتحان کنید';
}

$fields = [
    "userIp" => $_SERVER['REMOTE_ADDR'],
    "time" => time(),
    "type" => 'req',
];
insertRecordToDatabase("request_login", $fields);
responseJson([
    'text' => $text,
    'type' => 'warning',
    'status' => $status,
]);