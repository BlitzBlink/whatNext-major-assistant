<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = $_SESSION["username"] ?? NULL;
$role = $_SESSION["role"] ?? NULL;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatNext</title>
    <link rel="icon" href="/whatnext/public/assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/whatnext/public/assets/css/styles.css">
    <?php if (isset($page) && $page === 'home'): ?>
        <link rel="stylesheet" href="/whatnext/public/assets/css/home.css">
    <?php elseif (isset($page) && $page === 'quiz'): ?>
        <link rel="stylesheet" href="/whatnext/public/assets/css/quiz.css">
    <?php elseif (isset($page) && $page === 'analyzing'): ?>
        <link rel="stylesheet" href="/whatnext/public/assets/css/analyzing.css">
    <?php elseif (isset($page) && $page === 'result'): ?>
        <link rel="stylesheet" href="/whatnext/public/assets/css/result.css">
    <?php elseif (isset($page) && $page === 'chatbot'): ?>
        <link rel="stylesheet" href="/whatnext/public/assets/css/chatbot.css">
    <?php elseif (isset($page) && (($page === 'register') || ($page === 'login'))): ?>
        <link rel="stylesheet" href="/whatnext/public/assets/css/auth.css">
    <?php elseif (isset($page) && $page === 'profile'): ?>
        <link rel="stylesheet" href="/whatnext/public/assets/css/profile.css">
    <?php elseif (isset($page) && $page === 'admin'): ?>
        <link rel="stylesheet" href="/whatnext/public/assets/css/admin.css">
    <?php endif; ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        const isLoggedIn = <?= isset($_SESSION['account_id']) ? 'true' : 'false' ?>;
    </script>
    <script src="/whatnext/public/assets/js/header.js"></script>
</head>

<body>
    <header>
        <div class="logo-container">
            <a href="/whatnext/public/index.php" class="logo">
                <img src="/whatnext/public/assets/images/icon-logo-lg.svg" alt="WhatNext logo icon" class="logo-icon-lg">
                <img src="/whatnext/public/assets/images/icon-logo-sm.svg" alt="WhatNext logo icon" class="logo-icon-sm">
                <span class="logo-text"><span class="primary-text">WhatNext</span><br>Major Counseling Assistant</span>
            </a>
        </div>

        <div class="links-container">
            <nav class="desktop-nav">
                <ul>
                    <li><a href="/whatnext/public/index.php">Home</a></li>
                    <li><a href="/whatnext/public/quiz.php">About the quiz</a></li>
                </ul>
                <div class="auth-container">
                    <a class="button button-primary" id="login-button" href="/whatnext/public/login.php">
                        Login
                    </a>
                    <div class="profile-container hidden">
                        <img src="/whatnext/public/assets/images/icon-profile.svg" alt="Profile Icon" class="profile-icon" id="profile-icon">
                        <div class="profile-dropdown" id="profile-dropdown">
                            <?php if ($role === "admin"): ?>
                                <a class="profile-view" href="/whatnext/public/admin/">
                                    <img src="/whatnext/public/assets/images/icon-profile.svg" class="menu-profile-icon">
                                    <span><?= htmlspecialchars($username) ?></span>
                                </a>
                            <?php endif; ?>
                            <a class="profile-signout" href="/whatnext/src/auth/logout.php">
                                <img src="/whatnext/public/assets/images/icon-signout.svg" class="profile-signout-icon">
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </nav>


            <button class="menu-button" aria-label="Toggle menu">
                <img class="menu-icon" src="/whatnext/public/assets/images/icon-menu.svg" alt="Menu icon">
            </button>
        </div>

        <div class="mobile-menu">
            <ul>
                <li class="auth-mobile auth-logged-out"><a href="/whatnext/public/login.php">Login</a></li>
                <li class="auth-mobile auth-logged-in profile-view hidden ">
                    <img src="/whatnext/public/assets/images/icon-profile.svg" class="menu-profile-icon">
                    <span><?= htmlspecialchars($username) ?></span>
                </li>
                <li><a href="/whatnext/public/index.php">Home</a></li>
                <li><a href="/whatnext/public/quiz.php">About the quiz</a></li>
                <li class="auth-mobile auth-logged-in hidden">
                    <a class="profile-signout" href="../src/auth/logout.php">
                        <img src="/whatnext/public/assets/images/icon-signout.svg" class="profile-signout-icon">
                        Sign Out
                    </a>
                </li>
            </ul>
        </div>
    </header>