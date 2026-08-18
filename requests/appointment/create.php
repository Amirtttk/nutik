<?php
$validate_fields = validator([
    'full_name' => 'required',
    'mobile' => 'required|mobile',
    'appointment_date' => 'required',
    'appointment_time' => 'required',
]);

if (!$validate_fields['status']) {
    responseJson([
        'text' => 'فیلدها را به درستی پر کنید',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

$settings = getAppointmentSettings();
if ((int) ($settings['status'] ?? 0) !== 1) {
    responseJson([
        'text' => 'رزرو نوبت در حال حاضر غیرفعال است',
        'type' => 'warning',
        'status' => 400,
    ]);
}

$fullName = trim((string) POST('full_name'));
$mobile = trim(faToEn((string) POST('mobile')));
$appointmentDateInput = trim((string) POST('appointment_date'));
$appointmentTime = trim(faToEn((string) POST('appointment_time')));
$description = trim((string) POST('description'));
$appointmentDate = normalizeAppointmentDate($appointmentDateInput);

if ($appointmentDate === '') {
    responseJson([
        'text' => 'فرمت تاریخ نوبت نامعتبر است',
        'type' => 'warning',
        'status' => 400,
    ]);
}

if (!preg_match('/^\d{2}:\d{2}$/', $appointmentTime)) {
    responseJson([
        'text' => 'ساعت انتخابی نامعتبر است',
        'type' => 'warning',
        'status' => 400,
    ]);
}

$allowedSlots = getAppointmentSlotsFromSettings($settings);
if (!in_array($appointmentTime, $allowedSlots, true)) {
    responseJson([
        'text' => 'این ساعت در بازه تعریف‌شده وجود ندارد',
        'type' => 'warning',
        'status' => 400,
    ]);
}

$workingDays = array_filter(explode(',', (string) ($settings['working_days'] ?? '')), 'strlen');
$weekdayIndex = getAppointmentWeekdayIndex($appointmentDate);
if ($weekdayIndex === null || !in_array((string) $weekdayIndex, $workingDays, true)) {
    responseJson([
        'text' => 'تاریخ انتخابی جزو روزهای کاری نیست',
        'type' => 'warning',
        'status' => 400,
    ]);
}

if (isAppointmentSlotReserved($appointmentDate, $appointmentTime . ':00')) {
    responseJson([
        'text' => 'این زمان قبلاً رزرو شده است',
        'type' => 'warning',
        'status' => 400,
    ]);
}
if (isAppointmentSlotExpired($appointmentDate, $appointmentTime, 0)) {
    responseJson([
        'text' => 'این ساعت گذشته است و دیگر قابل رزرو نیست',
        'type' => 'warning',
        'status' => 400,
    ]);
}

$amount = (int) ($settings['price'] ?? 0);
$trackingCode = 'APT' . generateDigit(8);

global $cn;
try {
    $fields = [
        'tracking_code' => $trackingCode,
        'full_name' => $fullName,
        'mobile' => $mobile,
        'appointment_date' => $appointmentDate,
        'appointment_time' => $appointmentTime . ':00',
        'amount' => $amount,
        'description' => $description,
        'payment_status' => $amount > 0 ? 0 : 2,
        'admin_status' => 0,
    ];

    if (!insertRecordToDatabase('appointments', $fields)) {
        throw new RuntimeException('insert_failed');
    }

    $appointmentId = (int) $cn->lastInsertId();
} catch (Throwable $e) {
    responseJson([
        'text' => 'ذخیره درخواست رزرو ممکن نشد. فایل database/appointments.sql را اجرا کنید.',
        'type' => 'error',
        'status' => 500,
    ]);
}

if ($amount <= 0) {
    responseJson([
        'status' => 200,
        'type' => 'success',
        'text' => 'درخواست رزرو ثبت شد و در انتظار تایید مدیر است',
        'redirect' => url('/reservationComplete?track_id=' . $trackingCode . '&free=1'),
    ]);
}

$getInformation = getInformation();
$callbackUrl = url('/reservationComplete?track_id=' . urlencode($trackingCode));
$paymentRequest = requestSandboxPayment(
    $trackingCode,
    $amount * 10,
    $getInformation['zarinpal'],
    'پرداخت رزرو نوبت مشاوره',
    $callbackUrl,
    ['mobile' => $mobile]
);

if (!$paymentRequest['success']) {
    updateRecordToDatabase('appointments', [
        'payment_status' => 1,
        'gateway_response' => $paymentRequest['error'] ?? 'payment_request_failed',
    ], $appointmentId, 'id');

    responseJson([
        'status' => 500,
        'type' => 'error',
        'text' => 'اتصال به درگاه تستی انجام نشد',
    ]);
}

updateRecordToDatabase('appointments', [
    'authority' => $paymentRequest['authority'],
    'gateway_response' => json_encode($paymentRequest['raw'], JSON_UNESCAPED_UNICODE),
], $appointmentId, 'id');

responseJson([
    'status' => 200,
    'type' => 'success',
    'text' => 'در حال اتصال به درگاه پرداخت',
    'url' => $paymentRequest['url'],
]);
