<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    مدیریت تیکت ها
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
                                    مدیریت تیکت ها </h3>
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
                                                <th>موضوع </th>
                                                <th>کد پیگیری</th>
                                                <th>تاریخ </th>
                                                <th>وضعیت پیغام </th>
                                                <th>وضعیت</th>
                                                <th>غیر فعال | فعال</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $keyNumber = 1;
                                            $getAllTickets = getAllTickets();
                                            if ($getAllTickets) {
                                                foreach ($getAllTickets as $key => $AllTickets) {
                                                    $date = jdate("r", (dateToTimestamp($AllTickets['timeSend'])));
                                                    $date_org = $date;
                                                    ?>
                                                    <tr>
                                                        <td><?= $keyNumber++ ?></td>
                                                        <td style="min-width:100px;"><?= $AllTickets['title'] ?></td>
                                                        <td>#<?= $AllTickets['code_tickets'] ?></td>
                                                        <td style="min-width:110px;"><?= $date_org ?></td>
                                                        <td style="min-width:110px;"><?php
                                                            if ($AllTickets['last_sender'] == 1) {
                                                                ?>
                                                                <span
                                                                        class="label label-lg font-weight-bold label-light-success label-inline">پاسخ داده شده </span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span
                                                                        class="label label-lg font-weight-bold label-light-warning label-inline">درانتظار پاسخ</span>
                                                                <?php
                                                            }
                                                            ?></td>


                                                        <td id="statusShow<?= $AllTickets['id'] ?>">
                                                            <?php
                                                            if ($AllTickets['status'] == 1) {
                                                                ?>
                                                                <span
                                                                    class="label label-lg font-weight-bold label-light-success label-inline">باز</span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span
                                                                    class="label label-lg font-weight-bold label-light-warning label-inline">بسته شده </span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td id="statusTicket<?= $AllTickets['id'] ?>">
                                                            <?php
                                                            if ($AllTickets['status'] == 2) {
                                                                ?>
                                                                <span class="switch switch-icon">
                                                                    <label>
                                                                        <input id="changeStatusInput<?= $AllTickets['id'] ?>"
                                                                            onclick="statusTicket(<?= $AllTickets['id'] ?>, 1)"
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
                                                                            id="changeStatusInput<?= $AllTickets['id'] ?>"
                                                                            onclick="statusTicket(<?= $AllTickets['id'] ?>, 2)"
                                                                            type="checkbox" checked="checked" name="select">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= url("admin/tickets/ticketDetails?ticketDetails={$AllTickets["code_tickets"]}") ?>"
                                                                class="btn btn-icon btn-primary mr-2 user-des btn-sm"
                                                                data-toggle="tooltip" title="ویرایش" data-theme="dark">
                                                                <span
                                                                    class="svg-icon svg-icon-dark svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\ارتباطات\Write.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                                          <g stroke="none" stroke-width="1" fill="none"
                                                                             fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                            <path
                                                                                    d="M5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                                                    fill="#000000"/>
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
                                                        هیچ  تیکتی وجود ندارد
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
$pageTitle = "مدیریت تیکت ها";
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