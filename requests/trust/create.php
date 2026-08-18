<?php
$validate_fields = validator([
    'title' => 'required',
    'description' => 'required',
]);
if ($validate_fields["status"]) {
    $image_name = NULL; // فقط نام فایل
    $image_url  = NULL; // URL برای فرانت
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $uploadDir = PATH_UPLOADS_DIR . 'images/trust/';

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
            'image/png'  => 'png',
            'image/jpeg' => 'jpg',
            'image/jpg'  => 'jpg',
            'image/gif'  => 'gif',
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
        $image_url = '/images/trust/' . $image_name;

    } else {
        responseJson([
            'text' => 'تصویر آپلود نشده است.',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
        exit;
    }
    // ایجاد رکورد در دیتابیس
    $table = 'trust';
    $fields = [
        'id'         => NULL,
        'title'       => $_POST['title'],
        'description'       => $_POST['description'],
        'status'     => 1,
        'image_name' => $image_name, // فقط نام فایل
    ];
    if (insertRecordToDatabase($table, $fields)) {
        responseJson([
            'text'   => 'ایجاد  با موفقیت انجام شد',
            'type'   => 'success',
            'status' => 200,
            'src'    => $image_url, // مسیر نمایش
        ]);
    } else {
        responseJson([
            'text'   => 'در ایجاد بنر مشکلی پیش آمده است',
            'type'   => 'warning',
            'status' => 400,
            'error'  => initFormErrors(),
        ]);
    }

} else {
    responseJson([
        'text'   => 'فیلدها را درست وارد کنید',
        'type'   => 'warning',
        'status' => 400,
        'error'  => initFormErrors(),
    ]);
}