<?php
function getOneUserForLogin($username, $password, $tblName)
{
    global $cn;
    $sql = "select * from $tblName where userName=?";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $username);
    $result->execute();

    if ($result->rowCount() > 0) {
        $admin = $result->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }
    return false;
}
function getOneUserByPassword($password, $tblName)
{
    global $cn;
    $sql = "select * from $tblName";
    $result = $cn->query($sql);

    if ($result->rowCount() > 0) {
        $admin = $result->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }
    return false;
}
function getOneUser($userID)
{
    global $cn;
    $sql = "select * from users_info_public where userID=?";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $userID);
    $result->execute();

    if ($result->rowCount() > 0) {
        return $result->fetch();
    }
    return false;
}
function getOneUserByMobile($userMobile)
{
    global $cn;
    $sql = "select * from users_info_public where userMobile=?";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $userMobile);
    $result->execute();

    if ($result->rowCount() > 0) {
        return $result->fetch();
    }
    return false;
}
function getUserLastLogin($userID)
{
    global $cn;
    $sql = "select * from users_last_login where userID=?";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $userID);
    $result->execute();

    if ($result->rowCount() > 0) {
        return $result->fetch();
    }
    return false;
}
function getAllInfoUser($tblName)
{
    global $cn;
    $sql = "SELECT * FROM users_info_public u JOIN $tblName d ON u.userID = d.userID order by u.userID desc";
    $result = $cn->query($sql);

    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getOneInfoUser($userID, $tblName)
{
    global $cn;
    $sql = "SELECT * FROM users_info_public u JOIN $tblName d ON u.userID = d.userID WHERE u.userID = ?";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $userID);
    $result->execute();

    if ($result->rowCount() > 0) {
        return $result->fetch();
    }
    return false;
}
function getInfoUser($userID)
{
    global $cn;
    $sql = "SELECT * FROM users_info_public WHERE userID = ?";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $userID);
    $result->execute();

    if ($result->rowCount() > 0) {
        return $result->fetch();
    }
    return false;
}
function getOneBlogCategories($id){
    global $cn;
    $sql="select * from blog_categories where id=? ";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$id);
    $result->execute();
    if($result->rowCount()>0){
        return $result->fetch();
    }
    return false;
}
function getOneBlog($id){
    global $cn;
    $sql="select * from blog where id=? ";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$id);
    $result->execute();
    if($result->rowCount()>0){
        return $result->fetch();
    }
    return false;
}
function getAllCategories() {
    global $cn;
    $sql = "SELECT * FROM category ORDER BY title ASC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return [];
}
function getCategoryById($id) {
    global $cn;
    $sql = "SELECT * FROM category WHERE id = ?";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $id);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetch(); // برمی‌گردونه ردیف مربوط به دسته‌بندی
    }
    return false; // اگه دسته‌بندی پیدا نشد
}
function getOneBrand($id){
    global $cn;
    $sql="select * from brand where id=? ";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$id);
    $result->execute();
    if($result->rowCount()>0){
        return $result->fetch();
    }
    return false;
}
function getOneProduct($id){
    global $cn;
    $sql="select * from products  where id=? ";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$id);
    $result->execute();
    if($result->rowCount()>0){
        return $result->fetch();
    }
    return false;
}
function getChildCategoriesByParentId($parentId)
{
    global $cn;
    try {
        $sql = "SELECT * FROM category WHERE parent_id = :parent_id ORDER BY id DESC";
        $stmt = $cn->prepare($sql);
        $stmt->bindParam(':parent_id', $parentId, PDO::PARAM_INT); // جلوگیری از SQL Injection
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // استفاده از FETCH_ASSOC برای دریافت نتایج به عنوان آرایه‌های مرتبط
        }
        return []; // اگر هیچ زیر دسته‌ای وجود نداشت، یک آرایه خالی برگردانید
    } catch (PDOException $e) {
        // ثبت خطا یا مدیریت خطا
        error_log("Database error: " . $e->getMessage());
        return false; // در صورت بروز خطا، false برگردانید
    }
}
function getInformation()
{
    global $cn;
    $sql = "select * from information ";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetch();
    }
    return false;
}
function getAppointmentSettings()
{
    global $cn;
    try {
        $sql = "SELECT * FROM appointment_settings WHERE id = 1 LIMIT 1";
        $result = $cn->query($sql);
        if ($result && $result->rowCount() > 0) {
            return $result->fetch();
        }
    } catch (Throwable $e) {
        // جدول هنوز ساخته نشده
    }
    return [
        'id' => 1,
        'start_time' => '10:00:00',
        'end_time' => '13:00:00',
        'slot_duration' => 30,
        'capacity_per_slot' => 1,
        'price' => 0,
        'working_days' => '0,1,2,3,4',
        'status' => 1,
    ];
}
function generateAppointmentSlots($startTime, $endTime, $slotDuration)
{
    $slots = [];
    $start = strtotime($startTime);
    $end = strtotime($endTime);
    $duration = (int) $slotDuration;
    if ($start === false || $end === false || $duration <= 0 || $start >= $end) {
        return $slots;
    }
    for ($t = $start; $t < $end; $t += $duration * 60) {
        $slots[] = date('H:i', $t);
    }
    return $slots;
}
function getAppointmentSlotStepMinutes($settings)
{
    $duration = max(1, (int) ($settings['slot_duration'] ?? 30));
    $capacity = max(1, (int) ($settings['capacity_per_slot'] ?? 1));
    // اگر ظرفیت هر بازه بیشتر از ۱ باشد، همان بازه به زیربازه‌ها تقسیم می‌شود
    // مثال: بازه ۶۰ دقیقه‌ای با ظرفیت ۲ → نوبت‌های ۳۰ دقیقه‌ای
    return max(1, (int) floor($duration / $capacity));
}
function getAppointmentSlotsFromSettings($settings = null)
{
    $settings = $settings ?: getAppointmentSettings();
    return generateAppointmentSlots(
        $settings['start_time'] ?? '10:00:00',
        $settings['end_time'] ?? '13:00:00',
        getAppointmentSlotStepMinutes($settings)
    );
}
function padGregorianDateYmd($date)
{
    if (!preg_match('/^(\d{4})-(\d{1,2})-(\d{1,2})$/', trim((string) $date), $m)) {
        return '';
    }
    return sprintf('%04d-%02d-%02d', (int) $m[1], (int) $m[2], (int) $m[3]);
}
function normalizeAppointmentDate($date)
{
    $date = trim(faToEn((string) $date));
    if ($date === '') {
        return '';
    }

    $date = str_replace('.', '/', $date);
    if (preg_match('/^\d{4}-\d{1,2}-\d{1,2}$/', $date)) {
        return padGregorianDateYmd($date);
    }

    if (preg_match('/^\d{4}\/\d{1,2}\/\d{1,2}$/', $date)) {
        $parts = explode('/', $date);
        $year = (int) $parts[0];
        if ($year >= 1300 && $year <= 1600) {
            return jalaliToGregorianDate(sprintf('%04d/%02d/%02d', $year, (int) $parts[1], (int) $parts[2]));
        }
        return padGregorianDateYmd(str_replace('/', '-', $date));
    }

    return '';
}
function getAppointmentWeekdayIndex($gregorianDate)
{
    $timestamp = strtotime($gregorianDate);
    if ($timestamp === false) {
        return null;
    }
    return ((int) date('w', $timestamp) + 1) % 7;
}
function getReservedAppointmentTimes($gregorianDate)
{
    global $cn;
    try {
        $stmt = $cn->prepare("SELECT appointment_time FROM appointments WHERE appointment_date = ? AND payment_status = 2 AND admin_status = 1");
        $stmt->bindValue(1, $gregorianDate);
        $stmt->execute();
        $times = $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
        return array_values(array_unique(array_map(static function ($time) {
            return substr((string) $time, 0, 5);
        }, $times)));
    } catch (Throwable $e) {
        return [];
    }
}
function isAppointmentSlotReserved($gregorianDate, $time, $excludeId = null)
{
    global $cn;
    try {
        $sql = "SELECT id FROM appointments WHERE appointment_date = ? AND appointment_time = ? AND payment_status = 2 AND admin_status = 1";
        if ($excludeId) {
            $sql .= " AND id <> ?";
        }
        $sql .= " LIMIT 1";
        $stmt = $cn->prepare($sql);
        $stmt->bindValue(1, $gregorianDate);
        $stmt->bindValue(2, $time);
        if ($excludeId) {
            $stmt->bindValue(3, $excludeId);
        }
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } catch (Throwable $e) {
        return false;
    }
}
function getAvailableAppointmentSlotsByDate($date)
{
    $settings = getAppointmentSettings();
    if ((int) ($settings['status'] ?? 0) !== 1) {
        return [];
    }
    $normalizedDate = normalizeAppointmentDate($date);
    if ($normalizedDate === '') {
        return [];
    }
    $allSlots = getAppointmentSlotsFromSettings($settings);
    $reserved = getReservedAppointmentTimes($normalizedDate);
    $available = array_values(array_diff($allSlots, $reserved));
    return array_values(array_filter($available, static function ($slot) use ($normalizedDate) {
        return !isAppointmentSlotExpired($normalizedDate, $slot, 0);
    }));
}
function isAppointmentSlotExpired($gregorianDate, $slotTime, $leadMinutes = 0)
{
    $slotTime = substr(trim((string) $slotTime), 0, 5);
    $gregorianDate = padGregorianDateYmd($gregorianDate);
    if (!preg_match('/^\d{2}:\d{2}$/', $slotTime) || $gregorianDate === '') {
        return true;
    }

    try {
        $tz = new DateTimeZone('Asia/Tehran');
        $slotDateTime = new DateTime($gregorianDate . ' ' . $slotTime . ':00', $tz);
        $cutoffDateTime = new DateTime('now', $tz);
        if ((int) $leadMinutes > 0) {
            $cutoffDateTime->modify('+' . (int) $leadMinutes . ' minutes');
        }
        // فقط وقتی زمان نوبت شروع شده/گذشته باشد بسته می‌شود
        return $slotDateTime <= $cutoffDateTime;
    } catch (Throwable $e) {
        return true;
    }
}
function getAppointmentSlotsWithStatusByDate($date)
{
    $settings = getAppointmentSettings();
    if ((int) ($settings['status'] ?? 0) !== 1) {
        return [];
    }
    $normalizedDate = normalizeAppointmentDate($date);
    if ($normalizedDate === '') {
        return [];
    }
    $weekdayIndex = getAppointmentWeekdayIndex($normalizedDate);
    $workingDays = array_filter(explode(',', (string) ($settings['working_days'] ?? '')), 'strlen');
    if ($weekdayIndex === null || !in_array((string) $weekdayIndex, $workingDays, true)) {
        return [];
    }

    $allSlots = getAppointmentSlotsFromSettings($settings);
    $reserved = getReservedAppointmentTimes($normalizedDate);
    $result = [];
    foreach ($allSlots as $slot) {
        $result[] = [
            'time' => $slot,
            'reserved' => in_array($slot, $reserved, true),
            'expired' => isAppointmentSlotExpired($normalizedDate, $slot, 0),
        ];
    }
    return $result;
}
function getAppointmentByTrackingCode($trackingCode)
{
    global $cn;
    try {
        $stmt = $cn->prepare("SELECT * FROM appointments WHERE tracking_code = ? LIMIT 1");
        $stmt->bindValue(1, $trackingCode);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (Throwable $e) {
        return false;
    }
    return false;
}
function getAppointmentById($id)
{
    global $cn;
    try {
        $stmt = $cn->prepare("SELECT * FROM appointments WHERE id = ? LIMIT 1");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (Throwable $e) {
        return false;
    }
    return false;
}
function getAllAppointments()
{
    global $cn;
    try {
        $stmt = $cn->query("SELECT * FROM appointments ORDER BY id DESC");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (Throwable $e) {
        return false;
    }
    return false;
}
function getAllaAboutUs()
{
    global $cn;
    $sql = "select * from aboutus ";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetch();
    }
    return false;
}
function getOneAdvertising($id){
    global $cn;
    $sql="select * from advertising_banner where id=? ";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$id);
    $result->execute();
    if($result->rowCount()>0){
        return $result->fetch();
    }
    return false;
}