<?php

$validate_fields = validator([
    'title' => 'required',
    'description' => 'required',
]);
if ($validate_fields["status"]) {
    $image_name = NULL; // فقط نام فایل
    $image_url = NULL; // URL برای فرانت
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = PATH_UPLOADS_DIR . 'images/blog/';
        // بررسی حجم
        $maxFileSize = 2 * 1024 * 1024; // 2 مگابایت
        if ($_FILES['image']['size'] > $maxFileSize) {
            responseJson([
                'text' => 'حجم تصویر بیش از حد مجاز است. (حداکثر 2 مگابایت)',
                'type' => 'warning',
                'status' => 400,
            ]);
            exit;
        }

        // بررسی نوع فایل با MIME واقعی
        $allowedFileTypes = [
            'image/png' => 'png',
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
        ];

        $fileType = mime_content_type($_FILES['image']['tmp_name']);

        if (!array_key_exists($fileType, $allowedFileTypes)) {
            responseJson([
                'text' => 'نوع فایل مجاز نیست. (فقط png, jpg, gif, webp)',
                'type' => 'warning',
                'status' => 400,
            ]);
            exit;
        }

        // ساخت نام یکتا برای فایل
        $suffix = $allowedFileTypes[$fileType];
        $image_name = md5($_FILES['image']['name'] . microtime(true)) . '.' . $suffix;

        // مسیر فیزیکی فایل روی سرور
        $targetFilePath = $uploadDir . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            responseJson([
                'text' => 'آپلود تصویر با مشکل مواجه شد.',
                'type' => 'warning',
                'status' => 400,
            ]);
            exit;
        }
        // مسیر نمایش تصویر برای فرانت
        $image_url = '/images/blog/' . $image_name;
    } else {
        responseJson([
            'text' => 'تصویر آپلود نشده است.',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
        exit;
    }
    $table = 'blog';
    $fields = [
        'id'=>NULL,
        'title' => $_POST['title'],
        'reading_time' => $_POST['reading_time'],
        'blog_categories_id' => $_POST['blog_categories_id'],
        'description' => $_POST['description'],
        'author' => $_POST['author'],
        'createAt' => date('Y-m-d H:i:s'),
        'status' => 1,
        'slug' =>$_POST['slug'],
        'label' =>$_POST['label'],
        'image_name' => $image_name,
    ];
    $keywordsArray = !empty($_POST['keywords'])
        ? array_map('trim', explode(',', $_POST['keywords']))
        : [];
    $fields['seo'] = json_encode([
        'title' => $_POST['title'],
        'keywords' => $keywordsArray,
        'seo_description' => $_POST['seo_description'] ?? '',
        'canonical' => $_POST['canonical'] ?? '',
    ], JSON_UNESCAPED_UNICODE);

    if (insertRecordToDatabase($table, $fields)) {
        responseJson([
            'text' => 'ایجاد مقاله با موفقیت انجام شد',
            'type' => 'success',
            'status' => 200,
            'src' => $image_url, // مسیر نمایش
        ]);
    } else {
        responseJson([
            'text' => 'در ایجاد مقاله مشکلی پیش آمده است',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
    }

} else {
    responseJson([
        'text' => 'فیلدها را درست وارد کنید',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}

