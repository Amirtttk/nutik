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
    if ($file_size > $max_file_size) {
        responseJson([
            'text' => 'حجم تصویر نباید بیشتر از 1 مگابایت باشد.',
            'type' => 'error',
            'status' => 400
        ]);
        exit;
    }
    $new_name = md5($original_name . microtime(true)) . '.' . $suffix;
    $uploadPath = PATH_UPLOADS_DIR . 'images/blog/' . $new_name;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
        $getOneBlog = getInformation();
        $fields = [
            'imges_blogs' => $new_name,
        ];
        $updatePhoto = updateRecordToDatabase('information', $fields, POST('id'), 'id');
        if ($updatePhoto) {
            if (!empty($getOneBlog['imges_blogs'])) {
                $oldPath = PATH_UPLOADS_DIR . 'images/blog/' . $getOneBlog['imges_blogs'];
                if (file_exists($oldPath)) {
                    clearstatcache(true, $oldPath);
                    @unlink($oldPath);
                }
            }
            responseJson([
                'text' => 'تصویر بنر مقالات با موفقیت ویرایش شد',
                'type' => 'success',
                'status' => 200,
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