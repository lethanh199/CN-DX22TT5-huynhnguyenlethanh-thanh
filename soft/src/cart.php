<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'includes/config.php';

if (isset($_POST['add'])) {
    $id = (int)$_POST['product_id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
}

if (isset($_POST['update_qty'])) {
    foreach ($_POST['quantities'] as $product_id => $qty) {
        $qty = (int)$qty;
        if ($qty > 0) $_SESSION['cart'][$product_id] = $qty;
        else unset($_SESSION['cart'][$product_id]);
    }
    header("Location: cart.php");
    exit;
}

if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][(int)$_GET['remove']]);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng | Đồ gỗ cũ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1>🛒 Giỏ hàng của bạn</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
        <form method="post">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tạm tính</th>
                        <th>Xoá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $id => $qty):
                        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $product = $stmt->get_result()->fetch_assoc();
                        if (!$product) continue;

                        $subtotal = $product['price'] * $qty;
                        $total += $subtotal;
                    ?>
                    <tr>
                        <td><img src="img/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>"></td>
                        <td><?= htmlspecialchars($product['title']) ?></td>
                        <td><?= number_format($product['price']) ?> VNĐ</td>
                        <td>
                            <input type="number" name="quantities[<?= $id ?>]" value="<?= $qty ?>" min="1" style="width:60px; text-align:center;">
                        </td>
                        <td><?= number_format($subtotal) ?> VNĐ</td>
                        <td><a href="?remove=<?= $id ?>" onclick="return confirm('Xoá sản phẩm này?');">❌</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-actions">
                <button type="submit" name="update_qty" class="btn">🔄 Cập nhật</button>
                <h2>🧾 Tổng cộng: <?= number_format($total) ?> VNĐ</h2>
            </div>
        </form>
        <a href="checkout.php" class="btn">Thanh toán</a>
    <?php else: ?>
        <p>🛒 Giỏ hàng đang trống.</p>
        <a href="index.php" class="btn">🛍️ Mua sắm ngay</a>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
