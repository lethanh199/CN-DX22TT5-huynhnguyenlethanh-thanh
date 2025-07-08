<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['add'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $desc = $conn->real_escape_string($_POST['description']);
    $price = (float)$_POST['price'];
    $image = $conn->real_escape_string($_POST['image']);
    $category_id = (int)$_POST['category'];
    $user_id = $_SESSION['user_id']; 

    $sql = "INSERT INTO products (user_id, category_id, title, description, price, image)
            VALUES ($user_id, $category_id, '$title', '$desc', $price, '$image')";

    if ($conn->query($sql)) {
        header("Location: product_list.php"); 
    } else {
        echo "❌ Thêm thất bại: " . $conn->error;
    }
}

$categories = $conn->query("SELECT * FROM categories");
?>

<?php include '../header.php'; ?>
<link rel="stylesheet" href="../css/style.css">

<div class="container">
    <h2>➕ Thêm sản phẩm mới</h2>
    <form method="post">
        <label>Tên sản phẩm:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Mô tả:</label><br>
        <textarea name="description" rows="4" cols="50"></textarea><br><br>

        <label>Giá (VNĐ):</label><br>
        <input type="number" name="price" required><br><br>

        <label>Ảnh (tên file trong thư mục src/img/):</label><br>
        <input type="text" name="image"><br><br>

        <label>Danh mục:</label><br>
        <select name="category" required>
            <?php while($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <button name="add">Thêm sản phẩm</button>
    </form>
</div>

<?php include '../footer.php'; ?>
