<?php
session_start();

if ($_SESSION['score'] <= 0) {
    header("Location: index.php");
    exit();
}

// Final Jeopardy question and correct answer
$finalQuestion = 'What is the best major of them all?';
$finalAnswer = 'Computer Science';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Final Jeopardy</title>
</head>
<body>
    <div class="container">
        <h1>Final Jeopardy</h1>
        <div class = "score"><p><?php echo $finalQuestion; ?></p></div>

        <!-- Form for wagering points and answering Final Jeopardy -->
        <form action="final_jeopardy_result.php" method="post">
            <label for="wager">Wager (up to your current score): </label>
            <input type="number" id="wager" name="wager" min="0" max="<?php echo $_SESSION['score']; ?>" required>
            <div class="timer-container">
                <!--circular timer animation-->
                    <svg class="countdown-circle" viewBox="0 0 160 160">
                        <circle cx="80" cy="80" r="75" class="circle-bg"/>
                        <circle cx="80" cy="80" r="75" class="circle-progress" />
                    </svg>
                    <div class="countdown-text">20s</div>
            </div>
            <label for="final_answer">Your Answer: </label>
            <input type="text" id="final_answer" name="final_answer" required>

            <button type="submit">Submit Final Jeopardy</button>
        </form>
    </div>
</body>
</html>
