<?php
if(isset($_SESSION['confirm_code'])) {
    unset($_SESSION['confirm_code']);
    unset($_SESSION['confirm_code_time']);
}