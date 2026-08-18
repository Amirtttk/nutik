<?php
$selectMobileContactUs = selectMobileContactUs($_POST['mobile']);
if (!$selectMobileContactUs){
    $validate_filds = validator([
        'nameAndFamily' => 'required|persian_chars',
        'mobile' => 'required|mobile',
        'text' => 'required|persian_chars',
    ]);
    if ($validate_filds["status"]){
        $table = 'contactUs';
        $filds = [
            "nameAndFamily" => $_POST["nameAndFamily"],
            "mobile" => $_POST["mobile"],
            "text" => $_POST["text"],
            "status" => 2,
            "createAt" =>  date('Y-m-d H:i:s'),
        ];

        if(insertRecordToDatabase($table, $filds)){
            responseJson([
                'text' => 'در خواست شما با موفقیت ارسال شد ',
                'type' => 'success',
                'status' => 200,
            ]);
        }
        else{
            responseJson([
                'text' => 'مشکلی در ارسال درخواست رخ داده است',
                'type' => 'warning',
                'status' => 400,
                'error' => initFormErrors(),
            ]);
        }
    }
    else{
        responseJson([
            'text' => 'لطفا فیلد ها را به درستی وارد کنید',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
    }

}
elseif ($selectMobileContactUs['status'] == 2){
    responseJson([
        'text' => 'شما قبلا در خواستی داشته داشته اید لطفا منتظر تایید باشید ',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}else{
    $validate_filds = validator([
        'nameAndFamily' => 'required|persian_chars',
        'mobile' => 'required|mobile',
        'text' => 'required|persian_chars',
    ]);
    if ($validate_filds["status"]){
        $table = 'cantact_us_req';
        $filds = [
            "nameAndFamily" => $_POST["nameAndFamily"],
            "mobile" => $_POST["mobile"],
            "text" => $_POST["text"],
            "status" => 2,
            "createAt" =>  date('Y-m-d H:i:s'),
        ];
        if(insertRecordToDatabase($table, $filds)){
            responseJson([
                'text' => 'در خواست شما با موفقیت ارسال شد ',
                'type' => 'success',
                'status' => 200,
            ]);
        }
        else{
            responseJson([
                'text' => 'مشکلی در ارسال درخواست رخ داده است',
                'type' => 'warning',
                'status' => 400,
                'error' => initFormErrors(),
            ]);
        }
    }
    else{
        responseJson([
            'text' => 'لطفا فیلد ها را به درستی وارد کنید',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
    }
}

