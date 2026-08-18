<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">

                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    مدیریت درخواست ها
                </h5>
                <!--end::Page Title-->
                <!--begin::اقدامات-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200">
                </div>
                <span class="text-muted font-weight-bold mr-4">مدیریت درخواست ها </span>
                <!--end::اقدامات-->
            </div>
            <!--end::اطلاعات-->
            <!--end::اطلاعات-->
        </div>
    </div>
    <!--end::زیر هدر-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="">
                <div class="card-body">
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon"><i class="flaticon2-favourite text-primary"></i></span>
                                <h3 class="card-label"> در خواست های تماس با ما</h3>
                            </div>
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_7_3">
                                            <span class="nav-icon"><i class="fa fa-sort-amount-down"></i></span>
                                            بررسی نشده ها
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_7_2">
                                            <span class="nav-icon"><i class="fa fa-sort-amount-up"></i></span>
                                            بررسی شده
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_tab_pane_7_3" role="tabpanel">
                                    <table class="table table-bordered table-hover table-checkable" id="manager"
                                           style="margin-top: 13px !important">
                                        <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>نام و نام خانوادگی </th>
                                            <th>موبایل</th>
                                            <th>توضیحات</th>
                                            <th>تاریخ درخواست</th>
                                            <th>وضعیت</th>
                                            <th>غیر فعال | فعال</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $keyNumber = 1;
                                        $getAllContactUs2 = getAllContactUs2();
                                        if ($getAllContactUs2) {
                                            foreach ($getAllContactUs2 as $AllContactUs2){
//                                                $time = jdate("B", (dateToTimestamp($AllContactUs2['createAt'])));
                                                $date = jdate("r", (dateToTimestamp($AllContactUs2['createAt'])));
                                                $createAt1 = $date;
                                            ?>
                                            <tr>
                                                <td><?= $keyNumber++ ?></td>
                                                <td>
                                                    <?= $AllContactUs2['nameAndFamily']; ?>
                                                </td>
                                                <td>
                                                    <?= $AllContactUs2['mobile']; ?>
                                                </td>
                                                <td>
                                                    <?= $AllContactUs2['text'] ?>
                                                </td>
                                                <td>
                                                    <?= $createAt1; ?></td>
                                                <td id="statusShow<?= $AllContactUs2['id'] ?>">
                                                    <?php
                                                    if ($AllContactUs2['status'] == 1) {
                                                        ?>
                                                        <span
                                                                class="label label-lg font-weight-bold label-light-success label-inline">بررسی شده</span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span
                                                                class="label label-lg font-weight-bold label-light-warning label-inline">بررسی نشده</span>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td id="statusCantactUs<?= $AllContactUs2['id'] ?>">
                                                    <?php
                                                    if ($AllContactUs2['status'] == 2) {
                                                        ?>
                                                        <span class="switch switch-icon">
                                                                    <label>
                                                                        <input id="changeStatusInput<?= $AllContactUs2['id'] ?>"
                                                                               onclick="statusCantactUs(<?= $AllContactUs2['id'] ?>, 1)"
                                                                               type="checkbox" name="select">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="switch switch-icon">
                                                                    <label>
                                                                        <input
                                                                                id="changeStatusInput<?= $AllContactUs2['id'] ?>"
                                                                                onclick="statusCantactUs(<?= $AllContactUs2['id'] ?>, 2)"
                                                                                type="checkbox" checked="checked" name="select">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        }else {
                                            ?>
                                            <div class="alert alert-warning col-12 col-md-12">
                                                <h3 class="text-center">
                                                    هیچ درخواستی وجود ندارد
                                                     </h3>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <br>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_7_2" role="tabpanel">
                                    <table class="table table-bordered table-hover table-checkable" id="manager"
                                           style="margin-top: 13px !important">
                                        <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>نام و نام خانوادگی </th>
                                            <th>موبایل</th>
                                            <th>توضیحات</th>
                                            <th>تاریخ درخواست</th>
                                            <th>وضعیت</th>
                                            <th>غیر فعال | فعال</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $keyNumber = 1;
                                        $getAllContactUs2 = getAllContactUs1();
                                        if ($getAllContactUs2) {
                                            foreach ($getAllContactUs2 as $AllContactUs2){
//                                                $time = jdate("B", (dateToTimestamp($AllContactUs2['createAt'])));
                                                $date = jdate("r", (dateToTimestamp($AllContactUs2['createAt'])));
                                                $createAt1 = $date;
                                                ?>
                                                <tr>
                                                    <td><?= $keyNumber++ ?></td>
                                                    <td>
                                                        <?= $AllContactUs2['nameAndFamily']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $AllContactUs2['mobile']; ?>
                                                    </td>
                                                    <td>
                                                        <?= $AllContactUs2['text'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $createAt1; ?></td>
                                                    <td id="statusShow<?= $AllContactUs2['id'] ?>">
                                                        <?php
                                                        if ($AllContactUs2['status'] == 1) {
                                                            ?>
                                                            <span
                                                                    class="label label-lg font-weight-bold label-light-success label-inline">بررسی شده</span>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span
                                                                    class="label label-lg font-weight-bold label-light-warning label-inline">بررسی نشده</span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td id="statusCantactUs<?= $AllContactUs2['id'] ?>">
                                                        <?php
                                                        if ($AllContactUs2['status'] == 2) {
                                                            ?>
                                                            <span class="switch switch-icon">
                                                                    <label>
                                                                        <input id="changeStatusInput<?= $AllContactUs2['id'] ?>"
                                                                               onclick="statusCantactUs(<?= $AllContactUs2['id'] ?>, 1)"
                                                                               type="checkbox" name="select">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="switch switch-icon">
                                                                    <label>
                                                                        <input
                                                                                id="changeStatusInput<?= $AllContactUs2['id'] ?>"
                                                                                onclick="statusCantactUs(<?= $AllContactUs2['id'] ?>, 2)"
                                                                                type="checkbox" checked="checked" name="select">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }else {
                                            ?>
                                            <div class="alert alert-warning col-12 col-md-12">
                                                <h3 class="text-center">
                                                    هیچ درخواستی وجود ندارد
                                                </h3>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <br>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin: جدول داده ها-->
                    <!--end: جدول داده ها-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->

<?php
$pageTitle = "درخواست های ارتباط با ما";
$pageScript = "
    <script src='../../../assets/admin/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/widgets.js?v=7.0.6'></script>
    <script src='../../../assets/admin/plugins/custom/datatables/datatables.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/crud/datatables/basic/paginations.js?v=7.0.6'></script>
    <script src='../../assets/admin/js/sweetalert.js'></script>
    <script src='../../assets/admin/js/main.js'></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
";
$pageLink = "
    <link href='../../assets/admin/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/themes/layout/header/base/light.rtl.css' rel='stylesheet'
        type='text/css' />
    <link href='../../assets/admin/css/themes/layout/aside/dark.rtl.css' rel='stylesheet' type='text/css' />
";
?>
