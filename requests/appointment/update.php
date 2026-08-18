<?php
$validate_fields = validator([
    'start_time' => 'required',
    'end_time' => 'required',
    'slot_duration' => 'required',
    'capacity_per_slot' => 'required',
    'price' => 'required',
]);

if (!$validate_fields['status']) {
    responseJson([
        'text' => 'فیلدها را به درستی پر کنید',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

$startTime = trim((string) POST('start_time'));
$endTime = trim((string) POST('end_time'));
$slotDuration = (int) POST('slot_duration');
$capacity = (int) POST('capacity_per_slot');
$price = (int) POST('price');
$status = (int) POST('status') === 1 ? 1 : 0;
$workingDays = POST('working_days');

if (!preg_match('/^\d{2}:\d{2}$/', $startTime) || !preg_match('/^\d{2}:\d{2}$/', $endTime)) {
    responseJson([
        'text' => 'فرمت ساعت شروع یا پایان نامعتبر است',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

if (strtotime($startTime) >= strtotime($endTime)) {
    responseJson([
        'text' => 'ساعت پایان باید بعد از ساعت شروع باشد',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

if (!in_array($slotDuration, [15, 30, 45, 60], true)) {
    responseJson([
        'text' => 'فاصله نوبت نامعتبر است',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

if ($capacity < 1 || $capacity > 50) {
    responseJson([
        'text' => 'ظرفیت هر نوبت باید بین ۱ تا ۵۰ باشد',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

if ($price < 0) {
    responseJson([
        'text' => 'هزینه مشاوره نمی‌تواند منفی باشد',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

$allowedDays = ['0', '1', '2', '3', '4', '5', '6'];
$days = [];
if (is_array($workingDays)) {
    foreach ($workingDays as $day) {
        $day = (string) $day;
        if (in_array($day, $allowedDays, true)) {
            $days[] = $day;
        }
    }
}
$days = array_values(array_unique($days));
sort($days);

if (!$days) {
    responseJson([
        'text' => 'حداقل یک روز کاری را انتخاب کنید',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

$table = 'appointment_settings';
$fields = [
    'start_time' => $startTime . ':00',
    'end_time' => $endTime . ':00',
    'slot_duration' => $slotDuration,
    'capacity_per_slot' => $capacity,
    'price' => $price,
    'working_days' => implode(',', $days),
    'status' => $status,
];

$id = (int) POST('id');
if ($id <= 0) {
    $id = 1;
}

$rowExists = false;
try {
    global $cn;
    $check = $cn->prepare("SELECT id FROM appointment_settings WHERE id = ? LIMIT 1");
    $check->bindValue(1, $id);
    $check->execute();
    $rowExists = $check->rowCount() > 0;
} catch (Throwable $e) {
    responseJson([
        'text' => 'جدول تنظیمات نوبت وجود ندارد. فایل database/appointment_settings.sql را اجرا کنید.',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

$saved = false;
if ($rowExists) {
    $saved = updateRecordToDatabase($table, $fields, $id, 'id');
} else {
    $fields['id'] = $id;
    $saved = insertRecordToDatabase($table, $fields);
}

if ($saved) {
    responseJson([
        'text' => 'تنظیمات رزرو نوبت با موفقیت ذخیره شد',
        'type' => 'success',
        'status' => 200,
        'slots' => getAppointmentSlotsFromSettings($fields),
    ]);
}

responseJson([
    'text' => 'در ذخیره تنظیمات مشکلی پیش آمده است',
    'type' => 'warning',
    'status' => 400,
    'error' => initFormErrors(),
]);
