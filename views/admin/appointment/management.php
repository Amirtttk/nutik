<?php
$appointments = getAllAppointments();
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="card-label">مدیریت درخواست‌های رزرو نوبت</h5>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon"><i class="flaticon2-calendar-9 text-primary"></i></span>
                        <h3 class="card-label">مدیریت درخواست‌های رزرو نوبت</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div id="getErrors"></div>
                    <table class="table table-bordered table-hover table-checkable" id="manager" style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>کد پیگیری</th>
                            <th>نام</th>
                            <th>موبایل</th>
                            <th>تاریخ نوبت</th>
                            <th>ساعت</th>
                            <th>مبلغ</th>
                            <th>پرداخت</th>
                            <th>وضعیت مدیر</th>
                            <th>رزرو نهایی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($appointments): ?>
                            <?php $row = 1; ?>
                            <?php foreach ($appointments as $appointment): ?>
                                <tr>
                                    <td><?= $row++ ?></td>
                                    <td><?= htmlspecialchars($appointment['tracking_code']) ?></td>
                                    <td><?= htmlspecialchars($appointment['full_name']) ?></td>
                                    <td><?= htmlspecialchars($appointment['mobile']) ?></td>
                                    <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                                    <td><?= htmlspecialchars(substr((string) $appointment['appointment_time'], 0, 5)) ?></td>
                                    <td><?= number_format((int) $appointment['amount']) ?> تومان</td>
                                    <td>
                                        <?php if ((int) $appointment['payment_status'] === 2): ?>
                                            <span class="label label-lg font-weight-bold label-light-success label-inline">موفق</span>
                                        <?php elseif ((int) $appointment['payment_status'] === 1): ?>
                                            <span class="label label-lg font-weight-bold label-light-danger label-inline">ناموفق</span>
                                        <?php else: ?>
                                            <span class="label label-lg font-weight-bold label-light-warning label-inline">در انتظار پرداخت</span>
                                        <?php endif; ?>
                                    </td>
                                    <td id="appointmentAdminStatus<?= (int) $appointment['id'] ?>">
                                        <?php if ((int) $appointment['admin_status'] === 1): ?>
                                            <span class="label label-lg font-weight-bold label-light-success label-inline">تایید شده</span>
                                        <?php elseif ((int) $appointment['admin_status'] === 2): ?>
                                            <span class="label label-lg font-weight-bold label-light-danger label-inline">رد شده</span>
                                        <?php elseif ((int) $appointment['admin_status'] === 3): ?>
                                            <span class="label label-lg font-weight-bold label-light-dark label-inline">لغو شده</span>
                                        <?php else: ?>
                                            <span class="label label-lg font-weight-bold label-light-warning label-inline">در انتظار بررسی</span>
                                        <?php endif; ?>
                                    </td>
                                    <td id="appointmentFinalStatus<?= (int) $appointment['id'] ?>">
                                        <?php if ((int) $appointment['payment_status'] === 2 && (int) $appointment['admin_status'] === 1): ?>
                                            <span class="label label-lg font-weight-bold label-light-success label-inline">رزرو شده</span>
                                        <?php else: ?>
                                            <span class="label label-lg font-weight-bold label-light-secondary label-inline">نهایی نشده</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="min-width: 220px">
                                        <button type="button" class="btn btn-success btn-sm mb-1" onclick="changeAppointmentStatus(<?= (int) $appointment['id'] ?>, 1)">تایید</button>
                                        <button type="button" class="btn btn-danger btn-sm mb-1" onclick="changeAppointmentStatus(<?= (int) $appointment['id'] ?>, 2)">رد</button>
                                        <button type="button" class="btn btn-warning btn-sm mb-1" onclick="changeAppointmentStatus(<?= (int) $appointment['id'] ?>, 0)">در انتظار</button>
                                        <button type="button" class="btn btn-dark btn-sm mb-1" onclick="changeAppointmentStatus(<?= (int) $appointment['id'] ?>, 3)">لغو</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>

                    <?php if (!$appointments): ?>
                        <div class="alert alert-warning mt-6">هنوز درخواست رزروی ثبت نشده است.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$pageTitle = "مدیریت درخواست‌های رزرو";
$pageScript = "
    <script src='../../../assets/admin/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/widgets.js?v=7.0.6'></script>
    <script src='../../../assets/admin/plugins/custom/datatables/datatables.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/crud/datatables/basic/paginations.js?v=7.0.6'></script>
    <script src='../../assets/admin/js/sweetalert.js'></script>
    <script src='../../assets/admin/js/main.js?v=appointment-management-1'></script>
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
    <link href='../../assets/admin/css/themes/layout/header/base/light.rtl.css' rel='stylesheet' type='text/css' />
    <link href='../../assets/admin/css/themes/layout/aside/dark.rtl.css' rel='stylesheet' type='text/css' />
";
?>
