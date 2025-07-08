<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../includes/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$sql = "SELECT p.*, c.name as category 
        FROM products p 
        JOIN categories c ON p.category_id = c.id 
        ORDER BY p.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../header.php'; ?>

<div class="admin-container">
    <h2>Danh sách sản phẩm</h2>
    <a href="add_product.php" class="btn">+ Thêm sản phẩm</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= number_format($row['price']) ?> VNĐ</td>
                        <td><?= htmlspecialchars($row['category']) ?></td>
                        <td><?= $row['status'] === 'available' ? '✅ Còn hàng' : '❌ Đã bán' ?></td>
                        <td>
                            <a href="edit_product.php?id=<?= $row['id'] ?>"> Sửa</a> |
                            <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?');">🗑️ Xoá</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6">Không có sản phẩm nào.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../footer.php'; ?>
</body>
</html>
