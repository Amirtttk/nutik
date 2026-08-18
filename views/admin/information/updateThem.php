<?php
$getInformation = getInformation();
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
                <h5 class="card-label">ویرایش اطلاعات تم سایت </h5>
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
                            <h3 class="card-label">ویرایش اطلاعات تم سایت</h3>
                        </div>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link show active" data-toggle="tab" href="#kt_tab_pane_7_1">
                                        <span class="nav-icon"><i class="fa fa-info"></i></span>
                                        ویرایش اطلاعات تم سایت
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
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-lg-4">
                                                    <label>رنگ اصلی  : </label>
                                                    <input name="color" type="color" value="<?= $getInformation['color'] ?>" class="form-control"
                                                           data-v-message="عنوان   نمیتواند خالی بماند" required
                                                           placeholder="عنوان را وارد کنید" />
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>رنگ پدر: </label>
                                                    <input name="color2" type="color" value="<?= $getInformation['color2'] ?>" class="form-control"
                                                           data-v-message="تلفن مدیریت نمیتواند خالی بماند" required
                                                           placeholder="تلفن مدیریت را وارد کنید" />
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>رنگ فرزند : </label>
                                                    <input name="color3" type="color" value="<?= $getInformation['color3'] ?>" class="form-control"
                                                           data-v-message="تلفن مدیریت نمیتواند خالی بماند" required
                                                           placeholder="تلفن مدیریت را وارد کنید" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-4">
                                                    <label>انتخاب قالب سایت:</label>
                                                    <select required name="theme" class="form-control form-control-lg form-control-solid">
                                                        <?php
                                                        $thems = $getInformation['theme'];
                                                        if($thems == 1){
                                                            ?>
                                                            <option value="1">قالب شماره 1</option>
                                                            <option value="2">قالب شماره 2</option>
                                                            <option value="3">قالب شماره 3</option>

                                                            <?php
                                                        }if($thems == 2){
                                                            ?>
                                                            <option value="2">قالب شماره 2</option>
                                                            <option value="3">قالب شماره 3</option>
                                                            <option value="1">قالب شماره 1</option>
                                                            <?php
                                                        }if($thems == 3){
                                                            ?>
                                                            <option value="3">قالب شماره 3</option>
                                                            <option value="2">قالب شماره 2</option>
                                                            <option value="1">قالب شماره 1</option>
                                                            <?php
                                                        }
                                                        ?>


                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label>انتخاب فونت سایت:</label>
                                                    <select required name="font" class="form-control form-control-lg form-control-solid">
                                                        <?php
                                                        $font = $getInformation['font'];
                                                        if($font == 1){
                                                            ?>
                                                            <option value="1">فونت یکان بخ</option>
                                                            <option value="2">فونت ایران سنس</option>
                                                            <option value="3">فونت پیدا</option>
                                                            <option value="4">فونت شبنم</option>
                                                            <option value="5">فونت وزیر</option>
                                                            <?php
                                                        }if($font == 2){
                                                            ?>
                                                            <option value="2">فونت ایران سنس</option>
                                                            <option value="1">فونت یکان بخ</option>
                                                            <option value="3">فونت پیدا</option>
                                                            <option value="4">فونت شبنم</option>
                                                            <option value="5">فونت وزیر</option>
                                                            <?php
                                                        }elseif($font == 3){
                                                            ?>
                                                            <option value="3">فونت پیدا</option>
                                                            <option value="1">فونت یکان بخ</option>
                                                            <option value="2">فونت ایران سنس</option>
                                                            <option value="4">فونت شبنم</option>
                                                            <option value="5">فونت وزیر</option>
                                                            <?php
                                                        }if($font == 4){
                                                            ?>
                                                            <option value="4">فونت شبنم</option>
                                                            <option value="1">فونت یکان بخ</option>
                                                            <option value="2">فونت ایران سنس</option>
                                                            <option value="3">فونت پیدا</option>
                                                            <option value="5">فونت وزیر</option>
                                                            <?php
                                                        }if($font == 5){
                                                            ?>
                                                            <option value="5">فونت وزیر</option>
                                                            <option value="1">فونت یکان بخ</option>
                                                            <option value="2">فونت ایران سنس</option>
                                                            <option value="3">فونت پیدا</option>
                                                            <option value="4">فونت شبنم</option>
                                                            <?php
                                                        }
                                                        ?>




                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button type="button" class="btn btn-success mr-2"
                                                            onclick="updateTheme(<?= '1' ?>)">ویرایش </button>
                                                    <a href="http://partorasaia.test/admin/information/management"
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
    </div>
</div>
<?php
$pageTitle = "ویرایش اطلاعات سایت ";
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

