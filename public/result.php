<?php
$page = 'result';
include_once('../templates/header.php');
include_once('../src/config/db.php');
$answers = $_SESSION['quiz_answers'];
$userTraits = $_SESSION['user_traits'];
$query = "SELECT m.major_id, m.name, m.description, mt.trait_id, mt.weight 
          FROM Major m 
          JOIN MajorTrait mt ON m.major_id = mt.major_id 
          ORDER BY m.major_id, mt.trait_id";
$result = mysqli_query($conn, $query);
foreach( $userTraits as $value)
{
    echo $value;
}
$majorScores = [];

// Process each row
while ($row = mysqli_fetch_assoc($result)) {
    $majorId = $row['major_id'];
    $majorName = $row['name'];
    $majorDescription = $row['description'];
    $traitId = $row['trait_id'];
    $weight = $row['weight'];
    

    
    // Initialize major if not exists
    if (!isset($majorScores[$majorId])) {
        $majorScores[$majorId] = [
            'major_id' => $majorId,
            'name' => $majorName,
            'description' => $majorDescription,
            'score' => 0
        ];
    }
    
    // Map trait_id to array index and accumulate weighted score

    $userTraitValue = $userTraits[$traitId - 1]; // trait_id 1-5 maps to array index 0-4
    $majorScores[$majorId]['score'] += $userTraitValue * $weight;
}

// Sort by score descending
uasort($majorScores, function($a, $b) {
    
    return $b['score'] - $a['score'];
});

// Get top 3 majors with all details
$majors = array_slice($majorScores, 0, 3, true);

$bestMatch = array_shift($majors);

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
                            <a class="button button-primary" href="/whatnext/public/chat.php?major_id=<?= $bestMatch['major_id']?>">Ask the AI</a>
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
                                    <a class="button button-primary" href="/whatnext/public/chat.php?major_id=<?= $major['major_id']?>">Ask the AI</a>
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
                    <a class="button">Retake Quiz</a>
                </div>
            </div>
    </section>
</main>
<?php include_once('../templates/footer.php'); ?>