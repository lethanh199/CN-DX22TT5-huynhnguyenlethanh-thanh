<?php
session_start();
require_once '../includes/config.php';

$query = "SELECT s.*, u.username 
          FROM shipping_info s 
          JOIN users u ON s.user_id = u.id 
          ORDER BY s.created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý giao hàng | Quản trị</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../header.php'; ?>


<div class="container">
    <h1>Thông tin giao hàng</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Người nhận</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Ghi chú</th>
                    <th>Người đặt</th>
                    <th>Thời gian</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $row['order_id'] ?></td>
                    <td><?= htmlspecialchars($row['recipient_name']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['address'])) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['note'])) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Không có thông tin giao hàng nào.</p>
    <?php endif; ?>
</div>


<?php include '../footer.php'; ?>

</body>
</html>
