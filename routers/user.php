<?php
$router->add('', function () {
    renderUserView('index');
});

$router->add('/index', function () {
    renderUserView('index');
});
$router->add('/faq', function () {
    renderUserView('faq');
});
$router->add('/aboutUs', function () {
    renderUserView('aboutUs');
});
$router->add('/contactUs', function () {
    renderUserView('contactUs');
});
$router->add('/login', function () {
    renderUserLogin('login');
});
$router->add('/dashboard', function () {
    renderUserProfileView('dashboard');
});
$router->add('/address', function () {
    renderUserProfileView('dashboardAddress');
});
$router->add('/details', function () {
    renderUserProfileView('dashboardDetails');
});
$router->add('/favorites', function () {
    renderUserProfileView('dashboardFavorites');
});
$router->add('/ticket', function () {
    renderUserProfileView('dashboardTicket');
});
$router->add('/ticketDetails', function () {
    renderUserProfileView('dashboardTicketDetails');
});
$router->add('/dashboardMessages', function () {
    renderUserProfileView('dashboardMessages');
});
$router->add('/orders', function () {
    renderUserProfileView('dashboardOrders');
});
$router->add('/ordersDetails', function () {
    renderUserProfileView('dashboardOrdersDetails');
});
$router->add('/blogs', function () {
    renderUserView('blog');
});
$router->add('/blogSingle', function () {
    renderUserView('blogSingle');
});
$router->add('/rules', function () {
    renderUserView('rules');
});
$router->add('/singleProduct', function () {
    renderUserView('singleProduct');
});
$router->add('/cart', function () {
    renderUserView('cart');
});
$router->add('/checkout', function () {
    renderUserView('checkout');
});
$router->add('/callback', function () {
    renderUserView('callback');
});
$router->add('/appointmentCallback', function () {
    renderUserView('appointmentCallback');
});
$router->add('/search', function () {
    renderUserView('search');
});
$router->add('/404', function () {
    renderUserView('404');
});
$router->add('/checkoutComplete', function () {
    renderUserView('checkoutComplete');
});
$router->add('/checkoutNoComplete', function () {
    renderUserView('checkoutNoComplete');
});
$router->add('/downloadFile', function () {
    renderAdminView('downloadFile');
});
$router->add('/reservationComplete', function () {
    renderUserView('reservationComplete');
});
$router->add('/blogSearch', function () {
    renderUserView('blogSearch');
});