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

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product_id'])) {
    $product_id = (int) $_POST['product_id'];

    $check_sql = "SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $check_result = $stmt->get_result();

    if ($check_result->num_rows === 0) {
        $insert_sql = "INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ii", $user_id, $product_id);
        $insert_stmt->execute();
    }
}

$redirect_url = $_SERVER['HTTP_REFERER'] ?? 'wishlist.php';
header("Location: $redirect_url");
exit;
