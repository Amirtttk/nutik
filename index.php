<?php
// بارگذاری core (بدون وابستگی به مسیر ثابت در .htaccess)
require_once __DIR__ . '/core.php';

// درخواست به requests/* — بعد از لود core، فایل درخواست را اجرا کن
if (!empty($_GET['__request'])) {
    $req = (string) $_GET['__request'];
    if (strpos($req, 'requests/') === 0 && strpos($req, '..') === false) {
        $file = __DIR__ . '/' . $req;
        if (is_file($file)) {
            require $file;
            return;
        }
    }
}

require_once 'tools/router.php';

$router = new Router();

// Check if the URL starts with '/admin'
if ($adminRout) {
    require_once 'routers/admin.php';
} else {
    require_once 'routers/user.php';
}


// Run the router
$router->run();

// Function to render a user view with user layout
function renderUserView($view)
{
    renderViewWithLayout('user', 'user/' . $view);
}

// Function to render a user view with user layout
function renderUserProfileView($view)
{
    renderViewWithLayout('userProfile', 'user/' . $view);
}
// Function to render an admin view with admin layout
function renderAdminView($view)
{
    renderViewWithLayout('admin', 'admin/' . $view);
}
// Function to render an admin view with admin layout
function renderAdminOtherView($view)
{
    renderViewWithLayout('otherAdmin', 'admin/' . $view);
}
function renderUserLogin($view)
{
    renderViewWithLayout('userLogin', 'user/' . $view);
}
// Function to render a view with a specific layout
function renderViewWithLayout($layout, $view)
{
    $viewFile = __DIR__ . '/views/' . $view . '.php';
    $layoutFile = __DIR__ . '/views/layouts/' . $layout . '.php';

    if (file_exists($viewFile) && file_exists($layoutFile)) {
        ob_start();
        include $viewFile;
        if (!isset($pageTitle)) {
            $pageTitle = "";
        }
        if (!isset($pageScript)) {
            $pageScript = "";
        }
        if (!isset($pageLink)) {
            $pageLink = "";
        }
        $_SESSION['page'] = [
            "content" => ob_get_clean(),
            "title" => $pageTitle,
            "script" => $pageScript,
            "link" => $pageLink,
        ];
        include $layoutFile;
    } else {
        echo 'View or Layout not found';
    }
}