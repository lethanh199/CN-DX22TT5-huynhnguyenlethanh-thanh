<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../includes/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID sản phẩm không hợp lệ.";
    exit;
}

$product_id = (int)$_GET['id'];

$product_result = $conn->query("SELECT * FROM products WHERE id = $product_id");
if ($product_result->num_rows === 0) {
    echo "Không tìm thấy sản phẩm.";
    exit;
}
$product = $product_result->fetch_assoc();

$categories = $conn->query("SELECT * FROM categories");

if (isset($_POST['update'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $desc = $conn->real_escape_string($_POST['description']);
    $price = (float)$_POST['price'];
    $image = $conn->real_escape_string($_POST['image']);
    $category_id = (int)$_POST['category'];
    $status = $conn->real_escape_string($_POST['status']);

    $update_sql = "UPDATE products 
                   SET title='$title', description='$desc', price=$price, image='$image',
                       category_id=$category_id, status='$status'
                   WHERE id=$product_id";

    if ($conn->query($update_sql)) {
        header("Location: product_list.php?msg=updated");
        exit;
    } else {
        echo "❌ Cập nhật thất bại: " . $conn->error;
    }
}
?>

<?php include '../header.php'; ?>
<link rel="stylesheet" href="../css/style.css">

<div class="container">
    <h2>Sửa sản phẩm</h2>
    <form method="post">
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($product['title']) ?>" required><br><br>

        <label>Mô tả:</label><br>
        <textarea name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea><br><br>

        <label>Giá (VNĐ):</label><br>
        <input type="number" name="price" value="<?= $product['price'] ?>" required><br><br>

        <label>Ảnh (tên file trong src/img/):</label><br>
        <input type="text" name="image" value="<?= htmlspecialchars($product['image']) ?>"><br><br>

        <label>Danh mục:</label><br>
        <select name="category">
            <?php while($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Trạng thái:</label><br>
        <select name="status">
            <option value="available" <?= $product['status'] === 'available' ? 'selected' : '' ?>>Còn hàng</option>
            <option value="sold" <?= $product['status'] === 'sold' ? 'selected' : '' ?>>Đã bán</option>
        </select><br><br>

        <button type="submit" name="update">✅ Cập nhật sản phẩm</button>
    </form>
</div>

<?php include '../footer.php'; ?>
