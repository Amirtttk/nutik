
<?php
global $cn;
if (isset($_POST['parent_id'])) {
$parentId = $_POST['parent_id'];
$stmt = $cn->prepare("SELECT * FROM category WHERE parent_id = ?");
$stmt->execute([$parentId]);
$categories = $stmt->fetchAll();

if ($categories) {
echo '<option value="">انتخاب کنید</option>';
foreach ($categories as $cat) {
echo '<option value="' . $cat['id'] . '">' . $cat['title'] . '</option>';
}
} else {
echo '<option value="">زیر دسته‌ای یافت نشد.</option>';
}
}
