<?php
if (POST('userName') && POST('password')) {
    $getOneAdminForLogin = getOneUserForLogin(POST('userName'), POST('password'), TYPES_USERS[POST('type_user')][0]);
    if ($getOneAdminForLogin) {
        $getOneUser = getOneUser($getOneAdminForLogin['userID']);
        if ($getOneUser['status'] == 1) {
            $_SESSION['admin_info'] = [
                "userID" => $getOneAdminForLogin['userID'],
                "userType" => POST('type_user'),
                "userFullName" => $getOneUser['userFullName']
            ];
            $getUserLastLogin = getUserLastLogin($getOneAdminForLogin['userID']);
            if ($getUserLastLogin) {
                $fields = [
                    "date" => date('Y-m-d H:i:s')
                ];
                updateRecordToDatabase("users_last_login", $fields, $getOneAdminForLogin['userID'], "userID");
            } else {
                $fields = [
                    "userID" => $getOneAdminForLogin['userID'],
                    "date" => date('Y-m-d H:i:s')
                ];
                insertRecordToDatabase("users_last_login", $fields);
            }
            if(isset($_SESSION['user_sending'])) {
                unset($_SESSION['user_sending']);
            }
            responseJson([
                'status' => 200,
                'name' => $getOneUser['userFullName'],
            ]);
        } else {
            responseJson([
                'status' => 400,
            ]);
        }
    } else {
        responseJson([
            'status' => 400,
        ]);
    }
} else {
    responseJson([
        'status' => 300,
    ]);
}