<?php
$getOneBrand = getOneBrand(GET('id'));
?>
    <!--begin::Content-->
    <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::زیر هدر-->
        <!--begin::زیر هدر-->
        <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
            <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::اطلاعات-->
                <div class="d-flex align-items-center flex-wrap mr-2">

                    <!--begin::Page Title-->
                    <h5 class="card-label">ویرایش اطلاعات برند  </h5>

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
                                <h3 class="card-label">ویرایش برند </h3>
                            </div>
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link show active" data-toggle="tab" href="#kt_tab_pane_7_1">
                                            <span class="nav-icon"><i class="fa fa-info"></i></span>
                                            ویرایش اطلاعات  برند
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_7_2">
                                            <span class="nav-icon"><i class="fa fa-info"></i></span>
                                            ویرایش عکس برند
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="kt_tab_pane_7_1" role="tabpanel" aria-labelledby="kt_tab_pane_7_1">
                                        <form id="">
                                            <div id='getErrors'></div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-lg-4">
                                                        <label>عنوان : </label>
                                                        <input name="title" type="text" value="<?= $getOneBrand['title'] ?>" class="form-control"
                                                               data-v-message="عنوان  نمیتواند خالی بماند" required
                                                               placeholder="عنوان  را وارد کنید" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <button type="button" class="btn btn-success mr-2" onclick="updateBrand(<?php echo $_GET["id"]; ?>)">ویرایش اطلاعات</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tab_pane_7_2" role="tabpanel" aria-labelledby="kt_tab_pane_7_2">
                                        <form id="myformImageBrand">
                                            <div class="row p-3">
                                                <label class="upload-file py-3 w-100">
                                                    <i class="fa fa-4x fa-camera"></i>
                                                    <input onchange="updateImageBrand(<?php echo $_GET['id'] ?>)"
                                                           class="form-control custom-file-input"
                                                           name="image" id="inputFile" accept="png , jpg, jepg" type="file"/>
                                                    <span class="d-block mt-3" id="uploadedFileName">تصویر را انتخاب کنید.</span>
                                                </label>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <button id="buttonImage" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModal">
                                                            مشاهده فایل قبلی
                                                        </button>
                                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel1">مشاهده فایل قبلی</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="get">
                                                                            <a style="" href="" target="_blank">
                                                                                <i class="fa fa-download" style="font-size: 40px"> Download</i>                                            </a>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">فهمیدم</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

<?php
$pageTitle = "ویرایش  مقاله";
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

