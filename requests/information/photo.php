<?php
$files = [];
foreach ($_FILES['image'] as $key => $fileData) {
    foreach ($fileData as $index => $value) {
        $files[$index][$key] = $value;
    }
}
foreach ($files as $file) {
    if (empty($file['size']) || $file['error'] !== UPLOAD_ERR_OK) {
        continue;
    }
    $uploadDir = PATH_UPLOADS_DIR . 'images/logo/';
    $maxFileSize = 1 * 1024 * 1024;
    if ($file['size'] > $maxFileSize) {
        responseJson([
            'text'   => 'حجم تصویر نباید بیش از 1 مگابایت باشد.',
            'type'   => 'warning',
            'status' => 400,
        ]);
        exit;
    }
    $allowedFileTypes = [
        'image/png'  => 'png',
        'image/jpeg' => 'jpg',
        'image/jpg'  => 'jpg',
        'image/gif'  => 'gif',
        'image/webp' => 'webp',
    ];
    $fileType = mime_content_type($file['tmp_name']);
    if (!array_key_exists($fileType, $allowedFileTypes)) {
        responseJson([
            'text'   => 'فقط فایل‌های png، jpg، gif و webp مجاز هستند.',
            'type'   => 'warning',
            'status' => 400,
        ]);
        exit;
    }
    $suffix = $allowedFileTypes[$fileType];
    $originalName = $file['name'];
    $newName = md5($originalName . microtime(true)) . '.' . $suffix;
    $targetPath = $uploadDir . $newName;
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        responseJson([
            'text'   => 'آپلود تصویر با خطا مواجه شد.',
            'type'   => 'warning',
            'status' => 400,
        ]);
        exit;
    }
    $information = getInformation('1');
    if (!$information) {
        unlink($targetPath);
        responseJson([
            'text'   => 'اطلاعات سایت یافت نشد.',
            'type'   => 'warning',
            'status' => 404,
        ]);
        exit;
    }
    $table = 'information';
    $fields = [
        'image_name' => $newName,
    ];
    $updateResult = updateRecordToDatabase($table, $fields, POST('id'), 'id');
    if ($updateResult) {
        if (!empty($information['image_name'])) {
            $oldPath = PATH_UPLOADS_DIR . 'images/logo/' . $information['image_name'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }
        responseJson([
            'text'        => 'تصویر لوگو با موفقیت ویرایش شد.',
            'type'        => 'success',
            'status'      => 200,
            'src'         => '/images/logo/' . $newName,
            'old_removed' => true,
        ]);
    } else {
        unlink($targetPath);
        responseJson([
            'text'   => 'در ویرایش تصویر مشکلی پیش آمد.',
            'type'   => 'warning',
            'status' => 400,
        ]);
    }
}
if (!empty($_FILES['image']['size'])) {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $max_file_size = 1048576; // 1MB
    $original_name = $_FILES['image']['name'];
    $file_size     = $_FILES['image']['size'];
    $suffix        = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
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
    $new_name = md5($original_name . microtime(true)) . '.' . $suffix;
    $uploadPath = PATH_UPLOADS_DIR . 'images/logo/' . $new_name;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
        $getOneBlog = getInformation();
        $fields = [
            'image_name' => $new_name,
        ];
        $updatePhoto = updateRecordToDatabase('information', $fields, POST('id'), 'id');
        if ($updatePhoto) {
            if (!empty($getOneBlog['image_name'])) {
                $oldPath = PATH_UPLOADS_DIR . 'images/logo/' . $getOneBlog['image_name'];
                if (file_exists($oldPath)) {
                    clearstatcache(true, $oldPath);
                    @unlink($oldPath);
                }
            }
            responseJson([
                'text' => 'تصویر لوگو با موفقیت ویرایش شد ',
                'type' => 'success',
                'status' => 200,
                'src' => '/images/logo/' . $new_name,
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