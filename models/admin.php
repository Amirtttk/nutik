<?php
function getAllBanner()
{
    global $cn;
    $sql = "select * from banner ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllAdvertisingBanner()
{
    global $cn;
    $sql = "select * from advertising_banner ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllBlogCategories(){
    global $cn;
    $sql = "SELECT * FROM blog_categories ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllFaq()
{
    global $cn;
    $sql = "select * from faq";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllLink()
{
    global $cn;
    $sql = "select * from link";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllForwarding()
{
    global $cn;
    $sql = "select * from forwarding";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllBrand()
{
    global $cn;
    $sql = "select * from brand ORDER BY id DESC";
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
    $sql = "select * from blog ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllBlogCategoriesByStatus(){
    global $cn;
    $sql = "SELECT * FROM blog_categories where status = 1 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllCategoriesByParentId()
{
    global $cn;
    $sql = "select * from category where parent_id is null ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllBrandsByStatus()
{
    global $cn;
    $sql = "select * from brand where status = 1 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllProducts()
{
    global $cn;
    $sql = "select * from products ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllContactUs1()
{
    global $cn;
    $sql = "select * from contactUs where status = 1 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllContactUs2()
{
    global $cn;
    $sql = "select * from contactUs where status = 2 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllTickets()
{
    global $cn;
    $sql = "SELECT t.*, ct.sender AS last_sender, ct.timeSend AS last_message_time
FROM tickets t
LEFT JOIN (
    SELECT c1.ticketId, c1.sender, c1.timeSend
    FROM chat_tickets c1
    WHERE c1.id = (SELECT MAX(c2.id) FROM chat_tickets c2 WHERE c2.ticketId = c1.ticketId)
) ct ON t.id = ct.ticketId
WHERE t.status = 1
ORDER BY (ct.sender = 2) DESC, ct.timeSend DESC";
    $result = $cn->query($sql);
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
    $sql = "select * from chat_tickets where ticketId =? ORDER BY ticketId DESC";
    $result = $cn->prepare($sql);
    $result->bindValue(1, $ticketId);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllUsers()
{
    global $cn;
    $sql = "select * from users_info_public where userAccLvl = 4 ORDER BY userID DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllCoupon()
{
    global $cn;
    $sql = "select * from coupon";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllOrdersByType()
{
    global $cn;
    $sql = "select * from orders  ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllOrdersByUserId($userId)
{
    global $cn;
    $sql = "select * from orders where user_id = ? ORDER BY id DESC";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$userId);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
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
function getAllOrdersByStatus()
{
    global $cn;
    $sql = "select * from orders where status = 10 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllOrdersByFactor()
{
    global $cn;

    $queries = [
        'today' => "
            SELECT *, SUM(amount_payable) OVER() AS total_amount
            FROM orders
            WHERE status = 10
              AND DATE(create_at) = CURDATE()
            ORDER BY id DESC
        ",
        'week' => "
            SELECT *, SUM(amount_payable) OVER() AS total_amount
            FROM orders
            WHERE status = 10
              AND YEARWEEK(create_at, 1) = YEARWEEK(CURDATE(), 1)
            ORDER BY id DESC
        ",
        'month' => "
            SELECT *, SUM(amount_payable) OVER() AS total_amount
            FROM orders
            WHERE status = 10
              AND YEAR(create_at) = YEAR(CURDATE())
              AND MONTH(create_at) = MONTH(CURDATE())
            ORDER BY id DESC
        "
    ];

    $data = [];

    foreach ($queries as $key => $sql) {
        $stmt = $cn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data[$key] = [
            'orders' => $rows,
            'total_amount' => $rows[0]['total_amount'] ?? 0
        ];
    }

    return $data;
}
function getLowStockProductsSummary()
{
    global $cn;
    $sql = "SELECT stock, price FROM products";
    $stmt = $cn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $singlePriceCount = 0;
    $multiPriceCount  = 0;
    foreach ($products as $product) {

        // ✅ محصولات چندقیمتی
        if (!empty($product['price'])) {
            $prices = json_decode($product['price'], true);

            if (is_array($prices)) {
                foreach ($prices as $variant) {
                    if (isset($variant['count']) && (int)$variant['count'] < 3) {
                        $multiPriceCount++;
                        break; // هر محصول فقط یک بار
                    }
                }
            }

            // ✅ محصولات تک‌قیمتی
        } else {
            if ((int)$product['stock'] < 3) {
                $singlePriceCount++;
            }
        }
    }

    return [
        'single_price' => $singlePriceCount,
        'multi_price'  => $multiPriceCount,
        'total'        => $singlePriceCount + $multiPriceCount
    ];
}
function getAllOrdersByStatusAndType()
{
    global $cn;
    $sql = "select * from orders where status = 10 AND type = 4 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getWeeklySales()
{
    global $cn;

    $sql = "
        SELECT 
            DAYOFWEEK(create_at) as day_number,
            SUM(amount_payable) as total
        FROM orders
        WHERE status = 10
          AND YEARWEEK(create_at, 1) = YEARWEEK(CURDATE(), 1)
        GROUP BY DAYOFWEEK(create_at)
        ORDER BY DAYOFWEEK(create_at)
    ";

    $stmt = $cn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $days = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0];

    foreach ($rows as $row) {
        $days[(int)$row['day_number']] = (int)$row['total'];
    }

    return array_values($days);
}
function getMonthlyOrdersCount()
{
    global $cn;

    $sql = "
        SELECT 
            DAY(create_at) as day_number,
            COUNT(*) as total
        FROM orders
        WHERE status = 10
          AND YEAR(create_at) = YEAR(CURDATE())
          AND MONTH(create_at) = MONTH(CURDATE())
        GROUP BY DAY(create_at)
        ORDER BY DAY(create_at)
    ";

    $stmt = $cn->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $daysInMonth = date('t');
    $days = array_fill(1, $daysInMonth, 0);

    foreach ($rows as $row) {
        $days[(int)$row['day_number']] = (int)$row['total'];
    }

    return array_values($days);
}
function getAllBlogByLimit()
{
    global $cn;
    $sql = "select * from blog ORDER BY id DESC LIMIT 4";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllPages()
{
    global $cn;
    $sql = "select * from pages";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllComments2()
{
    global $cn;
    $sql = "select * from comments where status = 2 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllComments1()
{
    global $cn;
    $sql = "select * from comments where status = 1 ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getLast7DaysOrdersByStatus($status = 10)
{
    global $cn;

    $sql = "
        SELECT *
        FROM orders
        WHERE status = :status
          AND create_at >= CURDATE() - INTERVAL 6 DAY
          AND create_at < CURDATE() + INTERVAL 1 DAY
        ORDER BY id DESC
    ";

    $stmt = $cn->prepare($sql);
    $stmt->execute(['status' => $status]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getLast30DaysOrdersByStatus($status = 10)
{
    global $cn;

    $sql = "
        SELECT *
        FROM orders
        WHERE status = :status
          AND create_at >= CURDATE() - INTERVAL 29 DAY
          AND create_at < CURDATE() + INTERVAL 1 DAY
        ORDER BY id DESC
    ";

    $stmt = $cn->prepare($sql);
    $stmt->execute(['status' => $status]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAllNotifications()
{
    global $cn;
    $sql = "select * from notifications";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}
function getAllComments()
{
    global $cn;
    $sql = "select * from comments";
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
    $sql = "select * from trust ORDER BY id DESC";
    $result = $cn->query($sql);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}

function getAllTicketsByUserId($user_id)
{
    global $cn;
    $sql = "SELECT t.*, ct.sender AS last_sender, ct.timeSend AS last_message_time
FROM tickets t
LEFT JOIN (
    SELECT c1.ticketId, c1.sender, c1.timeSend
    FROM chat_tickets c1
    WHERE c1.id = (SELECT MAX(c2.id) FROM chat_tickets c2 WHERE c2.ticketId = c1.ticketId)
) ct ON t.id = ct.ticketId
WHERE t.status = 1
AND userID = ?
ORDER BY (ct.sender = 2) DESC, ct.timeSend DESC";
    $result = $cn->prepare($sql);
    $result->bindValue(1,$user_id);
    $result->execute();
    if ($result->rowCount() > 0) {
        return $result->fetchAll();
    }
    return false;
}


