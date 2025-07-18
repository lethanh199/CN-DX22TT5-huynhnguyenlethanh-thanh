<?php
session_start();
require_once 'includes/config.php';

$products = $conn->query("SELECT p.*, c.name AS category 
                          FROM products p 
                          JOIN categories c ON p.category_id = c.id 
                          WHERE p.status = 'available'
                          ORDER BY p.created_at DESC");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $id = (int)$_POST['product_id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đồ gỗ cũ - Trang chủ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1>Danh sách sản phẩm</h1>

    <div class="products">
        <?php while ($row = $products->fetch_assoc()): ?>
             <?php
                $image = $row['image'];
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    $imageSrc = $image;
                } else {
                    $imageSrc = 'img/' . $image;
                }
            ?>
            <div class="product-card">
                <div class="product-img">
                    <img src="<?= htmlspecialchars($imageSrc) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                </div>
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p><?= htmlspecialchars($row['category']) ?></p>
                <p class="price"><?= number_format($row['price']) ?> VNĐ</p>
                <form method="post">
                    <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn">🛒</button>
                    <a href="product_detail.php?id=<?= $row['id'] ?>" class="btn" style="background:#4CAF50;">🔍 Xem</a>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
