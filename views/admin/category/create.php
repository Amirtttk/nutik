<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="card-label">ایجاد دسته بندی </h5>
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
                            <h3 class="card-label">ایجاد دسته بندی جدید </h3>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_7_1">
                                        <span class="nav-icon"><i class="fa fa-info"></i></span>
                                        اطلاعات دسته بندی
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
                                <form id="createCategoryForm" class="needs-validation">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>عنوان دسته:</label>
                                                <input name="title" type="text" class="form-control" required placeholder="عنوان دسته را وارد کنید" />
                                            </div>
                                            <div class="col-lg-4">
                                                <label>عنوان انگلیسی:</label>
                                                <input name="english_title" type="text" class="form-control" required placeholder="عنوان انگلیسی را وارد کنید" />
                                            </div>
                                            <div class="col-lg-4">
                                                <label>دسته والد:</label>
                                                <select name="parent_id" class="form-control">
                                                    <option value="">-- انتخاب دسته والد --</option>
                                                    <?php
                                                    $categories = getAllCategories();
                                                    foreach ($categories as $category): ?>
                                                        <?php if (isset($currentCategoryId) && $category['id'] == $currentCategoryId) continue; ?>
                                                        <option value="<?= $category['id'] ?>"
                                                            <?= (isset($currentParentId) && $currentParentId == $category['id']) ? 'selected' : '' ?>>
                                                            <?= $category['title'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4" id="imageField">
                                                <label>تصویر دسته:</label>
                                                <label class="upload-file p-3 w-100 d-flex align-items-center">
                                                    <i class="fa fa-camera"></i>
                                                    <input name="image" class="form-control custom-file-input" type="file" accept="image/*" />
                                                    <span class="d-block">تصویر را انتخاب کنید</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="button" class="btn btn-success" onclick="createCategory()">ایجاد دسته</button>
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
$pageTitle = "ایجاد  دسته بندی جدید ";
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