<?php
$getOneUser = getOneUser(GET('user_id'));
?>
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    پروفایل کاربری </h5>
                <!--end::Page Title-->
                <!--begin::اقدامات-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <!--end::اقدامات-->
            </div>
            <!--end::اطلاعات-->
        </div>
    </div>
    <!--end::زیر هدر-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::پروفایل اطلاعات شخصی-->
            <div class="d-lg-flex flex-row" style="gap:10px;">
                <!--begin::Aside-->
                <div class="flex-row-auto w-xl-350px mb-5" id="kt_profile_aside">
                    <!--begin::پروفایل Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::User-->
                            <div class="d-flex align-items-center">
                                <div>
                                    <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                                      <?= $getOneUser['userFullName']?>
                                    </a>
                                </div>
                            </div>
                            <!--end::User-->
                            <!--begin::مخاطب-->
                            <div class="py-9">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="font-weight-bold mr-2">تلفن:</span>
                                    <span class="text-muted"> <?= '09'. $getOneUser['userMobile']?></span>
                                </div>
                            </div>
                            <!--end::مخاطب-->
                            <!--begin::Nav-->
                            <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                                <div class="navi-item mb-2">
                                    <a href="/admin/profile/information?user_id=<?= $_GET['user_id'] ?>" class="navi-link py-4">
                                              <span class="navi-icon mr-2">
                                                            <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/عمومی/User.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                  fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                  fill="#000000" fill-rule="nonzero"></path>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>                    </span>
                                        <span class="navi-text font-size-lg">
                                                اطلاعات شخصی
                                        </span>
                                    </a>
                                </div>
                                <div class="navi-item mb-2">
                                    <a href="/admin/profile/profileOrder?user_id=<?= $_GET['user_id'] ?>"
                                       class="navi-link py-4 ">
                                            <span class="navi-icon mr-2">
                                                <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/کد/Compiling.svg--><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                                                      fill="#000000" opacity="0.3"></path>
                                                                <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                                                      fill="#000000"></path>
                                                            </g>
                                                 </svg><!--end::Svg Icon--></span>
                                            </span>
                                        <span class="navi-text font-size-lg">
تراکنش ها
                                            </span>
                                    </a>
                                </div>
                                <div class="navi-item mb-2">
                                    <a href="/admin/profile/profileTiket?user_id=<?= $_GET['user_id'] ?>"
                                       class="navi-link py-4 ">
                                            <span class="navi-icon mr-2">
                                                <span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/کد/Compiling.svg--><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                                            <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13" rx="1.5"></rect>
                                                                            <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"></rect>
                                                                            <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                            <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6" rx="1.5"></rect>
                                                                        </g>
                                                                    </svg><!--end::Svg Icon--></span>
                                            </span>
                                        <span class="navi-text font-size-lg">
                                               تیکت ها
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <!--end::Nav-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::پروفایل Card-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">اطلاعات تیکت</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">مشاهده تیکت های کاربر</span>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
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
                                        $getAllTickets = getAllTicketsByUserId(GET('user_id'));
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
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::پروفایل اطلاعات شخصی-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<?php
$pageTitle = "پروفایل کاربر";
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
