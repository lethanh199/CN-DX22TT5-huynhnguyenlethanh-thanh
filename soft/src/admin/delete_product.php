<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID sản phẩm không hợp lệ.";
    exit;
}

$product_id = (int)$_GET['id'];

$delete_sql = "DELETE FROM products WHERE id = $product_id";

if ($conn->query($delete_sql)) {
    header("Location: product_list.php?msg=deleted");
    exit();
} else {
    echo "❌ Xóa sản phẩm thất bại: " . $conn->error;
}

<?php include '../footer.php'; ?>
