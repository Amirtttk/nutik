<?php
if ($_FILES === [] and $_POST['text'] == '') {
    responseJson([
        'text' => 'پیغامی وارد کنید ',
        'type' => 'warning',
        'status' => 400,
    ]);
}

$file_name_uploaded = null;

if ($_FILES != []) {
    $extensions = array("zip", "png", "jpg", "jpeg");
    $ext = pathinfo($_FILES["fileUrl"]['name'], PATHINFO_EXTENSION);

    if (!in_array($ext, $extensions)) {
        responseJson([
            'text' => 'فایل‌های مجاز: png, jpg, jpeg, zip',
            'type' => 'error',
            'status' => 400,
        ]);
    }

    if ($_FILES["fileUrl"]["size"] > 10000000) {
        responseJson([
            'text' => 'فایل ارسالی باید کمتر از 10 مگابایت باشد',
            'type' => 'error',
            'status' => 400,
        ]);
    }

    $original_name = $_FILES["fileUrl"]['name'];
    $suffix = pathinfo($_FILES["fileUrl"]['name'], PATHINFO_EXTENSION);
    $new_name = md5($original_name . microtime()) . '.' . $suffix;
    $path = PATH_UPLOADS_DIR . "documents/tickets/" . $new_name;

    if (move_uploaded_file($_FILES['fileUrl']['tmp_name'], $path)) {
        $file_name_uploaded = $new_name;
    }
}

if (!$_POST['text']) {
    $_POST['text'] = null;
}

$table = 'chat_tickets';
$sender = isset($_SESSION['user_sending']) ? 2 : 1;

$fields = [
    'id' => null,
    'ticketId' => $_POST['ticketId'],
    'text' => $_POST['text'],
    'fileUrl' => $file_name_uploaded,
    'sender' => $sender,
    'timeSend' => date('Y-m-d H:i:s'),
];

if (insertRecordToDatabase($table, $fields)) {
    global $cn;
    $lastId = $cn->lastInsertId();

    if ($sender === 1) {
        // ادمین ارسال کرده، پیامک بده به کاربر

        $ticketId = $_POST['ticketId']; 
        $ticket = getTicketById($ticketId); // باید این تابع رو داشته باشی
        if ($ticket && $ticket['userID']) {
            $user = getOneUser($ticket['userID']); // باید این تابع رو هم داشته باشی

            if ($user && $user['userMobile']) {
                $mobile = '09' . $user['userMobile']; // فرض بر اینکه شماره بدون صفر ذخیره شده
                //sendSMSPattern(353710, $mobile, $ticket['code_tickets']); // ارسال پیامک: "تیکت شماره X پاسخ داده شد"
            }
        }
    }

    if (isset($_SESSION['user_sending'])) {
        $getChatTicketsById = getChatTicketsById($lastId);
    } else {
        $getChatTicketsById = getChatTicketsByIdAdmin($lastId);
    }

    $date = jdate("r", dateToTimestamp($getChatTicketsById['timeSend']));
    $date_org = $date;

    responseJson([
        'text' => 'پیغام با موفقیت ارسال شد',
        'type' => 'success',
        'status' => 200,
        'textTicket' => $_POST['text'],
        'date_org' => $date_org,
        'fileUrl' => $getChatTicketsById['fileUrl'] ?? null,
        'id' => $getChatTicketsById['id'] ?? null,
        'link' => PATH_UPLOADS_DIR,
    ]);
} else {
    responseJson([
        'text' => 'مشکلی در ایجاد پیغام رخ داده است',
        'type' => 'error',
        'status' => 400,
    ]);
}
