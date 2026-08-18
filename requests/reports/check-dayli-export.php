<?php

$count = count(getTodayOrdersByStatus());

if ($count > 0) {
    echo json_encode([
        'status' => 200
    ]);
} else {
    echo json_encode([
        'status' => 400,
        'message' => 'امروز سفارشی ثبت نشده'
    ]);
}
exit;
