<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/config.php';

$message = "";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];

if (isset($_POST['checkout']) && !empty($_SESSION['cart'])) {
    $recipient_name = trim($_POST['recipient_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $note = trim($_POST['note']);

    if ($recipient_name && $phone && $address) {
        $conn->query("INSERT INTO orders (user_id) VALUES ($user_id)");
        $order_id = $conn->insert_id;

        foreach ($_SESSION['cart'] as $product_id => $qty) {
            $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            if (!$product) continue;

            $price = $product['price'];

            $insert_detail = $conn->prepare("INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $insert_detail->bind_param("iiid", $order_id, $product_id, $qty, $price);
            $insert_detail->execute();

            $update_status = $conn->prepare("UPDATE products SET status = 'sold' WHERE id = ?");
            if ($update_status) {
                $update_status->bind_param("i", $product_id);
                $update_status->execute();
            }
        }

        $insert_shipping = $conn->prepare("INSERT INTO shipping_info (order_id, user_id, recipient_name, phone, address, note) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_shipping->bind_param("iissss", $order_id, $user_id, $recipient_name, $phone, $address, $note);
        $insert_shipping->execute();

        unset($_SESSION['cart']);
        $message = "✅ Thanh toán thành công! Mã đơn hàng của bạn là: <strong>#$order_id</strong>";
    } else {
        $message = "⚠️ Vui lòng điền đầy đủ thông tin giao hàng.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận thanh toán | Đồ gỗ cũ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1>🧾 Xác nhận thanh toán</h1>

    <?php if (!empty($message)): ?>
        <div class="product-card">
            <p><?= $message ?></p>
            <a href="index.php" class="btn">🛍️ Tiếp tục mua hàng</a>
        </div>
    <?php elseif (!empty($_SESSION['cart'])): ?>
        <div class="product-card">
            <form method="post">
                <div class="form-group">
                    <label>👤 Tên người nhận:</label>
                    <input type="text" name="recipient_name" required>
                </div>
                <div class="form-group">
                    <label>📞 Số điện thoại:</label>
                    <input type="text" name="phone" required>
                </div>
                <div class="form-group">
                    <label>🏠 Địa chỉ giao hàng:</label>
                    <textarea name="address" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>📝 Ghi chú:</label>
                    <textarea name="note" rows="2"></textarea>
                </div>
                <button type="submit" name="checkout" class="btn">✅ Xác nhận thanh toán</button>
            </form>
        </div>
    <?php else: ?>
        <p>🛒 Giỏ hàng của bạn đang trống.</p>
        <a href="index.php" class="btn">Quay về trang chủ</a>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
