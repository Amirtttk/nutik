<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="card-label">ایجاد دسته بندی مقالات </h5>
                <!--end::Page Title-->
            </div>
            <!--end::اطلاعات-->
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="card-icon"><i class="flaticon2-favourite text-primary"></i></span>
                            <h3 class="card-label">ایجاد دسته بندی مقالات جدید </h3>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_7_1">
                                        <span class="nav-icon"><i class="fa fa-info"></i></span>
                                        اطلاعات دسته بندی مقالات
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_tab_pane_7_1" role="tabpanel"
                                 aria-labelledby="kt_tab_pane_7_1">
                                <div id="getErrors"></div>
                                <form id="" class="needs-validation">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>عنوان : </label>
                                                <input name="title" type="text" class="form-control"
                                                       data-v-message="عنوان  نمیتواند خالی بماند" required
                                                       placeholder="عنوان  را وارد کنید" />
                                            </div>
                                            <div class="col-lg-4">
                                                <label>تصویر : </label>
                                                <div class="row">
                                                    <label class="upload-file p-3 w-100 d-flex align-items-center" style="column-gap: 10px">
                                                        <i class="fa fa-camera"></i>
                                                        <input name="image" data-v-message="تصویر  نمیتواند خالی بماند"
                                                               class="form-control custom-file-input"
                                                               name="image" id="inputFile" accept="png , jpg, jepg, webp, gif" type="file"/>
                                                        <span class="d-block" id="uploadedFileName">تصویر را انتخاب کنید.</span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button type="button" class="btn btn-success mr-2"
                                                        onclick="createBlogCategory()">ایجاد</button>
                                                <a href="http://home.test/admin/agent/management"
                                                   class="btn btn-secondary">لغو</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
<?php
$pageTitle = "ایجاد دسته بندی مقالات ";
$pageScript = "
            <script src='../../assets/admin/js/sweetalert.js'></script>
            <script src='../../assets/admin/js/main.js'></script>
            <script src='../../assets/admin/js/jbvalidator.js'></script>
            <script src='../../assets/admin/js/pages/crud/forms/editors/summernote.js'></script>
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
                $(function () {
                    let validator = $('form.needs-validation').jbvalidator({
                        errorMessage: true,
                        successClass: true,
                    });
                })
                jalaliDatepicker.startWatch({
                    minDate: 'attr',
                    maxDate: 'attr',
                    minTime: 'attr',
                    maxTime: 'attr',
                    hideAfterChange: false,
                    autoHide: true,
                    showTodayBtn: true,
                    showEmptyBtn: true,
                    topSpace: 10,
                    bottomSpace: 30,
                    dayRendering(opt, input) {
                        return {
                            isHollyDay: opt.day == 1
                        }
                    }
                });
            </script>
";
$pageLink = "
    <link href='../../assets/admin/plugins/global/plugins.bundle.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/themes/layout/header/base/light.rtl.css' rel='stylesheet'
        type='text/css' />
    <link href='../../assets/admin/css/themes/layout/aside/dark.rtl.css' rel='stylesheet' type='text/css' />
    <link rel='stylesheet' href='../../assets/admin/css/jalalidatepicker.css'>
    <script type='text/javascript' src='../../assets/admin/js/jalalidatepicker.js'></script>
";
?>