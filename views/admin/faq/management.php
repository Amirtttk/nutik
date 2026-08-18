<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    مدیریت سوالات متداول
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
                                    مدیریت سوالات متداول
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="/admin/faq/create"
                                    class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="la la-plus"></i>
                                    </span>
                                    افزودن سوالات متداول جدید
                                </a>
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
                                                <th>عنوان</th>
                                                <th>توضیحات</th>
                                                <th>نوع</th>
                                                <th>وضعیت</th>
                                                <th>غیر فعال | فعال</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $keyNumber = 1;
                                            $getAllFaq = getAllFaq();
                                            if ($getAllFaq) {
                                                foreach ($getAllFaq as $key => $AllFaq) {
                                                    ?>
                                                    <tr id="deleteFaq<?php echo $AllFaq['id']?>">
                                                        <td><?= $keyNumber++ ?></td>
                                                        <td style="min-width:150px;"><?= $AllFaq['title'] ?></td>
                                                        <td style="min-width:200px;"><?= $AllFaq['description'] ?></td>
                                                        <td>
                                                            <?php
                                                            if ($AllFaq['type'] == 1) {
                                                                ?>
                                                                <span
                                                                        class="label label-lg font-weight-bold label-light-success label-inline">سوال متداول</span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span
                                                                        class="label label-lg font-weight-bold label-light-warning label-inline">قوانین و مقررات</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td id="statusShow<?= $AllFaq['id'] ?>">
                                                            <?php
                                                            if ($AllFaq['status'] == 1) {
                                                                ?>
                                                                <span
                                                                    class="label label-lg font-weight-bold label-light-success label-inline">فعال</span>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <span
                                                                    class="label label-lg font-weight-bold label-light-warning label-inline">غیر
                                                                    فعال</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td id="statusFaq<?= $AllFaq['id'] ?>">
                                                            <?php
                                                            if ($AllFaq['status'] == 2) {
                                                                ?>
                                                                <span class="switch switch-icon">
                                                                    <label>
                                                                        <input id="changeStatusInput<?= $AllFaq['id'] ?>"
                                                                            onclick="statusFaq(<?= $AllFaq['id'] ?>, 1)"
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
                                                                            id="changeStatusInput<?= $AllFaq['id'] ?>"
                                                                            onclick="statusFaq(<?= $AllFaq['id'] ?>, 2)"
                                                                            type="checkbox" checked="checked" name="select">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= url("/admin/faq/update?id={$AllFaq['id']}") ?>"
                                                                class="btn btn-icon btn-primary mr-2 user-des btn-sm"
                                                                data-toggle="tooltip" title="ویرایش" data-theme="dark">
                                                                <span
                                                                    class="svg-icon svg-icon-dark svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\ارتباطات\Write.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none"
                                                                            fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <path
                                                                                d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                                fill="#000000" fill-rule="nonzero"
                                                                                transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) " />
                                                                            <path
                                                                                d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                                fill="#000000" fill-rule="nonzero"
                                                                                opacity="0.3" />
                                                                        </g>
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                            <button type="button" onclick="delteFaq(<?= $AllFaq['id'] ?>)" class="btn btn-icon btn-danger btn-sm mr-2 " data-toggle = "tooltip" title = "حذف" data-theme = "dark">
                                                            <span class="svg-icon svg-icon-dark svg-icon-2x">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"/>
                                                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                                        </g>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="alert alert-warning col-12 col-md-12">
                                                    <h3 class="text-center">
                                                        هیچ سوال متداولی وجود ندارد
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
$pageTitle = "مدیریت سوالات متداول ";
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