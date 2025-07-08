<?php
session_start();
require_once 'includes/config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt = $conn->prepare("SELECT p.*, c.name AS category FROM products p 
                        JOIN categories c ON p.category_id = c.id 
                        WHERE p.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Không tìm thấy sản phẩm.";
    exit;
}

$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $cart_id = (int)$_POST['product_id'];
    $_SESSION['cart'][$cart_id] = ($_SESSION['cart'][$cart_id] ?? 0) + 1;
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['title']) ?> | Đồ gỗ cũ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <div class="product-detail">
        <div class="product-image">
            <img src="img/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
        </div>
        <div class="product-info">
            <h2><?= htmlspecialchars($product['title']) ?></h2>
            <p><strong>Phân loại:</strong> <?= htmlspecialchars($product['category']) ?></p>
            <p><strong>Chi tiết:</strong><br><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            <p class="price"><?= number_format($product['price']) ?> VNĐ</p>

            <form method="post">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <button type="submit" class="btn">🛒 Thêm vào giỏ</button>
                <a href="wishlist_add.php?product_id=<?= $product['id'] ?>" class="btn" style="background:#4CAF50;">❤️ Yêu thích</a>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
