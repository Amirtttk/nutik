<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::زیر هدر-->
    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::اطلاعات-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    مدیریت تعرفه‌های پستی
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
                                    مدیریت تعرفه‌های پستی
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_tab_pane_7_3" role="tabpanel">
                                    <div id="getErrors"></div>
                                    <form class="row">
                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">وزن از (گرم)</label>
                                                <input type="number" name="min_weight" class="form-control form-control-sm" required="">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">تا (گرم)</label>
                                                <input type="number" name="max_weight" class="form-control form-control-sm" placeholder="∞">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">هزینه پستی</label>
                                                <input type="number" name="base_post_cost" class="form-control form-control-sm" required="">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">تعهدات</label>
                                                <input type="number" name="insurance_cost" class="form-control form-control-sm" value="5000" required="">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">مالیات</label>
                                                <input type="number" name="added_value_tax" class="form-control form-control-sm" required="">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" onclick="createForwarding()" class="btn btn-primary btn-sm w-100 mt-3">
                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                    افزودن نرخ
                                                </button>
                                            </div>

                                    </form>
                                    <table class="table table-bordered table-hover table-checkable" id="manager" style="margin-top: 5px !important">
                                        <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th>حداقل وزن	</th>
                                                <th>حداکثر وزن	</th>
                                                <th>هزینه پستی	</th>
                                                <th>تعهدات اجباری	</th>
                                                <th>مالیات	</th>
                                                <th>جمع کل		</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $keyNumber = 1;
                                            $getAllForwarding = getAllForwarding();
                                            if ($getAllForwarding) {
                                                foreach ($getAllForwarding as $key => $AllForwarding) {
                                                    ?>
                                                    <tr id="deleteForwarding<?php echo $AllForwarding['id']?>">
                                                        <td><?= $keyNumber++ ?></td>
                                                        <?php
                                                        $minWeight          = (float) $AllForwarding['min_weight'];
                                                        $maxWeight          = (float) $AllForwarding['max_weight'] ;
                                                        $basePostCost       = (float) $AllForwarding['base_post_cost'];
                                                        $insuranceCost      = (float) $AllForwarding['insurance_cost'];
                                                        $addedValueTax      = (float) $AllForwarding['added_value_tax'];

                                                        $totalPrice =  $basePostCost + $insuranceCost + $addedValueTax;
                                                        ?>

                                                        <td><?= ($minWeight) ?></td>
                                                        <td><?= $maxWeight ; ?></td>
                                                        <td><?= number_format($basePostCost) ?></td>
                                                        <td><?= number_format($insuranceCost) ?></td>
                                                        <td><?= number_format($addedValueTax) ?></td>
                                                        <td><strong><?= number_format($totalPrice) ?></strong></td>
                                                        <td>
                                                            <button type="button" onclick="deleteForwarding(<?= $AllForwarding['id'] ?>)" class="btn btn-icon btn-danger btn-sm mr-2 " data-toggle = "tooltip" title = "حذف" data-theme = "dark">
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
                                            }
                                            ?>
                                            <br>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    </div>
    <!--end::Entry-->


<!--end::Content-->
<?php
$pageTitle = "مدیریت تعرفه‌های پستی";
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