<?php
session_start();
require_once 'includes/config.php';

$keyword = $_GET['keyword'] ?? '';
$category = $_GET['category'] ?? '';
$price = $_GET['price'] ?? '';

$sql = "SELECT p.*, c.name AS category_name 
        FROM products p 
        JOIN categories c ON p.category_id = c.id 
        WHERE p.status = 'available'";

if ($keyword) {
    $keyword = $conn->real_escape_string($keyword);
    $sql .= " AND p.title LIKE '%$keyword%'";
}

if ($category) {
    $sql .= " AND p.category_id = " . (int)$category;
}


$sql .= " ORDER BY p.created_at DESC";

$products = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1>Kết quả tìm kiếm</h1>

    <?php if ($products->num_rows > 0): ?>
        <div class="products">
            <?php while ($row = $products->fetch_assoc()): ?>
                <div class="product-card">
                    <div class="product-img">
                        <img src="img/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                    </div>
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= htmlspecialchars($row['category_name']) ?></p>
                    <p class="price"><?= number_format($row['price']) ?> VNĐ</p>
                    <form method="post" action="cart_add.php">
                        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn">🛒</button>
                        <a href="product_detail.php?id=<?= $row['id'] ?>" class="btn" style="background:#4CAF50;">Xem</a>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Không tìm thấy sản phẩm phù hợp.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
