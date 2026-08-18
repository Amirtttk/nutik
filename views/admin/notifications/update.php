<?php
$getOneFaq = getOneFaq(GET('id'));
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
                    <h5 class="card-label">ویرایش سوال متداول  و قوانین</h5>

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
                                <h3 class="card-label">ویرایش سوال متداول  و قوانین</h3>
                            </div>
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                    <li class="nav-item">
                                        <a class="nav-link show active" data-toggle="tab" href="#kt_tab_pane_7_1">
                                            <span class="nav-icon"><i class="fa fa-info"></i></span>
                                            ویرایش سوال متداول  و قوانین
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="kt_tab_pane_7_1" role="tabpanel" aria-labelledby="kt_tab_pane_7_1">
                                        <div id="getErrors">
                                        </div>
                                        <form id="" class="needs-validation">
                                            <div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label>عنوان سوال: </label>
                                                        <input name="title" value="<?= $getOneFaq['title'] ?>" type="text" class="form-control"
                                                               data-v-message="عنوان سوال نمیتواند خالی بماند" required
                                                               placeholder="عنوان سوال را وارد کنید" />
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>نوع سوال : </label>
                                                        <select name="type" class="form-control" data-v-message="دسته بندی محصول نمیتواند خالی بماند" required>
                                                            <?php
                                                            if ($getOneFaq['type']== 1){
                                                                ?>
                                                                <option value="1">سوال متداول</option>
                                                                <option value="2">قوانین و مقررات</option>
                                                            <?php
                                                            }else{
                                                                ?>
                                                                <option value="2">قوانین و مقررات</option>
                                                                <option value="1">سوال متداول</option>
                                                            <?php
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-10">
                                                        <label>توضیحات سوال: </label>
                                                        <input name="description" value="<?= $getOneFaq['description'] ?>" type="text" class="form-control"
                                                               data-v-message="توضیحات سوال نمیتواند خالی بماند" required
                                                               placeholder="توضیحات سوال را وارد کنید" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="button" class="btn btn-success mr-2"
                                                                onclick="updateFaq(<?= $getOneFaq['id']?>)">ویرایش</button>
                                                        <a href="/admin/faq/management"
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
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

<?php
$pageTitle = "ویرایش  سوال متداول";
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

