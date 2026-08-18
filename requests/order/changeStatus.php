<?php
$id = $_POST['id'] ?? null;
$status = $_POST['status'] ?? null;
global $cn;
if ($id && $status !== null) {
    $stmt = $cn->prepare("UPDATE orders SET type = ? WHERE id = ?");
    if ($stmt->execute([$status, $id])) {
        echo json_encode([
            'status' => 200,
            'type' => 'success',
            'text' => 'وضعیت سفارش با موفقیت تغییر کرد.'
        ]);
    } else {
        echo json_encode([
            'status' => 500,
            'type' => 'error',
            'text' => 'خطا در بروزرسانی وضعیت.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 400,
        'type' => 'warning',
        'text' => 'اطلاعات ناقص ارسال شده.'
    ]);
}
