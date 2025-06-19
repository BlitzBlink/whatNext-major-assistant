<?php
session_start();

// Include database connection
include_once('../src/config/db.php');

// Check if user is logged in and has quiz data
if (!isset($_SESSION['account_id']) || !isset($_SESSION['quiz_answers']) || !isset($_SESSION['user_traits'])) {
    header("Location: /whatnext/public/login.php");
    exit;
}

$answers = $_SESSION['quiz_answers'];
$userTraits = $_SESSION['user_traits'];
$account_id = $_SESSION['account_id'];

// Query to get major information with their trait weights
$query = "SELECT m.major_id, m.name, m.description, mt.trait_id, mt.weight 
          FROM Major m 
          JOIN MajorTrait mt ON m.major_id = mt.major_id 
          ORDER BY m.major_id, mt.trait_id";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

$majorScores = [];

// Process each row to calculate major scores
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
    // trait_id 1-5 maps to array index 0-4
    if ($traitId >= 1 && $traitId <= 5) {
        $userTraitValue = $userTraits[$traitId - 1];
        $majorScores[$majorId]['score'] += $userTraitValue * $weight;
    }
}

// Sort majors by score (highest first)
uasort($majorScores, function($a, $b) {
    return $b['score'] - $a['score'];
});

// Get top 3 majors
$topMajors = array_slice($majorScores, 0, 3, true);

// Clear any existing results for this user before inserting new ones
$deleteStmt = $conn->prepare("DELETE FROM ResultMajor WHERE account_id = ?");
if ($deleteStmt) {
    $deleteStmt->bind_param("i", $account_id);
    $deleteStmt->execute();
    $deleteStmt->close();
}

// Insert top 3 majors for this user
$insertStmt = $conn->prepare("INSERT INTO ResultMajor (account_id, ranking, major_id) VALUES (?, ?, ?)");

if ($insertStmt) {
    $ranking = 1;
    foreach ($topMajors as $major) {
        $insertStmt->bind_param("iii", $account_id, $ranking, $major['major_id']);
        
        if (!$insertStmt->execute()) {
            error_log("Failed to insert result for user $account_id, ranking $ranking: " . $insertStmt->error);
        }
        
        $ranking++;
    }
    $insertStmt->close();
} else {
    error_log("Failed to prepare insert statement: " . $conn->error);
}

// Store the results in session for the result page
$_SESSION['quiz_results'] = $topMajors;

// Close database connection
mysqli_close($conn);
?>