<?php
include_once('../config/db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT account_id, password, username, role FROM Account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['account_id'] = $user['account_id'];
            $_SESSION['username']   = $user['username'];
            $_SESSION['role']       = $user['role'];

            if ($_SESSION['role'] === 'admin') {
                header("Location: /whatnext/public/admin/");
            } else {
                header("Location: /whatnext/public/index.php");
            }
            exit();
        } else {
            header("Location: /whatnext/public/login.php?error=invalid_credentials");
            exit();
        }
    } else {
        header("Location: /whatnext/public/login.php?error=invalid_credentials");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
