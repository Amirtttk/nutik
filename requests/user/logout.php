<?php
if(isset($_SESSION['user_sending'])) {
    unset($_SESSION['user_sending']);
    responseJson([
        "status" => 200
    ]);
}