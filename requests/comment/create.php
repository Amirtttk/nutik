<?php

if (isset($_SESSION['user_sending'])) {
    $selectMobileContactUs = selectMobileComments($_SESSION['user_sending']);
    if (!$selectMobileContactUs){
        $validate_filds = validator([
            'text' => 'required|text',
        ]);
        if ($validate_filds["status"]){
            $table = 'comments';
            $fields = [
                'id' => NULL,
                'text' => $_POST['text'],
                'nameAndFamily' => $_POST['nameAndFamily'],
                'userID' => $_SESSION['user_sending'],
                'status' => 2,
                'productID' => $_POST['product'],
                'createAt' => date('Y-m-d H:i:s'),
                'text_admin' => '',
            ];
            if(insertRecordToDatabase($table, $fields)){
                responseJson([
                    'text' => 'نظر شما باموفقیت ثبت گردید منتطر پاسخ بمانید ',
                    'type' => 'success',
                    'status' => 200,
                ]);
            }
            else{
                responseJson([
                    'text' => 'مشکلی در ارسال نظر رخ داده است',
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
            'text' => 'شما قبلا نظرارسال کرده اید لطفا منتظر تایید باشید ',
            'type' => 'warning',
            'status' => 400,
            'error' => initFormErrors(),
        ]);
    }else{
        $validate_filds = validator([
            'text' => 'required',
        ]);
        if ($validate_filds["status"]){
            $table = 'comments';
            $fields = [
                'id' => NULL,
                'text' => $_POST['text'],
                'nameAndFamily' => $_POST['nameAndFamily'],
                'userID' => $_SESSION['user_sending'],
                'status' => 2,
                'productID' => $_POST['product'],
                'createAt' => date('Y-m-d H:i:s'),
                'text_admin' => '',
            ];
            if(insertRecordToDatabase($table, $fields)){
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


}else{
    responseJson([
        'text' => 'ابتدا ورود | ثبت نام کنید ',
        'type' => 'warning',
        'status' => 400,
        'error' => initFormErrors(),
    ]);
}
