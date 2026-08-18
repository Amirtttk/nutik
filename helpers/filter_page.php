<?php
if ($adminRout) {
    if (isset($_SESSION['admin_info']) && pageName() == "/admin/login") {
        abort();
    }
    $filter_page = [
        1 => [],
        2 => [

        ],
    ];
    $filter_page_all = ["/admin/login"];
    if (!in_array(pageName(), $filter_page_all)) {
        if (!isset($_SESSION['admin_info'])) {
            abort();
        }
    }

    foreach ($filter_page as $level => $pages) {
        if (isset($_SESSION['admin_info'])) {
            if ($_SESSION['admin_info']['userType'] == $level) {
                if (in_array(pageName(), $pages)) {
                    abort();
                }
            }
        }
    }
}
