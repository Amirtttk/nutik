<?php
$date = trim((string) POST('appointment_date'));
$normalizedDate = normalizeAppointmentDate($date);

if ($normalizedDate === '') {
    responseJson([
        'status' => 400,
        'type' => 'warning',
        'text' => 'تاریخ نامعتبر است',
        'slots' => [],
    ]);
}

$slots = getAppointmentSlotsWithStatusByDate($normalizedDate);

responseJson([
    'status' => 200,
    'type' => 'success',
    'slots' => $slots,
]);
