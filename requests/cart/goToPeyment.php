<?php
if (isset($_SESSION['user_sending'])) {
    $random_cod = generateDigit();
    $_SESSION['random_cod'] = $random_cod;
    $price = POST('price')*10;
    $_SESSION['amount_payable'] =  $price;
    $getAllInformation = getAllInformation();
    $_SESSION['description'] = $_POST['description'];
    $url_idpay = apyKey_payment($random_cod, $price,$getAllInformation['zarinpal']);
    if ($url_idpay) {
        responseJson(["status" => 200, "text" => "در حال اتصال به درگاه پرداخت" ,"url" => $url_idpay]);
    }
    $validate_filds = validator([
        'userFullName' => 'required',
        'id' => 'required',
    ]);
    if ($validate_filds["status"]) {
        $table = 'users_info_public';
        $fields = [
            'userFullName' => $_POST['userFullName'],
            'id' => $_POST['id'],
        ];
        if (updateRecordToDatabase($table, $fields, $_SESSION['user_sending'],'id')) {

            $random_cod = generateDigit();
            $_SESSION['random_cod'] = $random_cod;
            $price = POST('price')*10;
            $_SESSION['amount_payable'] =  $price;
            $getAllInformation = getAllInformation();
            $url_idpay = apyKey_payment($random_cod, $price,$getAllInformation['zarinpal']);
            if ($url_idpay) {
                responseJson(["status" => 200, "text" => "در حال اتصال به درگاه پرداخت" ,"url" => $url_idpay]);
            }
        } else {
            responseJson([
                'text' => 'در ثبت اطلاعات  مشکلی پیش امده است',
                'type' => 'error',
                'status' => 400,
                'error' => initFormErrors(),
            ]);
        }
    } else {
        responseJson([
            'text' => 'فیلد ها را درست وارد کنید',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
    }
}
