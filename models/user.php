<?php
function getAllFaq($type)
{
    global $cn;
    $sql = "select * from faq where status = 1 AND type=?";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$type);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function selectMobileContactUs($id){
    try {
        global $cn;
        $sql="select * from contactus where mobile = ? order by id DESC ";
        $result = $cn->prepare($sql);
        $result->bindParam(1, $id);
        $result->execute();
        if($result->rowCount()>0){
            return $result->fetch();
        }
    }catch (PDOException $e){
        return false;
    }
}
function checkLoginAttempts($ip, $time, $type = 'sms')
{
    try {
        global $cn;
        $sql = "SELECT * FROM request_login WHERE userIp = ? AND time >= ? AND type = ?";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $ip);
        $result->bindValue(2, $time - 600);
        $result->bindValue(3, $type);
        $result->execute();
        if ($result->rowCount() > 0) {
            return count($result->fetchAll());
        }
    } catch (\Throwable $e) {
        return false;
    }
}
function getUserByMobile($mobile)
{
    try {
        global $cn;
        $sql = "select * from users_info_public where userMobile = ? and userAccLvl = 4";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $mobile);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetch();
        }
    } catch (\Throwable $e) {
        return false;
    }
}
function selectAdressByUserId($id){
    try {
        global $cn;
        $sql="select * from address where userID = ? order by id DESC ";
        $result = $cn->prepare($sql);
        $result->bindParam(1, $id);
        $result->execute();
        if($result->rowCount()>0){
            return $result->fetchAll();
        }
    }catch (PDOException $e){
        return false;
    }
}
function getAllProvinces() {
    global $cn;  // کانکشن دیتابیس
    $sql = "SELECT * FROM province ORDER BY name ASC";
    $result = $cn->prepare($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
}
function DeletedAddress($id){
    global $cn;
    $sql="delete from address where id = ?";
    $resulte = $cn->prepare($sql);
    $resulte->bindValue(1,$id);
    $resulte->execute();
    if ($resulte->rowCount() > 0){
        return true;
    }
    return false;
}
function getAllBlogCategories(){
    global $cn;
    $sql = "SELECT * FROM blog_categories where status = 1 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllBlog()
{
    global $cn;
    $sql = "select * from blog where status = 1 ORDER BY id DESC LIMIT 10  ";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllBlogByCount()
{
    global $cn;
    $sql = "select * from blog where status = 1 ORDER BY id DESC  ";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function selectProductInCareqoryId($id)
{
    global $cn;
    $sql = "select * from blog where blog_categories_id =? and status = 1 ORDER BY id DESC";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$id);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function selectProductInCareqoryIdIsNull()
{
    global $cn;
    $sql = "select * from blog where status = 1 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllBlogTop()
{
    global $cn;
    $sql = "select * from blog where status = 1 ORDER BY id LIMIT 12  ";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getOneBlogForSlug($slug,$id)
{
    try {
        global $cn;
        $sql = "select * from blog where slug = ? AND id=?";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $slug);
        $result->bindValue(2, $id);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetch();
        }
    } catch (PDOException $e) {
        return false;
    }
}
function getRelatedBlog($categories_id,$id){
    global $cn;
    $sql="select * from blog where blog_categories_id = ? and status = 1 and id != ?";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$categories_id);
    $result->bindValue(2,$id);
    $result->execute();
    if($result->rowCount()>0){
        return $result->fetchAll();
    }
    return false;
}
function getAllBanner($type)
{
    global $cn;
    $sql = "SELECT * FROM `banner` WHERE status = 1 AND type = ? ORDER by id DESC ";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$type);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllBaneerProduct()
{
    global $cn;
    $sql = "SELECT * FROM `advertising_banner` WHERE status = 1 ORDER by id DESC ";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllCategory() {
    global $cn;
    $sql = "SELECT * FROM category WHERE status = 1 AND (parent_id IS NULL OR parent_id = 0) ORDER BY sort ASC "; // فرض بر این است که نام جدول "categories" است
    $stmt = $cn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}
function getAllCategoryByLimit() {
    global $cn;
    $sql = "SELECT * FROM category WHERE status = 1 AND (parent_id IS NULL OR parent_id = 0) ORDER BY sort ASC LIMIT 5"; // فرض بر این است که نام جدول "categories" است
    $stmt = $cn->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}
function getSubcategories($parentId) {
    global $cn;
    $sql = "SELECT * FROM category WHERE parent_id = :parentId AND status = 1 ORDER BY id ASC";
    $stmt = $cn->prepare($sql);
    $stmt->execute(['parentId' => $parentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAllBrand()
{
    global $cn;
    $sql = "select * from brand where status = 1 ORDER BY id DESC ";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getLatestProducts($limit = 10) {
    global $cn;
    $sql = "SELECT * FROM products WHERE status = 1 AND special = 2 ORDER BY created_at DESC LIMIT :limit";
    $stmt = $cn->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getLatestProductsSpecial($limit = 10) {
    global $cn;
    $sql = "SELECT * FROM products WHERE status = 1 AND special = '1' ORDER BY created_at DESC LIMIT :limit";
    $stmt = $cn->prepare($sql);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAllLink()
{
    global $cn;
    $sql = "select * from link where status = 1 ORDER BY id DESC ";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getOneProductBySlug($id,$slug){
    global $cn;
    $sql="select * from products where id=? and slug = ? ";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$id);
    $result->bindValue(2,$slug);
    $result->execute();
    if($result->rowCount()>0){
        return $result->fetch();
    }
    return false;
}
function checkInProductFavourites($id)
{
    global $cn;
    $sql = "select * from favourtes where product_id = ? and user_id = ?";
    $resulte = $cn->prepare($sql);
    $resulte->bindValue(1, $id);
    $resulte->bindValue(2, $_SESSION['user_sending']);
    $resulte->execute();
    if ($resulte->rowCount() > 0) {
        return $resulte->fetch();
    }
    return false;
}
function removeFromFavourits($id)
{
    global $cn;
    $sql = "DELETE FROM `favourtes` WHERE id = ?";
    $resulte = $cn->prepare($sql);
    $resulte->bindValue(1, $id);
    $resulte->execute();
    if ($resulte->rowCount() > 0) {
        return $resulte->fetch();
    }
    return false;
}
function selectInProductFavouritesCount()
{
    global $cn;
    $sql = "select * from favourtes where user_id = ?";
    $resulte = $cn->prepare($sql);
    $resulte->bindValue(1, $_SESSION['user_sending']);
    $resulte->execute();
    if ($resulte->rowCount() > 0) {
        return $resulte->fetchAll();
    }
    return false;
}
function selectInProductFavourites()
{
    global $cn;
    $sql = "select * from favourtes where user_id = ?";
    $resulte = $cn->prepare($sql);
    $resulte->bindValue(1, $_SESSION['user_sending']);
    $resulte->execute();
    if ($resulte->rowCount() > 0) {
        return $resulte->fetchAll();
    }
    return false;
}
function getTickets($userID)
{
    global $cn;
    $sql = "SELECT t.*, 
                   COALESCE(ct.sender, 0) AS last_sender, 
                   COALESCE(ct.timeSend, '1970-01-01 00:00:00') AS last_message_time
            FROM tickets t
            LEFT JOIN (
                SELECT c1.ticketId, c1.sender, c1.timeSend
                FROM chat_tickets c1
                WHERE c1.id = (SELECT MAX(c2.id) FROM chat_tickets c2 WHERE c2.ticketId = c1.ticketId)
            ) ct ON t.id = ct.ticketId
            WHERE t.userID = ?
            ORDER BY (t.status = 1) DESC, (ct.sender = 1) DESC, ct.timeSend DESC";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $userID);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getTicketsCode($ticketCode)
{
    global $cn;
    $sql = "select * from tickets where code_tickets=?";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $ticketCode);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetch();
    }
    return false;
}
function getChatTickets($ticketId)
{
    global $cn;
    $sql = "select * from chat_tickets where ticketId=? ORDER BY ticketId DESC ";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $ticketId);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getChatTicketsById($ticketId)
{
    global $cn;
    $sql = "select * from chat_tickets where id=? AND sender = 2 ORDER BY id DESC ";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $ticketId);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetch();
    }
    return false;
}
function getFullCategoryPath($childId)
{
    global $cn;
    if (empty($childId)) {
        return null;
    }

    // --- مرحله ۱: دریافت دسته فرزند ---
    $stmt = $cn->prepare("SELECT * FROM category WHERE id = ?");
    $stmt->execute([$childId]);
    $child = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$child) {
        return null;
    }

    $result = [
        'main'   => null,
        'parent' => null,
        'child'  => $child,
    ];

    if (!empty($child['parent_id'])) {
        $stmt = $cn->prepare("SELECT * FROM category WHERE id = ?");
        $stmt->execute([$child['parent_id']]);
        $parent = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($parent) {
            $result['parent'] = $parent;

            if (!empty($parent['parent_id'])) {
                $stmt = $cn->prepare("SELECT * FROM category WHERE id = ?");
                $stmt->execute([$parent['parent_id']]);
                $main = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($main) {
                    $result['main'] = $main;
                }
            }
        }
    }

    return $result;
}
function getOneRecordFromCart($user_id, $product_id)
{
    try {
        global $cn;
        $sql = "select * from cart where user_id = ? and product_id = ?";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $user_id);
        $result->bindValue(2, $product_id);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetch();
        }
    } catch (PDOException $e) {
        return false;
    }
}
function getOneRecordFromCart2($user_id, $product_id, $variant_id)
{
    try {
        global $cn;

        $sql = "SELECT * 
                FROM cart 
                WHERE user_id = ?
                  AND product_id = ?
                  AND variant_id = ?
                LIMIT 1";

        $result = $cn->prepare($sql);
        $result->bindValue(1, $user_id, PDO::PARAM_INT);
        $result->bindValue(2, $product_id, PDO::PARAM_INT);
        $result->bindValue(3, (string)$variant_id, PDO::PARAM_STR); // ✅ خیلی مهم
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    } catch (PDOException $e) {
        return false;
    }
}
function getUserRecordFromCart($user_id)
{
    try {
        global $cn;
        $sql = "select * from cart where user_id = ?";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $user_id);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
    } catch (PDOException $e) {
        return false;
    }
}
function deleteItemFromCart($id)
{
    try {
        global $cn;
        $sql = "delete from cart where id = ?";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $id);
        $result->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
function findCartItem($user_id, $product_id)
{
    try {
        global $cn;
        $sql = "select * from cart where user_id = ? AND product_id = ?";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $user_id);
        $result->bindValue(2, $product_id);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetch();
        }
    } catch (PDOException $e) {
        return false;
    }
}
function getCouponByCode(string $code)
{
    global $cn; // اتصال PDO

    $sql = "SELECT * FROM coupon WHERE code = :code LIMIT 1";
    $stmt = $cn->prepare($sql);
    $stmt->execute([
        ':code' => $code
    ]);

    $coupon = $stmt->fetch(PDO::FETCH_ASSOC);

    return $coupon ?: false;
}
function selectAdressById($id ,$userID){
    try {
        global $cn;
        $sql="select * from address where id = ? and userID = ? order by id DESC ";
        $result = $cn->prepare($sql);
        $result->bindParam(1, $id);
        $result->bindParam(2, $userID);
        $result->execute();
        if($result->rowCount()>0){
            return $result->fetchAll();
        }
    }catch (PDOException $e){
        return false;
    }
}
function deleteCartUser($user_id)
{
    try {
        global $cn;
        $sql = "delete from cart where user_id = ?";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $user_id);
        $result->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
function getOrderByTrackingCode($tracking_code)
{
    try {
        global $cn;
        $sql = "select * from orders where tracking_code = ?";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $tracking_code);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetch();
        }
    } catch (PDOException $e) {
        return false;
    }
}
function getOrderProductsByOrderID($order_id)
{
    try {
        global $cn;
        $sql = "select * from order_product where order_id = ? order by id";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $order_id);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
    } catch (PDOException $e) {
        return false;
    }
}
function getOrdersUser($user_id, $limit = false)
{
    try {
        global $cn;
        $sql = "select * from orders where user_id = ? order by id desc";
        if ($limit) {
            $sql .= " limit " . $limit;
        }
        $result = $cn->prepare($sql);
        $result->bindValue(1, $user_id);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
    } catch (PDOException $e) {
        return false;
    }
}
function getBestSellingProducts($limit = 10)
{
    try {
        global $cn;

        $sql = "
            SELECT 
                op.product_id,
                SUM(op.quantity) AS total_sold
            FROM order_product op
            INNER JOIN orders o ON o.id = op.order_id
            WHERE o.status = 10
            GROUP BY op.product_id
            ORDER BY total_sold DESC
            LIMIT :limit
        ";

        $stmt = $cn->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        $products = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = getOneProduct($row['product_id']);

            if (!$product) {
                continue;
            }

            $product['total_sold'] = (int)$row['total_sold'];
            $products[] = $product;
        }

        return $products;

    } catch (PDOException $e) {
        error_log($e->getMessage());
        return [];
    }
}
function getCouponUsageCount($couponId) {
    global $cn;
    try {
        $sql = "SELECT COUNT(*) as count FROM coupon_usage WHERE coupon_id = ?";
        $stmt = $cn->prepare($sql);
        $stmt->execute([$couponId]);
        if ($stmt->rowCount() > 0) {
            return (int)$stmt->fetchColumn();
        }
        return 0;
    } catch (PDOException $e) {
        return 0;
    }
}
function hasUserUsedCoupon($userId, $couponId) {
    global $cn;
    try {
        $sql = "SELECT id FROM coupon_usage WHERE user_id = ? AND coupon_id = ? LIMIT 1";
        $stmt = $cn->prepare($sql);
        $stmt->execute([$userId, $couponId]);
        return ($stmt->rowCount() > 0);
    } catch (PDOException $e) {
        return false;
    }
}
function getCommentProducts($product_id)
{
    try {
        global $cn;
        $sql = "select * from comments where productID = ? AND status = 1";
        $result = $cn->prepare($sql);
        $result->bindValue(1, $product_id);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
    } catch (\Throwable $e) {
        return false;
    }
}
function selectMobileComments($id){
    try {
        global $cn;
        $sql="select * from comments where userID = ? order by id DESC ";
        $result = $cn->prepare($sql);
        $result->bindParam(1, $id);
        $result->execute();
        if($result->rowCount()>0){
            return $result->fetch();
        }
    }catch (PDOException $e){
        return false;
    }
}
function searchProducts($keyword = '', $category = 0, $brand = 0, $limit = 20, $offset = 0) {
    global $cn;

    // اطمینان از اینکه limit و offset عددی هستند
    $limit  = (int)$limit;
    $offset = (int)$offset;

    $sql = "SELECT * FROM products WHERE status = 1";
    $params = [];

    if (!empty($keyword)) {
        $sql .= " AND title LIKE ?";
        $params[] = "%$keyword%";
    }

    if ($category > 0) {
        $categoryIds = getCategoryIdsIncludingDescendants($category);
        if (!empty($categoryIds)) {
            $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
            $sql .= " AND category_id IN ($placeholders)";
            foreach ($categoryIds as $id) {
                $params[] = $id;
            }
        }
    }

    if ($brand > 0) {
        $sql .= " AND brand_id = ?";
        $params[] = $brand;
    }

    // اینجا باید اعداد مستقیم داخل query گذاشته بشن
    $sql .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";

    $stmt = $cn->prepare($sql);
    $stmt->execute($params);

    return $stmt->rowCount() > 0 ? $stmt->fetchAll(PDO::FETCH_ASSOC) : false;
}
function countSearchProducts($keyword = '', $category = 0, $brand = 0) {
    global $cn;
    $sql = "SELECT COUNT(*) as total FROM products WHERE status = 1";
    $params = [];

    // شرط جستجو
    if (!empty($keyword)) {
        $sql .= " AND title LIKE ?";
        $params[] = "%$keyword%";
    }

    // شرط دسته (خود دسته + همه زیردسته‌ها)
    if ($category > 0) {
        $categoryIds = getCategoryIdsIncludingDescendants($category);
        if (!empty($categoryIds)) {
            $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
            $sql .= " AND category_id IN ($placeholders)";
            foreach ($categoryIds as $id) {
                $params[] = $id;
            }
        }
    }

    // شرط برند
    if ($brand > 0) {
        $sql .= " AND brand_id = ?";
        $params[] = $brand;
    }

    $stmt = $cn->prepare($sql);
    $stmt->execute($params);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ? (int)$row['total'] : 0;
}
function getActiveMainCategoriesWithProductCount()
{
    global $cn;
    $sql = "
        SELECT 
            c.id, 
            c.title, 
        
            (
                SELECT COUNT(*) 
                FROM products p 
                WHERE p.category_id = c.id
            ) AS product_count
        FROM category c
        WHERE c.status = 1
          AND (c.parent_id = 0 OR c.parent_id IS NULL)
    ";
    $stmt = $cn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getChildCategories($parentId)
{
    global $cn;
    $sql = "
        SELECT 
            c.*,
            (
                SELECT COUNT(*) 
                FROM products p 
                WHERE p.category_id = c.id
            ) AS product_count
        FROM category c
        WHERE c.parent_id = ?
          AND c.status = 1
    ";
    $stmt = $cn->prepare($sql);
    $stmt->bindValue(1, $parentId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getCategoryIdsIncludingDescendants($categoryId)
{
    $ids = [(int) $categoryId];
    $children = getChildCategories($categoryId);
    if (!$children) {
        return $ids;
    }
    foreach ($children as $child) {
        $ids[] = (int) $child['id'];
        $grandchildren = getChildCategories($child['id']);
        if ($grandchildren) {
            foreach ($grandchildren as $sub) {
                $ids[] = (int) $sub['id'];
            }
        }
    }
    return array_unique($ids);
}
function getAllBrandsWithProductCount()
{
    global $cn;
    $sql = "
        SELECT 
            b.id, 
            b.title, 
            (
                SELECT COUNT(*) 
                FROM products p 
                WHERE p.brand_id = b.id
            ) AS product_count
        FROM brand b
        WHERE b.status = 1
        ORDER BY b.id DESC
    ";
    $result = $cn->prepare($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
}
function selectProductsByCateqory($id,$proId){
    try {
        global $cn;
        $sql="select * from products where category_id = ? AND id != ? LIMIT 20 ";
        $result = $cn->prepare($sql);
        $result->bindParam(1, $id);
        $result->bindParam(2, $proId);
        $result->execute();
        if($result->rowCount()>0){
            return $result->fetchAll();
        }
    }catch (PDOException $e){
        return false;
    }
}
function getProductsByType()
{
    try {
        global $cn;
        $sql = "select * from category where type = 1 AND status = 1";
        $result = $cn->query($sql);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
    } catch (\Throwable $e) {
        return false;
    }
}
function getProducts($category_id)
{
    try {
        global $cn;
        $sql = "select * from products where category_id = ? AND status = 1";
        $result = $cn->prepare($sql);
        $result->bindValue(1,$category_id);
        $result->execute();
        if ($result->rowCount() > 0) {
            return $result->fetchAll();
        }
    } catch (\Throwable $e) {
        return false;
    }
}
function getAllNotifications()
{
    global $cn;
    $sql = "select * from notifications where status = 1";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllTrust()
{
    global $cn;
    $sql = "select * from trust where status = 1";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function searchBlog($keyword = '', $category_id = 0, $limit = 20, $offset = 0) {
    global $cn;

    // اطمینان از عددی بودن مقادیر برای جلوگیری از خطا در کوئری
    $limit  = (int)$limit;
    $offset = (int)$offset;

    // شروع کوئری پایه (فرض بر این است که ستون status برای فعال بودن مقاله وجود دارد)
    $sql = "SELECT * FROM blog WHERE status = 1";
    $params = [];

    // فیلتر بر اساس کلمه کلیدی در عنوان
    if (!empty($keyword)) {
        $sql .= " AND title LIKE ?";
        $params[] = "%$keyword%";
    }

    // فیلتر بر اساس دسته بندی (چون تک سطحی است، مستقیم چک می‌کنیم)
    if ($category_id > 0) {
        $sql .= " AND blog_categories_id = ?";
        $params[] = (int)$category_id;
    }

    // مرتب سازی بر اساس جدیدترین مقالات و اعمال Limit/Offset
    $sql .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";

    try {
        $stmt = $cn->prepare($sql);
        $stmt->execute($params);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return !empty($results) ? $results : false;
    } catch (PDOException $e) {
        // در محیط Production بهتر است این خطا را لاگ کنید نه اینکه نمایش دهید
        return false;
    }
}
function countBlog($keyword = '', $category_id = 0) {
    global $cn;

    $sql = "SELECT COUNT(*) as total FROM blog WHERE status = 1";
    $params = [];

    if (!empty($keyword)) {
        $sql .= " AND title LIKE ?";
        $params[] = "%$keyword%";
    }

    if ($category_id > 0) {
        $sql .= " AND blog_categories_id = ?";
        $params[] = (int)$category_id;
    }

    try {
        $stmt = $cn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? (int)$row['total'] : 0;
    } catch (PDOException $e) {
        return 0;
    }
}