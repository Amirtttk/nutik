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
                                <h3 class="card-label font-weight-bolder text-dark">اطلاعات شخصی</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">مشاهده اطلاعات کاربر</span>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form class="form">
                            <!--begin::Body-->
                            <div class="card-body">
                                <div class="row">
                                    <label class="col-xl-3"></label>
                                    <div class="col-lg-9 col-xl-6">
                                        <h5 class="font-weight-bold mt-4 mb-6">اطلاعات مخاطب</h5>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">نام و نام خانوادگی</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <div class="input-group-prepend"><span class="input-group-text"></span></div>
                                            <input type="text" class="form-control form-control-lg form-control-solid" value="<?= $getOneUser['userFullName']?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">شماره تلفن </label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                   placeholder="نام کاربری" value=<?= '09'. $getOneUser['userMobile']?>>
                                            <div class="input-group-append"><span class="input-group-text"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">جنسیت</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <div class="input-group-prepend"><span class="input-group-text"></span></div>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                   value="<?php
                                                   if ($getOneUser['gender'] == 1) {
                                                    echo 'مرد ';
                                                        } else {
                                                           echo 'زن';
                                                        }
                                            ?>" placeholder="تلفن">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </form>
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
