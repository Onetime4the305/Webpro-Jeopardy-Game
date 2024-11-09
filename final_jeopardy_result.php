<?php
session_start();

if ($_SESSION['score'] <= 0) {
    header("Location: index.php");
    exit();
}

$finalAnswer = 'Computer Science'; // Correct answer
$wager = isset($_POST['wager']) ? intval($_POST['wager']) : 0;
$userAnswer = isset($_POST['final_answer']) ? trim($_POST['final_answer']) : '';

// Check if the answer is correct
if (strcasecmp($userAnswer, $finalAnswer) == 0) {
    $_SESSION['score'] += $wager; // Correct answer, add wager to score
    $_SESSION['message'] = "Correct! You earned $wager points.";
} else {
    $_SESSION['score'] -= $wager; // Incorrect answer, subtract wager from score
    $_SESSION['message'] = "Incorrect! You lost $wager points.";
}

// Show final score
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Game Over</title>
</head>
<body>
    <div class="container">
        <h1>Game Over!</h1>
        <p>Your final score is: <?php echo $_SESSION['score']; ?></p>
        <form action="index.php" method="get">
                <button type="submit" class="final-jeopardy-button">Back to Game</button>
            </form>
    </div>
</body>
</html>
