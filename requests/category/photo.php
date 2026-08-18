<?php
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = PATH_UPLOADS_DIR . 'images/category/';
    $maxFileSize = 1 * 1024 * 1024; // 1MB
    // بررسی حجم
    if ($_FILES['image']['size'] > $maxFileSize) {
        responseJson([
            'text'   => 'حجم تصویر نباید بیش از 1 مگابایت باشد.',
            'type'   => 'warning',
            'status' => 400,
        ]);
        exit;
    }
    // بررسی نوع MIME واقعی
    $allowedFileTypes = [
        'image/png'  => 'png',
        'image/jpeg' => 'jpg',
        'image/jpg'  => 'jpg',
        'image/gif'  => 'gif',
        'image/webp' => 'webp',
    ];
    $fileType = mime_content_type($_FILES['image']['tmp_name']);
    if (!array_key_exists($fileType, $allowedFileTypes)) {
        responseJson([
            'text'   => 'فرمت فایل مجاز نیست. (png, jpg, gif, webp)',
            'type'   => 'warning',
            'status' => 400,
        ]);
        exit;
    }
    // ساخت نام یکتا
    $suffix = $allowedFileTypes[$fileType];
    $originalName = $_FILES['image']['name'];
    $newName = md5($originalName . microtime(true)) . '.' . $suffix;
    $targetPath = $uploadDir . $newName;
    // انتقال فایل از tmp به مقصد
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        responseJson([
            'text'   => 'آپلود تصویر با خطا مواجه شد.',
            'type'   => 'warning',
            'status' => 400,
        ]);
        exit;
    }
    // گرفتن اطلاعات دسته فعلی
    $categoryId = POST('id');
    $category = getCategoryById($categoryId);
    if (!$category) {
        unlink($targetPath); // حذف فایل جدید برای پاکیزگی
        responseJson([
            'text'   => 'دسته‌بندی مورد نظر یافت نشد.',
            'type'   => 'warning',
            'status' => 404,
        ]);
        exit;
    }
    // به‌روزرسانی تصویر در دیتابیس
    $table = 'category';
    $fields = [
        'image_name' => $newName,
    ];
    $updateResult = updateRecordToDatabase($table, $fields, $categoryId, 'id');
    if ($updateResult) {
        // حذف تصویر قدیمی در صورت وجود
        if (!empty($category['image_name'])) {
            $oldImagePath = PATH_UPLOADS_DIR . 'images/category/' . $category['image_name'];
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        responseJson([
            'text'   => 'تصویر دسته‌بندی با موفقیت ویرایش شد.',
            'type'   => 'success',
            'status' => 200,
            'src'    => '/images/category/' . $newName,
            'old_removed' => true,
        ]);
    } else {
        // اگر آپدیت دیتابیس شکست خورد تصویر جدید حذف شود تا فایل یتیم نماند
        unlink($targetPath);
        responseJson([
            'text'   => 'در به‌روزرسانی تصویر مشکلی پیش آمد.',
            'type'   => 'warning',
            'status' => 400,
        ]);
    }

} else {
    responseJson([
        'text'   => 'تصویری برای آپلود ارسال نشده است.',
        'type'   => 'warning',
        'status' => 400,
    ]);
}
