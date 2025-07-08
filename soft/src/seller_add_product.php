<?php
session_start();
require_once 'includes/config.php';

// Kiểm tra đăng nhập và vai trò người bán
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'seller') {
    header('Location: login.php');
    exit();
}

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = (float) $_POST['price'];
    $category = (int) $_POST['category'];
    $image = mysqli_real_escape_string($conn, $_POST['image']); // giả sử nhập URL
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO products (title, description, price, image, category_id, user_id, approved)
            VALUES ('$title', '$description', $price, '$image', $category, $user_id, 0)";

    if (mysqli_query($conn, $sql)) {
        $success = "Sản phẩm đã được đăng thành công.";
    } else {
        $error = "Lỗi khi đăng sản phẩm: " . mysqli_error($conn);
    }
}

include 'header.php';
?>

<div class="container">
    <h2>Đăng sản phẩm mới</h2>

    <?php if (!empty($success)): ?>
        <div class="success-msg"><?= $success ?></div>
    <?php elseif (!empty($error)): ?>
        <div class="error-msg"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Tên sản phẩm:</label>
        <input type="text" name="title" required>

        <label>Mô tả:</label>
        <textarea name="description" required></textarea>

        <label>Giá (VNĐ):</label>
        <input type="number" name="price" step="1000" required>

        <label>Hình ảnh (URL hoặc link):</label>
        <input type="text" name="image">

        <label>Loại sản phẩm:</label>
        <select name="category" required>
            <option value="">-- Chọn loại --</option>
            <?php
            $res = mysqli_query($conn, "SELECT * FROM categories");
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>

        <button type="submit" class="btn">Đăng sản phẩm</button>
    </form>
</div>

<?php include 'footer.php'; ?>
