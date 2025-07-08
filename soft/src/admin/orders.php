<?php
session_start();
require_once '../includes/config.php';


$query = "SELECT o.id, o.user_id, u.username, o.created_at 
          FROM orders o 
          JOIN users u ON o.user_id = u.id 
          ORDER BY o.created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../header.php'; ?>

<div class="container">
    <h1>🧾 Danh sách đơn hàng</h1>

    <?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Người mua</th>
                <th>Ngày đặt</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>#<?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['username']) ?></td>
                <td><?= $row['created_at'] ?></td>
                <td><a href="order_detail.php?id=<?= $row['id'] ?>">🔍 Xem</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>Chưa có đơn hàng nào.</p>
    <?php endif; ?>
</div>

<?php include '../footer.php'; ?>

</body>
</html>
