<?php
$id = (int) ($_POST['id'] ?? 0);
$status = isset($_POST['status']) ? (int) $_POST['status'] : null;

if ($id <= 0 || $status === null || !in_array($status, [0, 1, 2, 3], true)) {
    responseJson([
        'status' => 400,
        'type' => 'warning',
        'text' => 'اطلاعات ناقص یا نامعتبر ارسال شده است.',
    ]);
}

$appointment = getAppointmentById($id);
if (!$appointment) {
    responseJson([
        'status' => 404,
        'type' => 'error',
        'text' => 'درخواست رزرو پیدا نشد.',
    ]);
}

if ($status === 1 && (int) $appointment['payment_status'] !== 2) {
    responseJson([
        'status' => 400,
        'type' => 'warning',
        'text' => 'فقط رزروهای پرداخت‌شده قابل تایید هستند.',
    ]);
}

if (
    $status === 1 &&
    isAppointmentSlotReserved($appointment['appointment_date'], $appointment['appointment_time'], $appointment['id'])
) {
    responseJson([
        'status' => 400,
        'type' => 'warning',
        'text' => 'این بازه زمانی قبلاً توسط رزرو تاییدشده دیگری اشغال شده است.',
    ]);
}

$fields = [
    'admin_status' => $status,
];

if ($status === 1) {
    $fields['approved_at'] = date('Y-m-d H:i:s');
}

if (!updateRecordToDatabase('appointments', $fields, $id, 'id')) {
    responseJson([
        'status' => 500,
        'type' => 'error',
        'text' => 'بروزرسانی وضعیت رزرو انجام نشد.',
    ]);
}

$adminStatusHtml = '<span class="label label-lg font-weight-bold label-light-warning label-inline">در انتظار بررسی</span>';
if ($status === 1) {
    $adminStatusHtml = '<span class="label label-lg font-weight-bold label-light-success label-inline">تایید شده</span>';
} elseif ($status === 2) {
    $adminStatusHtml = '<span class="label label-lg font-weight-bold label-light-danger label-inline">رد شده</span>';
} elseif ($status === 3) {
    $adminStatusHtml = '<span class="label label-lg font-weight-bold label-light-dark label-inline">لغو شده</span>';
}

$finalStatusHtml = '<span class="label label-lg font-weight-bold label-light-secondary label-inline">نهایی نشده</span>';
if ((int) $appointment['payment_status'] === 2 && $status === 1) {
    $finalStatusHtml = '<span class="label label-lg font-weight-bold label-light-success label-inline">رزرو شده</span>';
}

responseJson([
    'status' => 200,
    'type' => 'success',
    'text' => 'وضعیت رزرو با موفقیت تغییر کرد.',
    'adminStatusHtml' => $adminStatusHtml,
    'finalStatusHtml' => $finalStatusHtml,
]);
