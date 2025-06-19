<?php
$page = 'analyzing';
include_once('../templates/header.php');
?>

<link rel="stylesheet" href="/css/result.css">
<main class="analyzing">
    <section>
        <div class="container">
            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>
            <h2>Analyzing your answers...</h2>
        </div>
    </section>
</main>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        setTimeout(() => {
        window.location.href = "/whatnext/public/result.php";
        }, 3000);
    });
</script>
<?php include_once('../templates/footer.php'); ?>