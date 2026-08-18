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
    if ($_FILES["fileUrl"]["size"] > 100000000) {
        responseJson([
            'text' => 'فایل ارسالی باید کمتر از 100 مگابایت باشد',
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
$random_int = random_int(1, 9999999);
    if (isset($_SESSION['user_sending'])) {
        $table = 'tickets';
        $fields = [
            'userID' => $_SESSION['user_sending'],
            'title' => $_POST['title'],
            'status' => 1,
            'timeSend' => date('Y-m-d H:i:s'),
            'code_tickets' => $random_int
        ];
        $sender = isset($_SESSION['user_sending']) ? 2 : 1;
        if (insertRecordToDatabase($table, $fields)) {
            global $cn;
            $lastId = $cn->lastInsertId();
            $table = 'chat_tickets';
            $fields = [
                'id' => null,
                'ticketId' => $lastId,
                'text' => $_POST['text'],
                'fileUrl' => $file_name_uploaded,
                'sender' => $sender,
                'timeSend' => date('Y-m-d H:i:s'),
            ];
            if (insertRecordToDatabase($table, $fields)) {
                   responseJson([
                    'text' => 'تیکت جدید با موفقیت ایجاد شد',
                    'type' => 'success',
                    'status' => 200,
                ]);
            } else {
                responseJson([
                    'text' => 'درایجاد تیکت مشکلی پیش آمده ',
                    'type' => 'error',
                    'status' => 400,
                ]);
            }
        } else {
            responseJson([
                'text' => 'درایجاد تیکت مشکلی پیش امده است',
                'type' => 'error',
                'status' => 400,
            ]);
        }
    } else {
        responseJson([
            'text' => 'لطفا ابتدا ورود | ثبت نام کنید  ',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
    }

