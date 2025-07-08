<?php
session_start();
require_once 'includes/config.php';

// Kiểm tra đăng nhập & đúng vai trò
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'seller') {
    header('Location: login.php');
    exit();
}

$seller_id = $_SESSION['user_id']; // ID người bán hiện tại

// Lấy đơn hàng có sản phẩm thuộc người bán này
$query = "
    SELECT o.id AS order_id, o.created_at, o.status,
           od.quantity, od.price,
           p.title AS product_name, 
           u.username AS buyer
    FROM order_details od
    JOIN orders o ON od.order_id = o.id
    JOIN products p ON od.product_id = p.id
    JOIN users u ON o.user_id = u.id
    WHERE p.user_id = $seller_id
    ORDER BY o.created_at DESC
";

$result = mysqli_query($conn, $query);

include 'header.php';
?>

<div class="container">
    <h2>📦 Đơn hàng đã bán</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Sản phẩm</th>
                    <th>Người mua</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>#<?= $row['order_id'] ?></td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td><?= htmlspecialchars($row['buyer']) ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= number_format($row['price'] * $row['quantity']) ?> đ</td>
                        <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                        <td>
                            <span class="status-label status-<?= strtolower(str_replace(' ', '-', $row['status'])) ?>">
                                <?= htmlspecialchars($row['status']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Chưa có đơn hàng nào được bán.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
