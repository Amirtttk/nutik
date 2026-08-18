<?php
if (isset($_SESSION['admin_info'])) {
    unset($_SESSION['admin_info']);
    responseJson([
        "status" => 200
    ]);
} else {
    responseJson([
        "status" => 400
    ]);
}