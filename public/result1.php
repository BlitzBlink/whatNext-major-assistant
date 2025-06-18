 <?php
session_start();

if (!isset($_SESSION['quiz_answers']) || empty($_SESSION['quiz_answers'])) {
    header('Location: quiz.php');
    exit;
}

$answers = $_SESSION['quiz_answers'];
$userTraits = $_SESSION['user_traits'];
foreach($answers as $value)
{
    echo $value;
}
foreach($userTraits as $value1)
{
    echo $value1;
}
?>

