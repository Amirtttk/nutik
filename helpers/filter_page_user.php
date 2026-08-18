<?php
$array_filter_not_logined = [
    "/profile/myInformation",
];
if (in_array(pageName(), $array_filter_not_logined)) {
    if (!isset($_SESSION['user_sending'])) {
        abort();
    }
}
