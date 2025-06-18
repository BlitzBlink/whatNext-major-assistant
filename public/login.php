<?php
$page = 'login';
include_once('../templates/header.php');
include_once('../src/config/db.php');
?>

<main class="auth">
    <section>
        <div class="container">
            <div>
                <h1>Sign in to your account</h1>
            </div>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials'): ?>
                <p class="error">Invalid email or password.</p>
            <?php endif; ?>

            <form class="form" action="../src/auth/login_user.php" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="off">

                <input class="button button-primary" type="submit" value="Sign In">
            </form>
            
            <p>Doesn't have an account? <a href="/whatnext/public/register.php"><span class="primary-text">click here</span></a></p>
        </div>
    </section>
</main>
<script src="./assets/js/header.js"></script>
<?php include_once('../templates/footer.php'); ?>