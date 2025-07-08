<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'includes/config.php';
?>



<div class="banner-wrapper">
    <img src="/src/img/banner.png" class="banner-img">
</div>

<nav class="top-nav">
    <div class="nav-container">
        <div class="nav-links">
            <a href="/src/index.php">Trang chủ</a>
            <a href="cart.php">Giỏ hàng</a>
            <?php if (!empty($_SESSION['user'])): ?>
                <span>Chào, <?= htmlspecialchars($_SESSION['user']) ?>!</span>
                <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="admin/admin.php">⚙️ Quản lý</a>
                <?php elseif ($_SESSION['role'] === 'seller'): ?>
                    <a href="/src/seller_add_product.php">Đăng sản phẩm</a>
                    <a href="/src/seller_products.php">Sản phẩm đã đăng</a>
                    <a href="/src/seller_orders.php">Đơn hàng</a>

                <?php endif; ?>
                <a href="wishlist.php">Yêu thích</a>
                <a href="/src/logout.php">Đăng xuất</a>
            <?php else: ?>
                <a href="login.php">Đăng nhập</a>
                <a href="register.php">Đăng ký</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="search-bar-wrapper">
    <form action="search.php" method="GET" class="search-form">
        <input type="text" name="keyword" placeholder="Từ khóa..."
            value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">

        <select name="category">
            <option value="">Loại</option>
            <?php
            $cats = mysqli_query($conn, "SELECT * FROM categories");
            while ($cat = mysqli_fetch_assoc($cats)) {
                $selected = ($_GET['category'] ?? '') == $cat['id'] ? 'selected' : '';
                echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
            }
            ?>
        </select>

        <button type="submit">Lọc</button>
    </form>
</div>

<style>
.banner-wrapper {
    width: 100%;
    height: 420px;
    overflow: hidden;
}
.banner-img {
    width: 100%;
    height: auto;
    object-fit: cover;
    display: block;
}

nav.top-nav {
    background-color: #5d4037;
    padding: 12px 20px;
}
.nav-container {
    max-width: 1200px;
    margin-left: auto;
    display: flex;
    justify-content: flex-end;
}
.nav-links {
    display: flex;
    gap: 14px;
    align-items: center;
    margin-left: auto;
}
.nav-links a, .nav-links span {
    color: #fff;
    font-weight: bold;
    text-decoration: none;
}
.nav-links a:hover {
    text-decoration: underline;
}

.search-bar-wrapper {
    max-width: 1000px;
    margin: 12px auto 10px;
    padding: 0 20px;
}
.search-form {
    display: flex;
    gap: 14px;
    justify-content: center;
    align-items: center;
    background: #fff;
    padding: 12px 18px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
.search-form input,
.search-form select {
    padding: 8px 12px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    min-width: 180px;
}
.search-form button {
    padding: 8px 18px;
    background-color: #8B4513;
    color: white;
    border: none;
    border-radius: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.search-form button:hover {
    background-color: #A0522D;
}
</style>
