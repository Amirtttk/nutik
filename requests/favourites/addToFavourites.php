<?php
if (isset($_SESSION['user_sending'])) {
    $checkInProductFavourites = checkInProductFavourites(POST('product_id'));
    if (!$checkInProductFavourites) {
        $table = 'favourtes';
        $filds = [
            "id" => NULL,
            "user_id" => $_SESSION['user_sending'],
            "product_id" => POST('product_id'),
        ];
        if (insertRecordToDatabase($table, $filds)) {
            global $cn;
            $lastInsert = $cn->lastInsertId();
            responseJson([
                'text' => 'محصول با موفقیت به علاقه مندی اضافه شد',
                'type' => 'success',
                'status' => 200,
                'id' => $lastInsert,
            ]);
        } else {
            responseJson([
                'text' => 'در اضافه کردن به علاقه مندی مشکلی پیش آمده ',
                'type' => 'error',
                'status' => 400,
            ]);
        }
    } else {
        responseJson([
            'text' => 'این محصول در علاقه مندی های شما وجود دارد',
            'type' => 'warning',
            'status' => 400,
        ]);
    }
} else {
    responseJson([
        'text' => 'برای اضافه کردن به علاقه مندی ها ابتدا ورود | ثبت نام کنید',
        'type' => 'warning',
        'status' => 400,
    ]);
}
