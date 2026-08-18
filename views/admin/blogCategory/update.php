<?php
$getOneBlogCategories = getOneBlogCategories(GET('id'));
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="card-label">ویرایش اطلاعات دسته‌بندی مقاله</h5>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon"><i class="flaticon2-favourite text-primary"></i></span>
                        <h3 class="card-label">ویرایش دسته‌بندی مقاله</h3>
                    </div>
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_7_1">
                                    <span class="nav-icon"><i class="fa fa-info"></i></span>
                                    ویرایش اطلاعات
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_7_2">
                                    <span class="nav-icon"><i class="fa fa-image"></i></span>
                                    ویرایش عکس
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_7_1">
                            <form>
                                <div id='getErrors'></div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>عنوان دسته‌بندی:</label>
                                            <input name="title" type="text" value="<?= $getOneBlogCategories['title'] ?>" class="form-control" placeholder="عنوان دسته‌بندی را وارد کنید" />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-success" onclick="updateCategory(<?= $_GET['id'] ?>)">ویرایش اطلاعات</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_7_2">
                            <form id="categoryImageForm">
                                <div class="row p-3">
                                    <label class="upload-file py-3 w-100">
                                        <i class="fa fa-4x fa-camera"></i>
                                        <input onchange="updateImageCategoryBlog(<?= $_GET['id'] ?>)" class="form-control custom-file-input" name="image" id="inputFile" accept="png,jpg,jpeg" type="file" />
                                        <span class="d-block mt-3" id="uploadedFileName">تصویر را انتخاب کنید.</span>
                                    </label>
                                </div>
                                <div class="card-footer">
                                    <button id="buttonImage" type="button" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModal">
                                        مشاهده تصویر قبلی
                                    </button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">مشاهده تصویر قبلی</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">فهمیدم</button>
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
<?php
$pageTitle = "ویرایش  دسته بندی مقالات  ";
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
