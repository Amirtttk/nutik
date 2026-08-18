<?php
class Router {
    private $routes = [];

    // Add a new route
    public function add($route, $callback) {
        $this->routes[$route] = $callback;
    }

    // Run the router
    public function run() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = rtrim($url, '/');
        if (isset($this->routes[$url])) {
            call_user_func($this->routes[$url]);
        } else {
            $this->notFound();
        }
    }

    // Default 404 handler
    private function notFound() {
        if (isset($_SESSION['admin_info'])) {
            renderAdminOtherView('404');
        }
    }
}

?>