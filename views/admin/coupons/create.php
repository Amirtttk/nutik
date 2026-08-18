<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    کد تخفیف
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
                                    افزودن کوپن تخفیف جدید
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_tab_pane_7_3" role="tabpanel">
                                    <form method="post" class="needs-validation">
                                    <div id="getErrors">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label>کد تخفیف : </label>
                                            <input name="code" type="text" class="form-control" data-v-message="عنوان  نمیتواند خالی بماند" required="" placeholder="مثلا WGTDJN2X">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>نوع تخفیف : </label>
                                            <div class="form-group row text-center mr-for-checked">
                                                <div class="col-lg-2 text-center mr-4" style="display:flex; align-items:center; height:fit-content; column-gap:4px;">
                                                    <input id="date1" checked="" name="discount_type" type="radio" class="form-control check_plan" value="percent" style="width:20px;">
                                                    <label for="date1">درصدی</label>
                                                </div>
                                                <div class="col-lg-2 text-center" style="display:flex; align-items:center; height:fit-content; column-gap:4px;">
                                                    <input id="date2" name="discount_type" type="radio"  class="form-control check_plan" value="amount" style="width:20px;">
                                                    <label for="date2">مبلغ(تومان)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label>مقدار تخفیف : </label>
                                            <input name="discount_value" type="text" class="form-control" data-v-message="عنوان  نمیتواند خالی بماند" required="" placeholder="مثلا 20">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <label>تاریخ شروع : </label>
                                            <input type="text" id="start_date" name="start_date" class="form-control pwt-datepicker-input-element" value="">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>تاریخ پایان : </label>
                                            <input type="text" id="end_date" name="end_date" class="form-control pwt-datepicker-input-element" value="">
                                        </div>
                                        <div class="col-lg-4">
                                            <label>محدودیت تعداد استفاده از کد تخفیف : </label>
                                            <input name="usage_limit" type="text" class="form-control" data-v-message="عنوان  نمیتواند خالی بماند" required="" placeholder="نامحدود (اختیاری)">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>حداقل مبلغ خرید : </label>
                                            <input name="min_purchase" type="text" class="form-control" data-v-message="عنوان  نمیتواند خالی بماند" required="" placeholder="بدون محدودیت (اختیاری)">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>قابل استفاده فقط یکبار برای هر کاربر : </label>
                                            <span class="switch switch-icon">
                                          <label>
                                              <input type="checkbox" name="once_per_user">
                                              <span></span>
                                          </label>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary mr-2" onclick="createCoupons()">ایجاد</button>
                                    <a href="" class="btn btn-secondary">لغو</a>
                                </div>
                            </div>
                        </div>
                        </form>
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
$pageTitle = "کد تخفیف";
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
    <script src='../../../assets/admin/js/persian-date.min.js'></script>
    <script src='../../../assets/admin/js/persian-datepicker.min.js'></script>
    <script>
        $(document).ready(function() {
            $('#start_date').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#start_date_alt',
                initialValueType: 'gregorian'
            });

            $('#end_date').persianDatepicker({
                format: 'YYYY/MM/DD',
                altField: '#end_date_alt',
                initialValueType: 'gregorian'
            });
        });
    </script>
";
$pageLink = "
    <link href='../../assets/admin/css/style.bundle.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/themes/layout/header/base/light.rtl.css' rel='stylesheet'
        type='text/css' />
    <link href='../../assets/admin/css/themes/layout/aside/dark.rtl.css' rel='stylesheet' type='text/css' />
    <link rel='stylesheet' href='../../assets/admin/css/themes/persian-datepicker.min.css'>
";
?>
