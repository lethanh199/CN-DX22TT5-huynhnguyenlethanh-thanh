<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

include '../config.php';
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = mysqli_query($conn, "SELECT * FROM products WHERE approved = 1 ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm | Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<?php include '../header.php'; ?>

<div class="container">
    <h1>Quản lý sản phẩm</h1>
    <a href="add_product.php" class="btn">+ Thêm sản phẩm</a>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><img src="../<?= htmlspecialchars($row['image']) ?>" width="80"></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= number_format($row['price']) ?> VNĐ</td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $row['id'] ?>">Sửa</a> | 
                        <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Xoá sản phẩm này?');">Xoá</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../footer.php'; ?>

</body>
</html>
