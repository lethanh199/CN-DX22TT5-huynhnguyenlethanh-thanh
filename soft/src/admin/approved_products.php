<?php
session_start();
require_once '../includes/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT p.*, u.username, c.name AS category 
                               FROM products p 
                               JOIN users u ON p.user_id = u.id 
                               JOIN categories c ON p.category_id = c.id
                               WHERE p.approved = 0");

if (isset($_GET['approve_id'])) {
    $id = (int)$_GET['approve_id'];
    mysqli_query($conn, "UPDATE products SET approved = 1 WHERE id = $id");
    header("Location: approve_products.php");
    exit();
}
?>

<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>📝 Duyệt sản phẩm mới</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Người bán</th>
                <th>Loại</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['category']) ?></td>
                    <td><?= number_format($row['price']) ?> đ</td>
                    <td><a href="?approve_id=<?= $row['id'] ?>" onclick="return confirm('Duyệt sản phẩm này?')">✅ Duyệt</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Không có sản phẩm chờ duyệt.</p>
    <?php endif; ?>
</div>

<?php include 'admin_footer.php'; ?>
