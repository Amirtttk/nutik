<?php
if (!isset($_GET['tracking_code'])) {
    abort();
}
$getOrderByTrackingCode = getOrderByTrackingCode($_GET['tracking_code']);
$getOneUserByID = getInfoUser($getOrderByTrackingCode['user_id']);
?>
<div class="card card-custom overflow-hidden">
    <div class="card-body p-0">
        <!-- begin: فاکتور-->

        <!-- begin: فاکتور body-->
        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
            <div class="col-md-9">
                <div class="table-responsive">
                    <h1>اطلاعات سرویس های خریداری شده</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="pl-0 font-weight-bold text-muted  text-uppercase">تصویر</th>
                                <th class="pl-0 font-weight-bold text-muted  text-uppercase">عنوان</th>
                                <th class="text-right font-weight-bold text-muted text-uppercase">قیمت</th>
                                <th class="text-right font-weight-bold text-muted text-uppercase">تعداد</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getOrderProductsByOrderID = getOrderProductsByOrderID($getOrderByTrackingCode['id']);
                            if ($getOrderProductsByOrderID) {
                                $totalPrice = 0;
                                foreach ($getOrderProductsByOrderID as $product) {
                                    $rawPrice = (!empty($product['discount']) && (int)$product['discount'] > 0)
                                        ? $product['discount']
                                        : $product['price'];

                                    $price = (int) str_replace([',', 'تومان', ' '], '', $rawPrice);
                                    $quantity = (int) $product['quantity'];
                                    $totalPrice += $price * $quantity;

                                    $getOneProduct = getOneProduct($product['product_id']);
                                    $mainImage = $getOneProduct['main_image'] ?? ($images[0] ?? '');
                                    $thumbnailAllProductsByLimit = !empty($mainImage) ? getProductImageUrl($mainImage) : '';
                                    ?>
                                    <tr class="font-weight-boldest font-size-lg">
                                        <td class="pl-0 pt-7">
                                            <img width="100" height="80" src="<?= $thumbnailAllProductsByLimit ? "../../" . $thumbnailAllProductsByLimit : '' ?>">
                                        </td>
                                        <td class="pl-0 pt-7"><?= $product['title'] ?></td>
                                        <td class="pl-0 pt-7"><?= show_number($product['discount']) ?></td>
                                        <td class="pl-0 pt-7"><?= $product['quantity'] ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end: فاکتور body-->

        <!-- begin: فاکتور footer-->
        <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
            <div class="col-md-9">
                <div class="d-flex justify-content-between flex-column flex-md-row font-size-lg">
                    <div class="d-flex flex-column mb-10 mb-md-0">
                        <div class="font-weight-bolder font-size-lg mb-3">مشخصات خریدار</div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="mr-15 font-weight-bold">نام و نام خانوادگی خریدار:</span>
                            <span class="text-right"><?= $getOneUserByID['userFullName'] ?></span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="mr-15 font-weight-bold">شماره تماس خریدار:</span>
                            <span class="text-right">09<?= $getOneUserByID['userMobile'] ?></span>
                        </div>
                    </div>
                    <div class="d-flex flex-column text-md-right">
                        <span class="font-size-lg font-weight-bolder mb-1">مبلغ پرداختی</span>
                        <span class="font-size-h2 font-weight-boldest text-danger mb-1"> <?= number_format($totalPrice); ?>تومان</span>
                    </div>
                    <div class="d-flex flex-column text-md-right">
                        <span class="font-size-lg font-weight-bolder mb-1">مبلغ پرداختی ارسال </span>
                        <span class="font-size-h2 font-weight-boldest text-danger mb-1"> <?= number_format($getOrderByTrackingCode['shipping_cost']); ?>تومان</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: فاکتور footer-->
        <?php
        $address = [];
        if (!empty($getOrderByTrackingCode['address'])) {
            $decoded = json_decode($getOrderByTrackingCode['address'], true);

            if (is_array($decoded) && count($decoded) > 0) {
                // اگر اولین المنت آرایه باشه → یعنی آدرس انتخابی
                if (isset($decoded[0]) && is_array($decoded[0])) {
                    $address = $decoded[0];
                } else {
                    // آدرس دستی
                    $address = $decoded;
                }
            }
        }
        ?>

        <?php if (!empty($address)) : ?>
            <table class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0 border border">
                <tbody class="col-md-9">
                <tr>
                    <td class="px-4 py-3">نام و نام خانوادگی:</td>
                    <td class="font-yekanBakhRegular">
                        <?= htmlspecialchars(($address['name'] ?? '') . ' ' . ($address['family'] ?? '')) ?>
                    </td>
                </tr>

                <tr>
                    <td class="px-4 py-3">استان / شهر:</td>
                    <td class="font-yekanBakhRegular">
                        <?php
                        $cityData = getCityAndProvinceByCityId($address['city_id'] ?? null);
                        if ($cityData) {
                            echo "شهر: " . htmlspecialchars($cityData['city_name']) . " - " .
                                "استان: " . htmlspecialchars($cityData['province_name']);
                        } else {
                            echo "شهر پیدا نشد یا خطا رخ داده.";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td class="px-4 py-3">آدرس:</td>
                    <td class="font-yekanBakhRegular">
                        <?= htmlspecialchars($address['address'] ?? '') ?>
                    </td>
                </tr>

                <tr>
                    <td class="px-4 py-3">تلفن:</td>
                    <td class="font-yekanBakhRegular">
                        <?= htmlspecialchars($address['mobile'] ?? '') ?>
                    </td>
                </tr>

                <tr>
                    <td class="px-4 py-3">کد پستی:</td>
                    <td class="font-yekanBakhRegular">
                        <?= htmlspecialchars($address['post_code'] ?? '') ?>
                    </td>
                </tr>

                <tr>
                    <td class="px-4 py-3">توضیحات اضافه:</td>
                    <td class="font-yekanBakhRegular">
                        <?= htmlspecialchars($address['description'] ?? ($address['extra_desc'] ?? '')) ?>
                    </td>
                </tr>
                </tbody>
            </table>
        <?php endif; ?>
        <!-- begin: فاکتور action-->
        <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
            <div class="col-md-9">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">چاپ
                        فاکتور</button>
                </div>
            </div>
        </div>
        <!-- end: فاکتور action-->
        <!-- end: فاکتور-->
    </div>
</div>
<?php
$pageTitle = "اطلاعات سفارش";
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