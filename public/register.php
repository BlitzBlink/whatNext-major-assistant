<?php
$page = 'register';
include_once('../templates/header.php');
include_once('../src/config/db.php');
?>

<link rel="stylesheet" href="/css/register.css">
<main class="register">
    <section>
        <div class="container">
            <div>
                <h1>Create New Account</h1>
            </div>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'inserting_fail'): ?>
                <p class="error">Registration failed</p>
            <?php elseif (isset($_GET['error']) && $_GET['error'] === 'password_unmatch'):?>
                <p class="error">Passwords do not match</p>
            <?php elseif (isset($_GET['error']) && $_GET['error'] === 'duplicate_email'):?>
                <p class="error">Email already in use</p>
            <?php endif; ?>
            <form class="form" action="../src/auth/create_user.php" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="username">Username</label>
                <input type="text" id="username" name="username" required><br><br>

                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" required><br><br>

                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" required><br><br>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="off">

                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required><br><br>

                <input class="button button-primary" type="submit" value="Sign Up">

                
            </form>
            <p>Already have an account? <a href="/whatnext/public/login.php"><span class="primary-text">click here</span></a></p>
        </div>
    </section>
</main>
<script src="./assets/js/header.js"></script>
<?php include_once('../templates/footer.php'); ?>