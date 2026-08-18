<?php
// تابع تولید کد معرف (از helpers/functions.php باید include شده باشه)
// require_once __DIR__ . '/../../helpers/functions.php';  // اگر لازمه این خط رو فعال کن

$count  = checkLoginAttempts($_SERVER['REMOTE_ADDR'], time());
$count2 = checkLoginAttempts($_SERVER['REMOTE_ADDR'], time(), 'req');

$text = '';
$status = 400;

if ($count < 5 && $count2 < 15) {

    // 1) دریافت ورودی کد از POST (می‌تونه string باشه یا array)
    $codeInput = POST('codeUser'); // مقدار ارسالی از فرانت

    // اگر آرایه بود، به رشته تبدیل کن
    $inputCode = is_array($codeInput) ? implode('', $codeInput) : (string)$codeInput;

    // تمیزکاری: فقط رقم‌ها
    $inputCode = preg_replace('/\D/', '', $inputCode);

    // 2) ولیدیشن دقیق ۴ رقمی (بهترین و کم‌ریسک‌ترین راه)
    if (strlen($inputCode) !== 4) {
        $text = 'کد را به درستی وارد کنید';
    } else {

        // 3) وجود کد تایید در سشن
        if (!isset($_SESSION['confirm_code'])) {
            responseJson(['text' => 'کد قبلی منقضی شده است', 'type' => 'warning', 'status' => 400]);
        }

        // 4) مقایسه کد
        if ($inputCode !== (string)$_SESSION['confirm_code']) {
            $text = 'کد وارد شده اشتباه میباشد';
        } else {

            // 5) ورود/ثبت کاربر
            if (isset($_SESSION['yesLogin']) && $_SESSION['yesLogin'] == true) {
                $id = getUserByMobile($_SESSION['mobile'])['userID'];
            } else {

                // ثبت نام کاربر جدید
                $newReferralCode = generateReferralCode('REF', 7);

                $fields = [
                    'userID'       => null,
                    'userMobile'   => (int) $_SESSION['mobile'],
                    'userAccLvl'   => 4,
                    'userFullName' => "کاربر سایت",
                    'gender'       => 1,
                    'status'       => 1,
                    'referralCode' => $newReferralCode,
                ];

                insertRecordToDatabase('users_info_public', $fields);

                global $cn;
                $id = $cn->lastInsertId();
            }

            // 6) مدیریت سشن‌ها
            if (isset($_SESSION['admin_info'])) unset($_SESSION['admin_info']);
            $_SESSION['user_sending'] = $id;

            // 7) ثبت آخرین ورود
            $getUserLastLogin = getUserLastLogin($id);
            $now = date('Y-m-d H:i:s');
            $loginFields = ["userID" => $id, "date" => $now];

            if ($getUserLastLogin) {
                updateRecordToDatabase(
                    "users_last_login",
                    ["date" => $now],
                    $id,
                    "userID"
                );
            } else {
                insertRecordToDatabase("users_last_login", $loginFields);
            }

            // 8) تعیین مقصد
            $url = isset($_SESSION['loginForPayment']) ? "checkout" : "dashboard";

            // 9) انتقال سبد خرید
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $existing = getOneRecordFromCart(
                        $id,
                        (int)$item['product_id'],
                        $item['variant_id'] ?? null
                    );

                    if ($existing) {
                        updateRecordToDatabase(
                            'cart',
                            ['quantity' => $existing['quantity'] + (int)$item['quantity']],
                            $existing['id'],
                            'id'
                        );
                    } else {
                        insertRecordToDatabase('cart', [
                            'user_id' => $id,
                            'product_id' => (int)$item['product_id'],
                            'variant_id' => $item['variant_id'] ?? null,
                            'titleColor' => $item['titleColor'] ?? null,
                            'color' => $item['color'] ?? null,
                            'price' => $item['price'],
                            'discount' => $item['discount'],
                            'quantity' => (int)$item['quantity'],
                            'image' => $item['image'] ?? null,
                            'title' => $item['title'],
                        ]);
                    }
                }
                unset($_SESSION['cart']);
            }

            // 10) پاسخ نهایی
            responseJson([
                'text' => 'کمی صبر کنید',
                'status' => 200,
                'type' => 'success',
                'url' => $url
            ]);
            exit;
        }
    }

} else {
    $status = 500;
    $text = 'شما به علت فعالیت غیر مجاز توسط سایت بلاک شدید';
}

// ثبت درخواست در دیتابیس برای امنیت (همیشه اجرا میشه)
insertRecordToDatabase(
    "request_login",
    ["userIp" => $_SERVER['REMOTE_ADDR'], "time" => time(), "type" => 'req']
);

responseJson(['text' => $text, 'type' => 'warning', 'status' => $status]);
