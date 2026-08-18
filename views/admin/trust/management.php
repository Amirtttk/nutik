<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    مدیریت اطمینان ها
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
                                    مدیریت اطمینان ها </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="/admin/trust/create"
                                   class="btn btn-primary font-weight-bolder">
                                    <span class="svg-icon svg-icon-md">
                                        <i class="la la-plus"></i>
                                    </span>
                                    افزودن  اطمینان جدید
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
                                            <th>تصویر </th>
                                            <th>عنوان </th>
                                            <th>توضیحات </th>
                                            <th>وضعیت</th>
                                            <th>غیر فعال | فعال</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $keyNumber = 1;
                                        $getAllTrust = getAllTrust();
                                        if ($getAllTrust) {
                                            foreach ($getAllTrust as $key => $item) {

                                                ?>
                                                <tr id="deleteTrust<?php echo $item['id']?>">
                                                    <td><?= $keyNumber++ ?></td>
                                                    
                                                    <td>
                                                        <img width="100" height="70" src="../../public/images/trust/<?= $item['image_name']; ?>">
                                                    </td>
                                                    <td><?= $item['title'] ?></td>
                                                    <td><?= $item['description'] ?></td>
                                                    <td style="min-width:80px;" id="statusShow<?= $item['id'] ?>">
                                                        <?php
                                                        if ($item['status'] == 1) {
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
                                                    <td id="statusTrust<?= $item['id'] ?>">
                                                        <?php
                                                        if ($item['status'] == 2) {
                                                            ?>
                                                            <span class="switch switch-icon">
                                                                    <label>
                                                                        <input id="changeStatusInput<?= $item['id'] ?>"
                                                                               onclick="statusTrust(<?= $item['id'] ?>, 1)"
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
                                                                            id="changeStatusInput<?= $item['id'] ?>"
                                                                            onclick="statusTrust(<?= $item['id'] ?>, 2)"
                                                                            type="checkbox" checked="checked" name="select">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="min-width:110px;">
                                                        <button type="button" onclick="delteTrust(<?= $item['id'] ?>)" class="btn btn-icon btn-danger btn-sm mr-2 " data-toggle = "tooltip" title = "حذف" data-theme = "dark">
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
                                                    هیچ اطمینانی وجود ندارد
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
$pageTitle = "مدیریت بنر ها ";
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
