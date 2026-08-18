<?php
$getAllOrders = getTodayOrdersByStatus();
$columns = [
    'id'              => 'آیدی سفارش',
    'order_code'      => 'کد سفارش',
    'user_id'         => 'شناسه کاربر',
    'total_price'     => 'مبلغ (تومان)',
    'created_at'      => 'تاریخ ثبت',
    'shipping_price'  => 'هزینه ارسال',
    'post_tracking'   => 'کد رهگیری اداره پست',
];
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=daily-orders-" . date('Y-m-d') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

echo '<table border="1"><tr>';
foreach ($columns as $label) {
    echo "<th>{$label}</th>";
}
echo '</tr>';

foreach ($getAllOrders as $order) {
    echo '<tr>';
    foreach ($columns as $key => $label) {
        echo '<td>' . ($order[$key] ?? '') . '</td>';
    }
    echo '</tr>';
}

echo '</table>';
exit;
