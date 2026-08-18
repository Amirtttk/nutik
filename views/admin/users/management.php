<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    مدیریت کاربران
                </h5>
                <!--end::Page Title-->
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
            <div class="card card-custom">
                <div class="">
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon"><i class="flaticon2-favourite text-primary"></i></span>
                                <h3 class="card-label">
                                    مدیریت کاربران  </h3>
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
                                                <th>شماره</th>
                                                <th>جنسیت</th>
                                                <th>وضعیت</th>
                                                <th>غیر فعال | فعال</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $keyNumber = 1;
                                            $getAllUsers = getAllUsers();
                                            if ($getAllUsers) {
                                                foreach ($getAllUsers as $key => $AllUsers) {

                                                    ?>
                                                    <tr>
                                                        <td><?= $keyNumber++ ?></td>
                                                        <td style="min-width:100px;">
                                                            <?= $AllUsers['userFullName'] ?>
                                                        </td>
                                                        <td>09<?= $AllUsers['userMobile'] ?></td>
                                                        <td>
                                                            <?php
                                                            if ($AllUsers['gender'] == 1) {
                                                                ?>
                                                                <span class="label label-lg font-weight-bold label-light-primary label-inline">مرد</span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span class="label label-lg font-weight-bold label-light-info label-inline">زن</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td id="statusShow<?= $AllUsers['userID'] ?>">
                                                            <?php
                                                            if ($AllUsers['status'] == 1) {
                                                                ?>
                                                                <span class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span class="label label-lg font-weight-bold label-light-warning label-inline">غیر
                                                                    فعال</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td id="statusUser<?= $AllUsers['userID'] ?>">
                                                            <?php
                                                            if ($AllUsers['status'] == 2) {
                                                                ?>
                                                                <span class="switch switch-icon">
                                                                    <label>
                                                                        <input id="changeStatusInput<?= $AllUsers['userID'] ?>"
                                                                            onclick="statusUser(<?= $AllUsers['userID'] ?>, 1)"
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
                                                                            id="changeStatusInput<?= $AllUsers['userID'] ?>"
                                                                            onclick="statusUser(<?= $AllUsers['userID'] ?>, 2)"
                                                                            type="checkbox" checked="checked" name="select">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td style="min-width:110px;">
                                                            <a href="<?= url("/admin/tickets/createNewticket?userId={$AllUsers['userID']}") ?>"
                                                                class="btn btn-icon btn-primary mr-2 user-des btn-sm"
                                                                data-toggle="tooltip" title="ایجاد تیکت جدید " data-theme="dark">
                                                                <span
                                                                    class="svg-icon svg-icon-dark svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\ارتباطات\Write.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none"
                                                                           fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                            <path
                                                                                    d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"/>
                                                                        </g>
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                            <a href="<?php echo url("/admin/profile/information?user_id={$AllUsers['userID']}")?>" class="btn btn-icon btn-info btn-sm  mr-2 user-des" data-toggle = "tooltip" title = "مشاهده پروفایل کاربری" data-theme = "dark">
                                                                <span class="svg-icon svg-icon-dark svg-icon-2x">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                                        </g>
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="alert alert-warning col-12 col-md-12">
                                                    <h3 class="text-center">
                                                        هیچ کاربری وجود ندارد
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
$pageTitle = "مدیریت کاربران";
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