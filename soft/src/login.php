<?php
session_start();
require_once 'includes/config.php';

$error = "";
$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
 if (empty($username) || empty($password)) {
        $errors[] = "Vui lòng nhập tên đăng nhập và mật khẩu.";
    } else {
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

     if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $uname, $db_password, $role);
            $stmt->fetch();

        if ($password === $db_password) {
                $_SESSION['user'] = $uname;
                $_SESSION['role'] = $role;
                $_SESSION['user_id'] = $id;

                if ($role === 'admin') {
                    header("Location: admin/admin.php");
                } elseif ($role === 'seller') {
                    header("Location: seller_products.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                $errors[] = "Sai mật khẩu.";
            }
        } else {
            $errors[] = "Tài khoản không tồn tại.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập | Đồ gỗ cũ</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .login-box {
            max-width: 400px;
            margin: 60px auto;
            padding: 30px;
            background: #fff8f0;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #5d4037;
        }
        .error-msg {
            background: #ffe5e5;
            color: #b71c1c;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #b71c1c;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
        }
        form input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #8d6e63;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #6d4c41;
        }
        p {
            text-align: center;
            margin-top: 15px;
        }
        a {
            color: #6d4c41;
            font-weight: bold;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="login-box">
    <h2>Đăng nhập</h2>
   <?php if (!empty($errors)): ?>
    <div class="error-msg"><?= implode('<br>', $errors) ?></div>
    <?php endif; ?>

<form method="POST">
    <input type="text" name="username" placeholder="Tên đăng nhập" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <button type="submit" class="btn">Đăng nhập</button>
</form>
    <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
