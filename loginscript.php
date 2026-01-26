<?php
session_start();
require_once 'database.php'; 
$conn = getConnection(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, login, haslo FROM admin WHERE login = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && $pass === $admin['haslo']) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_logged'] = true;
        header("Location: admin.php");
        exit();
    } else {
        header("Location: login.php?error=1");
        exit();
    }
}