<?php
if (!empty($_FILES['image']['size'])) {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $max_file_size = 1048576; // 1MB
    $original_name = $_FILES['image']['name'];
    $file_size     = $_FILES['image']['size'];
    $suffix        = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
    // بررسی پسوند
    if (!in_array($suffix, $allowed_extensions)) {
        responseJson([
            'text' => 'فقط فرمت‌های jpg, jpeg, png, gif, webp مجاز هستند.',
            'type' => 'error',
            'status' => 400
        ]);
        exit;
    }
    // بررسی حجم
    if ($file_size > $max_file_size) {
        responseJson([
            'text' => 'حجم تصویر نباید بیشتر از 1 مگابایت باشد.',
            'type' => 'error',
            'status' => 400
        ]);
        exit;
    }
    // ساخت نام جدید
    $new_name = md5($original_name . microtime(true)) . '.' . $suffix;
    // مسیر فیزیکی ذخیره
    $uploadPath = PATH_UPLOADS_DIR . 'images/blog/' . $new_name;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
        $getOneBlog = getOneBanner(POST('id'));
        // ✅ فقط نام فایل ذخیره شود
        $fields = [
            'image_name' => $new_name,
        ];
        $updatePhoto = updateRecordToDatabase('blog', $fields, POST('id'), 'id');
        if ($updatePhoto) {
            // حذف تصویر قبلی
            if (!empty($getOneBlog['image_name'])) {
                $oldPath = PATH_UPLOADS_DIR . 'images/blog/' . $getOneBlog['image_name'];
                if (file_exists($oldPath)) {
                    clearstatcache(true, $oldPath);
                    @unlink($oldPath);
                }
            }
            responseJson([
                'text' => 'تصویر بنر با موفقیت ویرایش شد',
                'type' => 'success',
                'status' => 200,
                // ✅ فقط URL نسبی برگردان
                'src' => '/images/blog/' . $new_name,
                'oldImage' => 'yes'
            ]);
        } else {
            responseJson([
                'text' => 'مشکلی در ویرایش رخ داده است',
                'type' => 'warning',
                'status' => 400
            ]);
        }
    } else {
        responseJson([
            'text' => 'آپلود فایل با خطا مواجه شد.',
            'type' => 'error',
            'status' => 400
        ]);
    }
}

