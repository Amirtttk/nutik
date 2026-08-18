<?php
$settings = getAppointmentSettings();
$workingDays = array_filter(explode(',', (string) ($settings['working_days'] ?? '0,1,2,3,4')), 'strlen');
$dayLabels = [
    0 => 'شنبه',
    1 => 'یکشنبه',
    2 => 'دوشنبه',
    3 => 'سه‌شنبه',
    4 => 'چهارشنبه',
    5 => 'پنجشنبه',
    6 => 'جمعه',
];
$startTime = substr((string) $settings['start_time'], 0, 5);
$endTime = substr((string) $settings['end_time'], 0, 5);
$previewSlots = getAppointmentSlotsFromSettings($settings);

$timeOptions = [];
for ($h = 6; $h <= 23; $h++) {
    foreach ([0, 30] as $m) {
        if ($h === 23 && $m === 30) {
            continue;
        }
        $timeOptions[] = sprintf('%02d:%02d', $h, $m);
    }
}
if (!in_array($startTime, $timeOptions, true)) {
    $timeOptions[] = $startTime;
}
if (!in_array($endTime, $timeOptions, true)) {
    $timeOptions[] = $endTime;
}
$timeOptions = array_values(array_unique($timeOptions));
sort($timeOptions);
?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2">
                <h5 class="card-label">تنظیمات رزرو نوبت مشاوره</h5>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon"><i class="flaticon2-calendar-9 text-primary"></i></span>
                        <h3 class="card-label">تنظیمات رزرو نوبت مشاوره</h3>
                    </div>
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="tab" href="#kt_tab_pane_appointment">
                                    <span class="nav-icon"><i class="fa fa-clock"></i></span>
                                    تنظیمات زمانی و ظرفیت
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_appointment" role="tabpanel">
                            <div id="getErrors"></div>
                            <div class="alert alert-light-info mb-8">
                                با تعیین ساعت شروع و پایان کار، فاصله نوبت‌ها و ظرفیت هر بازه، ساعت‌های قابل رزرو در سایت به‌صورت خودکار ساخته می‌شوند.
                            </div>
                            <form id="appointmentSettingsForm" class="needs-validation">
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label>ساعت شروع کار:</label>
                                        <select name="start_time" class="form-control" dir="ltr" required onchange="previewAppointmentSlots()">
                                            <?php foreach ($timeOptions as $time): ?>
                                                <option value="<?= htmlspecialchars($time) ?>" <?= $startTime === $time ? 'selected' : '' ?>>
                                                    <?= tr_num($time, 'fa') ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>ساعت پایان کار:</label>
                                        <select name="end_time" class="form-control" dir="ltr" required onchange="previewAppointmentSlots()">
                                            <?php foreach ($timeOptions as $time): ?>
                                                <option value="<?= htmlspecialchars($time) ?>" <?= $endTime === $time ? 'selected' : '' ?>>
                                                    <?= tr_num($time, 'fa') ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>فاصله هر نوبت (دقیقه):</label>
                                        <select name="slot_duration" class="form-control" required
                                                onchange="previewAppointmentSlots()">
                                            <?php foreach ([15, 30, 45, 60] as $duration): ?>
                                                <option value="<?= $duration ?>" <?= (int) $settings['slot_duration'] === $duration ? 'selected' : '' ?>>
                                                    <?= $duration ?> دقیقه
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>ظرفیت هر نوبت (تعداد مشتری):</label>
                                        <input name="capacity_per_slot" type="number" min="1" max="50"
                                               value="<?= (int) $settings['capacity_per_slot'] ?>"
                                               class="form-control"
                                               data-v-message="ظرفیت هر نوبت را وارد کنید" required
                                               placeholder="مثلاً ۱ یا ۲"
                                               onchange="previewAppointmentSlots()"
                                               oninput="previewAppointmentSlots()">
                                        <span class="form-text text-muted">اگر ظرفیت ۲ باشد، هر بازه به ۲ نوبت مساوی تقسیم می‌شود (مثلاً ۶۰ دقیقه → ۳۰ دقیقه‌ای).</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>هزینه مشاوره (تومان):</label>
                                        <input name="price" type="number" min="0"
                                               value="<?= (int) $settings['price'] ?>"
                                               class="form-control"
                                               data-v-message="هزینه را وارد کنید" required
                                               placeholder="۰ برای رایگان">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>وضعیت بخش رزرو:</label>
                                        <select name="status" class="form-control">
                                            <option value="1" <?= (int) $settings['status'] === 1 ? 'selected' : '' ?>>فعال</option>
                                            <option value="0" <?= (int) $settings['status'] === 0 ? 'selected' : '' ?>>غیرفعال</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label class="d-block mb-3">روزهای کاری:</label>
                                        <div class="checkbox-inline">
                                            <?php foreach ($dayLabels as $dayValue => $dayLabel): ?>
                                                <label class="checkbox checkbox-primary mr-5 mb-3">
                                                    <input type="checkbox" name="working_days[]"
                                                           value="<?= $dayValue ?>"
                                                        <?= in_array((string) $dayValue, $workingDays, true) ? 'checked' : '' ?>>
                                                    <span></span>
                                                    <?= $dayLabel ?>
                                                </label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="separator separator-dashed my-8"></div>

                                <div class="form-group">
                                    <label class="font-weight-bold">پیش‌نمایش ساعت‌های قابل رزرو:</label>
                                    <div id="appointmentSlotsPreview" class="d-flex flex-wrap mt-3">
                                        <?php if ($previewSlots): ?>
                                            <?php foreach ($previewSlots as $slot): ?>
                                                <span class="label label-lg label-light-primary label-inline m-1 px-4 py-3"><?= $slot ?></span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="text-muted">ساعت معتبری برای نمایش وجود ندارد.</span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="button" class="btn btn-success mr-2"
                                                    onclick="updateAppointmentSettings(<?= (int) $settings['id'] ?>)">ذخیره تنظیمات</button>
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
$pageTitle = "مدیریت درباره ما  ";
$pageScript = "
    <script src='../../../assets/admin/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/widgets.js?v=7.0.6'></script>
    <script src='../../../assets/admin/plugins/custom/datatables/datatables.bundle.js?v=7.0.6'></script>
    <script src='../../../assets/admin/js/pages/crud/datatables/basic/paginations.js?v=7.0.6'></script>
    <script src='../../assets/admin/js/sweetalert.js'></script>
    <script src='../../assets/admin/js/main.js?v=appointment-settings-1'></script>
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