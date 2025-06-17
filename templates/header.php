<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WhatNext</title>
  <link rel="icon" href="../public/assets/images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../public/assets/css/styles.css">
  <?php if (isset($page) && $page === 'home'): ?>
    <link rel="stylesheet" href="../public/assets/css/home.css">
  <?php elseif (isset($page) && $page === 'chatbot'): ?>
    <link rel="stylesheet" href="../public/assets/css/chatbot.css">
  <?php endif; ?>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="logo-container">
        <a href="../public/index.php" class="logo">
            <img src="../public/assets/images/icon-logo-lg.svg" alt="WhatNext logo icon" class="logo-icon-lg">
            <img src="../public/assets/images/icon-logo-sm.svg" alt="WhatNext logo icon" class="logo-icon-sm">
            <span class="logo-text"><span class="primary-text">WhatNext</span><br>Major Counseling Assistant</span>
        </a>
    </div>

    <div class="links-container">
        <nav class="desktop-nav">
            <ul>
                <li><a href="/public/index.php">Home</a></li>
                <li><a href="/public/quiz.php">About the quiz</a></li>
            </ul>
            <div class="auth-container">
                <a class="button button-primary" id="login-button">
                    Login
                </a>
                <div class="profile-container hidden">
                    <img src="../public/assets/images/icon-profile.svg" alt="Profile Icon" class="profile-icon" id="profile-icon">
                    <div class="profile-dropdown" id="profile-dropdown">
                        <a class="profile-view" href="/public/profile.php">
                            <img src="../public/assets/images/icon-profile.svg" class="menu-profile-icon">
                            <span>MoazJalal02</span>
                        </a>
                        <a class="profile-signout" href="/public/logout.php">
                            <img src="../public/assets/images/icon-signout.svg" class="profile-signout-icon">
                            Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        
        
        <button class="menu-button" aria-label="Toggle menu">
            <img class="menu-icon" src="../public/assets/images/icon-menu.svg" alt="Menu icon">
        </button>
    </div>

    <div class="mobile-menu">
        <ul>
            <li class="auth-mobile auth-logged-out"><a href="/public/login.php">Login</a></li>
            <li class="auth-mobile auth-logged-in profile-view hidden ">
                <img src="../public/assets/images/icon-profile.svg" class="menu-profile-icon">
                <span>MoazJalal02</span>
            </li>
            <li><a href="/public/index.php">Home</a></li>
            <li><a href="/public/quiz.php">About the quiz</a></li>
            <li class="auth-mobile auth-logged-in hidden">
                <a class="profile-signout" href="/public/logout.php">
                    <img src="../public/assets/images/icon-signout.svg" class="profile-signout-icon">
                    Sign Out
                </a>
            </li>
        </ul>
    </div>
  </header>
