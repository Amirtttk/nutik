<?php
function downloadFile($fileName) {
    $file_path = 'public/documents/tickets/' . $fileName;

    if (!file_exists($file_path)) {
        return false;
    }

    // دریافت نوع MIME بر اساس پسوند فایل
    $mimeType = mime_content_type($file_path);
    if (!$mimeType) {
        $mimeType = 'application/octet-stream'; // مقدار پیش‌فرض
    }

    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Content-Length: ' . filesize($file_path));
    readfile($file_path);
    exit;
}

// دانلود فایل اگر موجود باشد
$getOneSupport = getChatTicketsForDownload(GET("id"));
if (!empty($getOneSupport['fileUrl'])) {
    downloadFile($getOneSupport['fileUrl']);
}