<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$category_filter = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

$categories = [];
$cat_result = $conn->query("SELECT * FROM categories ORDER BY name");
while ($cat = $cat_result->fetch_assoc()) {
    $categories[] = $cat;
}

$sql = "SELECT p.*, c.name as category_name 
        FROM wishlist w
        JOIN products p ON w.product_id = p.id
        JOIN categories c ON p.category_id = c.id
        WHERE w.user_id = $user_id";

if ($category_filter > 0) {
    $sql .= " AND p.category_id = $category_filter";
}

$sql .= " ORDER BY p.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách yêu thích</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1 class="title">❤️ Sản phẩm yêu thích</h1>

    <form method="GET" style="margin-bottom: 20px;">
        <label>Phân loại:</label>
        <select name="category_id" onchange="this.form.submit()">
            <option value="0">Tất cả</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $category_filter ? 'selected' : '') ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if ($result->num_rows > 0): ?>
        <div class="products">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <div class="product-img">
                        <img src="img/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    </div>
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p class="price"><?= number_format($row['price']) ?> VNĐ</p>
                    <p class="category"><?= htmlspecialchars($row['category_name']) ?></p>
                    <a class="btn" href="product_detail.php?id=<?= $row['id'] ?>">Xem chi tiết</a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Chưa có sản phẩm nào trong danh sách yêu thích.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
