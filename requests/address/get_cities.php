<?php
if (isset($_GET['province_id'])) {
    global $cn;
    $province_id = intval($_GET['province_id']);
    $sql = "SELECT id, name FROM city WHERE province_id = :province_id ORDER BY name ASC";
    $stmt = $cn->prepare($sql);
    $stmt->bindParam(':province_id', $province_id, PDO::PARAM_INT);
    $stmt->execute();
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($cities);
}
?>
