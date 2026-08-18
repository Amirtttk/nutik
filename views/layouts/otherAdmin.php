<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">
<!--begin::Head-->

<head>
    <meta charset="utf-8" />
    <title><?= $_SESSION['page']['title'] ?></title>
    <meta name="description" content="Login page example" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="../../assets/admin/media/logos/favicon.ico" />  

    <?= $_SESSION['page']['link'] ?>
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->
    <?= $_SESSION['page']['content'] ?>
    <!--end::Main-->

    <!--brgin::Page Scripts-->
    <?= $_SESSION['page']['script'] ?>
    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>