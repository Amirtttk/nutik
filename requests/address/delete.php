<?php
if ($_POST['Id']) {
    $getAddressUser = selectAdressByUserId($_SESSION['user_sending']);
    $len = 0;
    if (DeletedAddress($_POST['Id'])) {
        $len = count($getAddressUser);
        responseJson([
            'text' => 'حذف  با موفقیت انجام شد ',
            'type' => 'success',
            'status' => 200,
            'len' => $len,
        ]);

    } else {
        responseJson([
            'text' => 'مشکلی در حذف  رخ داده است',
            'type' => 'warning',
            'status' => 400,

        ]);

    }
}


