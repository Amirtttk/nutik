<?php
if (POST('id') && POST('status')) {
    if (changeStatusLink(POST('status'), POST('id'))) {
        responseJson([
            'text' => "تغییر وضعیت با موفقیت انجام شد",
            "type" => "success",
            "status" => 200
        ]);
    } else {
        responseJson([
            'text' => "مشکلی در تغییر وضعیت رخ داده است",
            "type" => "warning",
            "status" => 400
        ]);
    }
} else {
    responseJson([
        'text' => "مشکلی در تغییر وضعیت رخ داده است",
        "type" => "warning",
        "status" => 400
    ]);
}