<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../includes/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng điều khiển Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include '../header.php'; ?>



<div class="admin-dashboard">
    <h2>Chào mừng, quản trị viên!</h2>
    <div class="admin-panel">
  
    <div class="admin-links">
        <a href="product_list.php">Quản lý sản phẩm</a>
        <a href="user_list.php">Quản lý người dùng</a>
        <a href="orders.php">Quản lý đơn hàng</a>
        <a href="shipping_info.php">Thông tin giao hàng</a>
        <a href="../index.php">Về trang chính</a>
        <a href="../logout.php">Đăng xuất</a>
    </div>
</div>


    </div>
</div>

<?php include '../footer.php'; ?>

</body>
</html>
