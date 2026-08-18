<?php
$validate_fields = validator([
    'title' => 'required',
]);
if ($validate_fields["status"]) {
    $title         = $_POST['title'] ?? null;
    $english_title = $_POST['english_title'] ?? null;
    $parentId      = $_POST['parent_id'] ?? null;
    $level         = 0;

    if (!empty($parentId)) {
        $parentCategory = getCategoryById($parentId);

        if (!$parentCategory) {
            responseJson([
                'text'   => 'دسته والد یافت نشد',
                'type'   => 'warning',
                'status' => 400,
            ]);
            exit;
        }

        if ($parentCategory['level'] >= 2) {
            responseJson([
                'text'   => 'بیش از ۳ سطح دسته‌بندی مجاز نیست',
                'type'   => 'warning',
                'status' => 400,
            ]);
            exit;
        }

        $level = $parentCategory['level'] + 1;
    }

    $image_name = NULL;
    $image_url  = NULL;

    // فقط دسته‌های اصلی تصویر اجباری دارند
    if ($level === 0) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = PATH_UPLOADS_DIR . 'images/category/';
            $maxFileSize = 2 * 1024 * 1024; // ۲ مگابایت

            if ($_FILES['image']['size'] > $maxFileSize) {
                responseJson([
                    'text'   => 'حجم تصویر بیش از حد مجاز است. (حداکثر ۲ مگابایت)',
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

            $fileType = mime_content_type($_FILES['image']['tmp_name']);

            if (!array_key_exists($fileType, $allowedFileTypes)) {
                responseJson([
                    'text'   => 'نوع فایل مجاز نیست. (فقط png, jpg, gif, webp)',
                    'type'   => 'warning',
                    'status' => 400,
                ]);
                exit;
            }

            $suffix = $allowedFileTypes[$fileType];
            $image_name = md5($_FILES['image']['name'] . microtime(true)) . '.' . $suffix;
            $targetFilePath = $uploadDir . $image_name;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                responseJson([
                    'text'   => 'آپلود تصویر با خطا مواجه شد.',
                    'type'   => 'warning',
                    'status' => 400,
                ]);
                exit;
            }

            $image_url = '/images/category/' . $image_name;
        } else {
            responseJson([
                'text'   => 'برای دسته اصلی، تصویر الزامی است.',
                'type'   => 'warning',
                'status' => 400,
            ]);
            exit;
        }
    }
    // محاسبه sort فقط برای دسته‌های اصلی
    $sort = NULL;
    if ($level === 0) {
        $sort = 1;
        global $cn;
        $stmt = $cn->prepare("SELECT MAX(sort) AS max_sort FROM category WHERE level = 0");
        $stmt->execute();
        $maxSort = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($maxSort['max_sort'])) {
            $sort = (int)$maxSort['max_sort'] + 1;
        }
    }

    // ذخیره در دیتابیس
    $table = 'category';
    $fields = [
        'id'             => NULL,
        'title'          => $title,
        'english_title'  => $english_title,
        'parent_id'      => $parentId ?: NULL,
        'level'          => $level,
        'status'         => 1,
        'sort'           => $sort,
        'image_name'     => $image_name,
    ];

    if (insertRecordToDatabase($table, $fields)) {
        responseJson([
            'text'   => 'دسته‌بندی با موفقیت ایجاد شد',
            'type'   => 'success',
            'status' => 200,
            'src'    => $image_url,
        ]);
    } else {
        responseJson([
            'text'   => 'در ایجاد دسته مشکلی پیش آمده است',
            'type'   => 'warning',
            'status' => 400,
            'error'  => initFormErrors(),
        ]);
    }
} else {
    responseJson([
        'text'   => 'فیلدها را به درستی وارد کنید',
        'type'   => 'warning',
        'status' => 400,
        'error'  => initFormErrors(),
    ]);
}
