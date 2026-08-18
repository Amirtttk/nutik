<?php

function isValidJalaliDate($date)
{
    $date = faToEn($date);

    if (!preg_match('/^\d{4}\/\d{1,2}\/\d{1,2}$/', $date)) {
        return false;
    }

    [$y, $m, $d] = explode('/', $date);
    return checkdate($m, $d, $y);
}

$validate_fields = validator([
    'code'            => 'required',
    'discount_value'  => 'required',
    'discount_type'   => 'required',
    'start_date'      => 'required',
    'end_date'        => 'required',
]);

if (!$validate_fields['status']) {
    responseJson([
        'text'   => 'لطفا فیلدها را به درستی وارد کنید',
        'type'   => 'warning',
        'status' => 400,
        'error'  => initFormErrors(),
    ]);
    exit;
}

/*-----------------------------
| بررسی تکراری بودن کد
------------------------------*/
if (couponCodeExists($_POST['code'])) {
    responseJson([
        'text'   => 'این کد تخفیف قبلاً ثبت شده است',
        'type'   => 'warning',
        'status' => 400,
        'error'  => initFormErrors(),
    ]);
    exit;
}

/*-----------------------------
| اعتبارسنجی تاریخ شمسی
------------------------------*/
if (
    !isValidJalaliDate($_POST['start_date']) ||
    !isValidJalaliDate($_POST['end_date'])
) {
    responseJson([
        'text'   => 'فرمت تاریخ شمسی نامعتبر است',
        'type'   => 'error',
        'status' => 400,
        'error'  => initFormErrors(),
    ]);
    exit;
}

/*-----------------------------
| تبدیل شمسی → میلادی
------------------------------*/
$startGregorian = jalaliToGregorianDate($_POST['start_date']); // Y-m-d
$endGregorian   = jalaliToGregorianDate($_POST['end_date']);   // Y-m-d

/*-----------------------------
| تبدیل به timestamp (مهم)
------------------------------*/
$startTs = strtotime($startGregorian . ' 00:00:00');
$endTs   = strtotime($endGregorian . ' 23:59:59');
$nowTs   = time();

if ($startTs === false || $endTs === false) {
    responseJson([
        'text'   => 'خطا در تبدیل تاریخ',
        'type'   => 'error',
        'status' => 400,
    ]);
    exit;
}

/*-----------------------------
| بررسی منطقی تاریخ‌ها
------------------------------*/
if ($startTs > $endTs) {
    responseJson([
        'text'   => 'تاریخ شروع نمی‌تواند بعد از تاریخ پایان باشد',
        'type'   => 'warning',
        'status' => 400,
    ]);
    exit;
}

if ($endTs < $nowTs) {
    responseJson([
        'text'   => 'تاریخ پایان نمی‌تواند قبل از امروز باشد',
        'type'   => 'warning',
        'status' => 400,
    ]);
    exit;
}

/*-----------------------------
| آماده‌سازی داده برای DB
------------------------------*/
$table = 'coupon';

$fields = [
    'code'           => trim($_POST['code']),
    'discount_value' => (float)$_POST['discount_value'],
    'discount_type'  => $_POST['discount_type'], // percent | fixed
    'status'         => 1,
    'start_date'     => $startTs, // ✅ timestamp
    'end_date'       => $endTs,   // ✅ timestamp
    'usage_limit'    => !empty($_POST['usage_limit']) ? (int)$_POST['usage_limit'] : null,
    'min_purchase'   => !empty($_POST['min_purchase']) ? (float)$_POST['min_purchase'] : null,
    'once_per_user'  => !empty($_POST['once_per_user']) ? 1 : 0,
];

if (insertRecordToDatabase($table, $fields)) {
    responseJson([
        'text'   => 'ایجاد کد تخفیف با موفقیت انجام شد',
        'type'   => 'success',
        'status' => 200,
    ]);
} else {
    responseJson([
        'text'   => 'در ایجاد کد تخفیف مشکلی پیش آمده است',
        'type'   => 'error',
        'status' => 400,
    ]);
}
