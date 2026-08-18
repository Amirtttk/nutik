<div class="error error-6 d-flex flex-row-fluid bgi-size-cover bgi-position-center"
    style="background-image: url(<?= url("assets/admin/media/error/bg6.jpg") ?>);">

    <!--begin::Content-->
    <div class="d-flex flex-column flex-row-fluid text-center">
        <h1 class="error-title font-weight-boldest text-white mb-12" style="margin-top: 12rem;">متاسفیم !...</h1>
        <p class="display-4 font-weight-bold text-white">
            به نظر می رسد مشکلی پیش آمده است.</br>
            ما روی آن کار می کنیم
        </p>
    </div>
    <!--end::Content-->
</div>
<?php
$url = url('assets/admin/css/style.bundle.rtl.css');
$url2 = url('assets/admin/css/pages/error/error.css');
$pageTitle = "صفحه یافت نشد";
$pageLink = "
    <link href='$url' rel='stylesheet' type='text/css' />
    <link href='$url2' rel='stylesheet' type='text/css' />
";
?>