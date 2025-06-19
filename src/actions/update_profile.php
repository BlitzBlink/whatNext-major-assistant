<?php
session_start();
include_once('../config/db.php');

$username = $_POST['username'];
$account_id = $_SESSION['account_id'] ?? null;

if ($account_id) {
    $stmt2 = $conn->prepare("UPDATE Account SET username = ? WHERE account_id = ?");
    $stmt2->bind_param("si", $username, $account_id);
    $stmt2->execute();
    $stmt2->close();

    header("Location: /whatnext/public/profile.php");
    exit;
} else {
    header("Location: /whatnext/public/login.php");
}
?>
