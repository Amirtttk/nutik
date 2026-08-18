<?php
//بررسی اینکه کاربر نتونه از 3 ادرس بیشتر درج کنه
if (isset($_SESSION['user_sending'])){
    $validate_filds = validator([
        'name' => 'required|text',
        'family' => 'required|text',
        'city_id' => 'required|number',
        'address' => 'required|text',
        'mobile' => 'required|mobile',
        'post_code' => 'required',
    ]);
    if ($validate_filds["status"]) {
        $table = 'address';
        $fields = [
            'id' => NULL,
            'name' => $_POST['name'],
            'family' => $_POST['family'],
            'city_id' => $_POST['city_id'],
            'address' => $_POST['address'],
            'mobile' => $_POST['mobile'],
            'post_code' => $_POST['post_code'],
            'description' => $_POST['description'],
            'userID' => $_SESSION['user_sending'],
        ];
        //dd($fields);
        if (insertRecordToDatabase($table, $fields)) {
           global $cn;
           $id = $cn->lastInsertId();
           $getCityAndProvinceByCityId = getCityAndProvinceByCityId($_POST['city_id']);
           $city = "شهر: " . $getCityAndProvinceByCityId['city_name'] . "\n" . ' - ' .  "استان: " . $getCityAndProvinceByCityId['province_name'] . "\n";
           $fullName = $_POST['name'] . ' ' . $_POST['family'];
           $address = "شهر: " . $getCityAndProvinceByCityId['city_name'] . "\n" . ' - ' . "استان: " . $getCityAndProvinceByCityId['province_name'] . "\n" . ' - ' .$_POST['address'];
            responseJson([
                'text' => '  ایجاد آدرس با موفقیت انجام شد',
                'type' => 'success',
                'status' => 200,
                'fullName'=>$fullName,
                'city' => $city,
                'address' => $address,
                'mobile' => $_POST['mobile'],
                'post_code' => $_POST['post_code'],
                'description' => $_POST['description'],
                'id' =>$id
            ]);
        } else {
            responseJson([
                'text' => 'درایجاد آدرس مشکلی پیش امده است',
                'type' => 'error',
                'status' => 400,
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
