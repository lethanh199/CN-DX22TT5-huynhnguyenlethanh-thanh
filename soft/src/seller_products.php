<?php
session_start();
require_once 'includes/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'seller') {
    die("Lỗi: user_id không tồn tại trong session.");
    header('Location: login.php');
    exit();
}


$user_id = $_SESSION['user_id']; 

$query = "SELECT p.*, c.name AS category_name 
          FROM products p 
          JOIN categories c ON p.category_id = c.id 
          WHERE p.user_id = $user_id 
          ORDER BY p.created_at DESC";
$result = mysqli_query($conn, $query);

include 'header.php';
?>

<div class="container">
    <h2>Sản phẩm của bạn</h2>

    <a href="seller_add_product.php" class="btn">➕ Đăng sản phẩm mới</a>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Loại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($row['image']) ?>" width="80" style="border-radius:6px;"></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= number_format($row['price']) ?> đ</td>
                        <td><?= htmlspecialchars($row['category_name']) ?></td>
                        <td>
                            <a href="seller_edit_product.php?id=<?= $row['id'] ?>" class="btn">✏️ Sửa</a>
                            <a href="seller_delete_product.php?id=<?= $row['id'] ?>" class="btn" onclick="return confirm('Xác nhận xóa?')">🗑️ Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Bạn chưa đăng sản phẩm nào.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
