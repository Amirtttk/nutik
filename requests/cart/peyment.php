<?php
if ((int)$_POST['price'] > 0 ){

    $URL = '/checkout';
    if (isset($_SESSION['user_sending'])) {

        responseJson([
            'text' => 'کمی صبر کنید',
            'status' => 200,
            'type' => 'success',
            'url' =>$URL
        ]);
    }
}else{
    responseJson([
        'text' => 'ابتدا باید محصولی به سبد خرید اضافه کنید',
        'status' => 400,
        'type' => 'warning',
    ]);
}

