<?php
$page = 'result';
include_once('../templates/header.php');
include_once('../src/config/db.php');

$majors = [];
$sql = "SELECT major_id, name, description 
FROM Major 
WHERE major_id IN (SELECT major_id FROM ResultMajor);
";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $majors[] = $row;
    }
}
$bestMatch = array_shift($majors);
if (isset($_POST['reset'])) {
    $_SESSION['reset']  = true;
    header('Location: quiz.php');
    exit();
}
?>

<main class="result">
    <section>
        <div class="container">
            <div>
                <h1>Result Page</h1>
                <p>Based on your answers, here's the major that suits you best.</p>
            </div>

            <div class="results-container">
                <?php if ($bestMatch): ?>
                    <div class="result-card best-match-card">
                        <div>
                            <img src="../public/assets/images/major-img-cs.jpg" class="major-img" />
                        </div>
                        <div class="text-container">
                            <h2><?php echo htmlspecialchars($bestMatch['name']); ?></h2>
                            <p><?php echo htmlspecialchars($bestMatch['description']); ?></p>
                        </div>
                        <div class="cta-container">
                            <p>To know more about the major ask our AI</p>
                            <a class="button button-primary" href="/whatnext/public/chat.php?major_id=<?= $bestMatch['major_id'] ?>">Ask the AI</a>
                        </div>
                        <span class="best-match-tag">Best Match</span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($majors)): ?>
                    <h3>Other good matches for you</h3>
                    <div class="other-majors-container">

                        <?php foreach ($majors as $major): ?>
                            <div class="result-card">
                                <div>
                                    <img src="../public/assets/images/major-img-mechanicalEng.jpg" class="major-img" />
                                </div>
                                <div class="text-container">
                                    <h2><?php echo htmlspecialchars($major['name']); ?></h2>
                                    <p><?php echo htmlspecialchars($major['description']); ?></p>
                                </div>
                                <div class="cta-container">
                                    <p>To know more about the major ask our AI</p>
                                    <a class="button button-primary" href="/whatnext/public/chat.php?major_id=<?= $major['major_id'] ?>">Ask the AI</a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                <?php endif; ?>

                <div class="retake-container">
                    <div>
                        <h3>Retake Quiz</h3>
                        <p>Not quite convinced? Try the quiz again for a fresh perspective.</p>
                    </div>
                    <form method="post" action="">
                        <button class="button button-secondary" type="submit" name="reset">Retake Quiz</button>
                    </form>

                </div>
            </div>
    </section>
</main>

<?php include_once('../templates/footer.php'); ?>