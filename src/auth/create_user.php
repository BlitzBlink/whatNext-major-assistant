<?php
include_once('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = htmlspecialchars(trim($_POST['username']));
    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user';

    if ($password === $confirm_password) {
        // Check if email already exists
        $check = $conn->prepare("SELECT * FROM Account WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows > 0) {
            header("Location: /whatnext/public/register.php?error=duplicate_email");
            $check->close();
            $conn->close();
            exit;
        }
        $check->close();

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt1 = $conn->prepare("INSERT INTO Account (email, password, username, role) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("ssss", $email, $hashed_password, $username, $role);

        if ($stmt1->execute()) {
            $account_id = $conn->insert_id;
            $stmt2 = $conn->prepare("INSERT INTO User (account_id, fName, lName) VALUES (?, ?, ?)");
            $stmt2->bind_param("iss", $account_id, $fName, $lName);    
        } else {
            header("Location: /whatnext/public/register.php?error=inserting_fail");
            echo "Error inserting into Account: " . $stmt1->error;
        }

        $stmt1->close();
    } else {
        header("Location: /whatnext/public/register.php?error=password_unmatch");
    }

    session_start();
    $_SESSION['account_id'] = $account_id;
    $_SESSION['username']   = $username;
    $_SESSION['role']       = $role;

    $conn->close();

    header('Location: /whatnext/public/index.php');
    exit();
}
?>