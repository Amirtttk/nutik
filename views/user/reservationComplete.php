<?php
$trackingCode = trim((string) GET('track_id'));
$status = trim((string) GET('Status'));
$authority = trim((string) GET('Authority'));
$isFree = (int) GET('free') === 1;

$appointment = $trackingCode !== '' ? getAppointmentByTrackingCode($trackingCode) : false;
$isSuccess = false;
$messageTitle = 'وضعیت رزرو نوبت';
$messageText = 'درخواست رزرو یافت نشد.';

if ($appointment) {
    if ($isFree && (int) $appointment['amount'] === 0) {
        $isSuccess = true;
        $messageTitle = 'رزرو نوبت شما با موفقیت انجام شد';
        $messageText = 'درخواست شما ثبت شد و بعد از تایید مدیر نهایی می‌شود.';
    } elseif ((int) $appointment['payment_status'] === 2) {
        $isSuccess = true;
        $messageTitle = 'رزرو نوبت شما با موفقیت انجام شد';
        $messageText = 'پرداخت با موفقیت ثبت شد و اکنون منتظر تایید مدیر است.';
    } elseif ($status !== '' && strtoupper($status) !== 'OK') {
        updateRecordToDatabase('appointments', [
            'payment_status' => 1,
            'authority' => $authority ?: ($appointment['authority'] ?? null),
            'gateway_response' => json_encode(['status' => $status, 'authority' => $authority], JSON_UNESCAPED_UNICODE),
        ], $appointment['id'], 'id');
        $appointment = getAppointmentByTrackingCode($trackingCode) ?: $appointment;
        $messageTitle = 'پرداخت رزرو ناموفق بود';
        $messageText = 'پرداخت انجام نشد. در صورت نیاز دوباره از فرم رزرو تلاش کنید.';
    } elseif (strtoupper($status) === 'OK' || ($authority !== '' && (int) $appointment['payment_status'] !== 2)) {
        $getInformation = getInformation();
        $verifyResult = verifySandboxPayment(
            $authority ?: $appointment['authority'],
            ((int) $appointment['amount']) * 10,
            $getInformation['zarinpal']
        );

        if ($verifyResult['success']) {
            updateRecordToDatabase('appointments', [
                'payment_status' => 2,
                'authority' => $authority ?: ($appointment['authority'] ?? null),
                'ref_id' => (string) ($verifyResult['ref_id'] ?? ''),
                'gateway_response' => json_encode($verifyResult['raw'], JSON_UNESCAPED_UNICODE),
                'paid_at' => date('Y-m-d H:i:s'),
            ], $appointment['id'], 'id');
            $appointment = getAppointmentByTrackingCode($trackingCode) ?: $appointment;
            $isSuccess = true;
            $messageTitle = 'رزرو نوبت شما با موفقیت انجام شد';
            $messageText = 'پرداخت تایید شد و رزرو شما در انتظار بررسی مدیر است.';
        } else {
            updateRecordToDatabase('appointments', [
                'payment_status' => 1,
                'authority' => $authority ?: ($appointment['authority'] ?? null),
                'gateway_response' => json_encode($verifyResult['raw'] ?? ['error' => $verifyResult['error'] ?? 'verify_failed'], JSON_UNESCAPED_UNICODE),
            ], $appointment['id'], 'id');
            $appointment = getAppointmentByTrackingCode($trackingCode) ?: $appointment;
            $messageTitle = 'پرداخت رزرو تایید نشد';
            $messageText = 'پرداخت در درگاه ثبت شد اما تایید نهایی دریافت نشد.';
        }
    } elseif ((int) $appointment['payment_status'] === 1) {
        $messageTitle = 'پرداخت رزرو ناموفق بود';
        $messageText = 'پرداخت این رزرو انجام نشده است.';
    } else {
        $messageTitle = 'رزرو در انتظار پرداخت است';
        $messageText = 'وضعیت پرداخت این درخواست هنوز نهایی نشده است.';
    }
}

$jalaliDate = '';
$slotTime = '';
$amountFormatted = '۰';
$refId = '—';
$fullName = '—';
$mobile = '—';
$displayTracking = $trackingCode !== '' ? $trackingCode : '—';
$paymentMethod = 'درگاه زرین‌پال';

if ($appointment) {
    $displayTracking = (string) $appointment['tracking_code'];
    $fullName = (string) $appointment['full_name'];
    $mobile = (string) $appointment['mobile'];
    $slotTime = substr((string) $appointment['appointment_time'], 0, 5);
    $amountFormatted = number_format((int) $appointment['amount']);
    $refId = trim((string) ($appointment['ref_id'] ?? '')) !== '' ? (string) $appointment['ref_id'] : '—';
    $dateTs = strtotime((string) $appointment['appointment_date']);
    $jalaliDate = $dateTs ? jdate('Y/m/d', $dateTs, '', 'Asia/Tehran', 'en') : (string) $appointment['appointment_date'];
    if ((int) $appointment['amount'] === 0) {
        $paymentMethod = 'رایگان';
    }
}

if ($isSuccess) {
    $titleHtml = 'رزرو نوبت شما با <span class="text-primary-500">موفقیت</span> انجام شد';
    $underlineClass = 'bg-primary-500/50';
    $ctaClass = 'bg-primary-500 shadow-primary-500/50';
} elseif ($appointment) {
    $titleHtml = 'پرداخت رزرو <span class="text-red-600">ناموفق</span> بود';
    $underlineClass = 'bg-red-500/50';
    $ctaClass = 'bg-red-600 shadow-red-500/50';
} else {
    $titleHtml = htmlspecialchars($messageTitle);
    $underlineClass = 'bg-zinc-300';
    $ctaClass = 'bg-primary-500 shadow-primary-500/50';
}
?>
<main class="my-4 xl:my-10 lg:mx-10">
  <div class="mx-2 lg:mx-10 border border-zinc-200 rounded-2xl px-2 py-2 lg:px-4 lg:py-4 mt-10 bg-white shadow-custom">
    <img class="mx-auto max-w-20 md:max-w-28" src="./../../assets/user/image/heart.png" alt="">
    <div class="relative flex justify-center items-center text-zinc-700 mb-5">
      <div class="z-10 font-yekanBakhExtraBold text-xl lg:text-3xl text-center px-2">
        <?= $titleHtml ?>
      </div>
      <div class="w-20 md:w-28 h-2 <?= $underlineClass ?> shadow-lg absolute bottom-2"></div>
    </div>

    <p class="text-center text-zinc-600 text-sm md:text-base font-yekanBakhRegular leading-7 mb-2 px-3">
      <?= htmlspecialchars($messageText) ?>
    </p>

    <?php if ($appointment): ?>
    <div class="px-2 sm:px-6 py-3 rounded-xl shadow-box-sm mx-auto mb-5 mt-8 max-w-md">
      <div class="flex gap-x-1 justify-center items-center text-zinc-700 text-sm md:text-base">
        <svg class="fill-zinc-500" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm-4,48a12,12,0,1,1-12,12A12,12,0,0,1,124,72Zm12,112a16,16,0,0,1-16-16V128a8,8,0,0,1,0-16,16,16,0,0,1,16,16v40a8,8,0,0,1,0,16Z"></path></svg>
        اطلاعات رزرو
      </div>

      <div class="flex gap-x-1 justify-between items-center mt-6 text-xs md:text-sm">
        <div class="text-zinc-800 font-yekanBakhSemiBold">کد پیگیری:</div>
        <div class="text-zinc-800 font-yekanBakhSemiBold"><?= htmlspecialchars($displayTracking) ?></div>
      </div>

      <div class="flex gap-x-1 justify-between items-center mt-6 text-xs md:text-sm">
        <div class="text-zinc-800 font-yekanBakhSemiBold">نام و نام خانوادگی:</div>
        <div class="text-zinc-800 font-yekanBakhSemiBold"><?= htmlspecialchars($fullName) ?></div>
      </div>

      <div class="flex gap-x-1 justify-between items-center mt-6 text-xs md:text-sm">
        <div class="text-zinc-800 font-yekanBakhSemiBold">شماره تماس:</div>
        <div class="text-zinc-800 font-yekanBakhSemiBold" dir="ltr"><?= htmlspecialchars($mobile) ?></div>
      </div>

      <div class="flex gap-x-1 justify-between items-center mt-6 text-xs md:text-sm">
        <div class="text-zinc-800 font-yekanBakhSemiBold">تاریخ نوبت:</div>
        <div class="text-zinc-800 font-yekanBakhSemiBold"><?= htmlspecialchars($jalaliDate) ?></div>
      </div>

      <div class="flex gap-x-1 justify-between items-center mt-6 text-xs md:text-sm">
        <div class="text-zinc-800 font-yekanBakhSemiBold">ساعت نوبت:</div>
        <div class="text-zinc-800 font-yekanBakhSemiBold" dir="ltr"><?= htmlspecialchars($slotTime) ?></div>
      </div>

      <div class="flex gap-x-1 justify-between items-center mt-6 text-xs md:text-sm">
        <div class="text-zinc-800 font-yekanBakhSemiBold">مبلغ:</div>
        <div class="flex gap-x-1 text-zinc-800 font-yekanBakhSemiBold">
          <div><?= htmlspecialchars($amountFormatted) ?></div>
          <div>تومان</div>
        </div>
      </div>

      <div class="flex gap-x-1 justify-between items-center mt-6 text-xs md:text-sm">
        <div class="text-zinc-800 font-yekanBakhSemiBold">کد پیگیری درگاه:</div>
        <div class="text-zinc-800 font-yekanBakhSemiBold" dir="ltr"><?= htmlspecialchars($refId) ?></div>
      </div>

      <div class="flex gap-x-1 justify-between items-center mt-6 text-xs md:text-sm">
        <div class="text-zinc-800 font-yekanBakhSemiBold">روش پرداخت:</div>
        <div class="text-zinc-800 font-yekanBakhSemiBold"><?= htmlspecialchars($paymentMethod) ?></div>
      </div>

      <div class="flex gap-x-1 justify-between items-center mt-6 text-xs md:text-sm">
        <div class="text-zinc-800 font-yekanBakhSemiBold">وضعیت:</div>
        <div class="font-yekanBakhSemiBold <?= $isSuccess ? 'text-primary-500' : 'text-red-600' ?>">
          <?= $isSuccess ? 'پرداخت موفق / در انتظار تایید مدیر' : 'پرداخت ناموفق' ?>
        </div>
      </div>

      <a href="<?= url('/#reservation') ?>" class="block <?= $ctaClass ?> rounded-xl xl:rounded-2xl hover:opacity-85 text-white text-center mt-10 px-5 md:px-2.5 py-3 md:py-4 shadow-lg transition-all font-PeydaSemiBold xl:font-PeydaBold text-s sm:text-base">
        <?= $isSuccess ? 'بازگشت به صفحه اصلی' : 'تلاش مجدد برای رزرو' ?>
      </a>
    </div>
    <?php else: ?>
    <div class="max-w-md mx-auto text-center mt-8 mb-6 px-4">
      <a href="<?= url('/#reservation') ?>" class="inline-block bg-primary-500 rounded-xl xl:rounded-2xl hover:opacity-85 text-white text-center px-8 py-3 md:py-4 shadow-lg shadow-primary-500/50 transition-all font-PeydaSemiBold text-s sm:text-base">
        بازگشت به فرم رزرو
      </a>
    </div>
    <?php endif; ?>
  </div>
</main>
