<?php

function deactivateSubCategories($parentId)
{
    global $cn;

    $sql = "SELECT id FROM category WHERE parent_id = ?";
    $stmt = $cn->prepare($sql);
    $stmt->execute([$parentId]);
    $children = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($children as $child) {
        // غیرفعال کردن دسته
        $update = $cn->prepare("UPDATE category SET status = 2 WHERE id = ?");
        $update->execute([$child['id']]);

        // ادامه برای زیر دسته‌های بیشتر
        deactivateSubCategories($child['id']);
    }
}

function changeStatusCategory($status, $id)
{
    try {
        global $cn;

        $sql = "UPDATE category SET status = ? WHERE id = ?";
        $stmt = $cn->prepare($sql);
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $id);
        $stmt->execute();

        // فقط وقتی دسته غیر فعال می‌شه، بچه‌ها هم غیر فعال بشن
        if ($status == 2) {
            deactivateSubCategories($id);
        }

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

if (POST('id') && POST('status')) {
    $id = POST('id');
    $status = POST('status');

    if (changeStatusCategory($status, $id)) {

        // اگر دسته غیرفعال شد، زیر‌دسته‌ها هم غیرفعال بشن
        if ($status == 2) {
            deactivateSubCategories($id);
        }

        responseJson([
            'text' => "تغییر وضعیت با موفقیت انجام شد",
            "type" => "success",
            "status" => 200
        ]);
    } else {
        responseJson([
            'text' => "مشکلی در تغییر وضعیت رخ داده است",
            "type" => "warning",
            "status" => 400
        ]);
    }
} else {
    responseJson([
        'text' => "درخواست ناقص ارسال شده است",
        "type" => "warning",
        "status" => 400
    ]);
}
