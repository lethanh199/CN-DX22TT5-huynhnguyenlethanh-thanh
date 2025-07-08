<?php
session_start();
require_once 'includes/config.php';

$register_error = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $role = $_POST['role'];

   if (empty($username) || empty($password) || empty($email) || empty($role)) {
        $errors[] = "Vui lòng điền đầy đủ thông tin.";
    }
        $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $check->store_result();

         if ($check->num_rows > 0) {
        $errors[] = "Tên đăng nhập hoặc email đã tồn tại.";
    }
           if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashed, $email, $role);
        $stmt->execute();

        $_SESSION['user'] = $username;
        $_SESSION['role'] = $role;
        if ($role === 'seller') {
        header("Location: seller_products.php");
    } else {
        header("Location: index.php");
}

        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản | Đồ gỗ cũ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="register-box">
    <h2>📝 Đăng ký tài khoản</h2>

    <?php if (!empty($errors)): ?>
    <div class="error-msg"><?= implode('<br>', $errors) ?></div>
<?php endif; ?>

    <form method="POST">
    <input type="text" name="username" placeholder="Tên đăng nhập" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>

    <select name="role" required>
        <option value="">-- Chọn vai trò --</option>
        <option value="user">Khách hàng</option>
        <option value="seller">Người bán</option>
    </select>

    <button type="submit" class="btn">Đăng ký</button>
</form>

    <p style="text-align: center; margin-top: 15px;">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
