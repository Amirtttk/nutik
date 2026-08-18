<?php
$query = $_SERVER['QUERY_STRING'] ?? '';
$target = url('/reservationComplete' . ($query !== '' ? '?' . $query : ''));
redirect($target);
