<?php
if ($_POST['Id']) {
    if (DeletedBlog($_POST['Id'])) {
        responseJson([
            'text' => 'حذف  با موفقیت انجام شد ',
            'type' => 'success',
            'status' => 200,
        ]);

    } else {
        responseJson([
            'text' => 'مشکلی در حذف  رخ داده است',
            'type' => 'warning',
            'status' => 400,
        ]);

    }
}

