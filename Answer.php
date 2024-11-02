<?php
session_start();

// Sample questions for Final Jeopardy
$finalQuestion = [
    'question' => 'What is the capital of France?',
    'correct' => 'Paris',
];

$finalAnswerSubmitted = false;

// Check if the user has answered a question
if (isset($_GET['category']) && isset($_GET['value']) && isset($_GET['answer'])) {
    $category = $_GET['category'];
    $value = $_GET['value'];
    $userAnswer = $_GET['answer'];

    // Check if the answer is correct
    $questions = [
        'Science' => [
        200 => ['question' => 'It is the most common element in the human body...', 'correct' => 'Oxygen', 'options' => ['Calcium', 'Oxygen', 'Hydrogen', 'Carbon']],
        400 => ['question' => 'What planet is known as the Red Planet?', 'correct' => 'Mars', 'options' => ['Earth', 'Mars', 'Jupiter', 'Venus']],
        600 => ['question' => 'This English chemist and physicist discovered hydrogen.', 'correct' => 'Henry Cavendish', 'options' => ['Sir Willaims Crookes', 'Henry Cavendish', 'Dorothy Hodgkin', 'Bernard Shaw']],
        800 => ['question' => 'It is the term for the condition when three celestial bodies are arranged in a straight line...', 'correct' => 'Syzygy', 'options' => ['Occultation', 'Parallax', 'Syzygy', 'Triple Transit']],
        1000 => ['question' => 'The first Earth Day was celebrated in this year...', 'correct' => '1970', 'options' => ['1950', '1960', '1970', '1980']]
    ],
    
    'History' => [
        200 => ['question' => 'Who was the first President of the United States?', 'correct' => 'George Washington', 'options' => ['Ronald Reagan', 'Arturo Roman', 'George Washington', 'Richard Nixon']],
        400 => ['question' => 'Who did James Early Ray assassinate in Memphis in April 1968?', 'correct' => 'Martin Luther King Jr.', 'options' => ['Abraham Lincoln', 'Martin Luther King Jr.', 'Alexander Hamilton', 'George W. Bush']],
        600 => ['question' => 'The Revolutionary war was fought against what empire?', 'correct' => 'British Empire', 'options' => ['Ottoman Empire', 'Roman Empire', 'Shu Dynasty', 'British Empire']],
        800 => ['question' => 'Near which town were there reports of a space ship landing on the 4th of July in 1947?', 'correct' => 'Roswell, New Mexico', 'options' => ['Roswell, New Mexico', 'Miami, Florida', 'Chicago, Illinois', 'Atlanta, Georgia']],
        1000 => ['question' => 'The Statue of Liberty was a gift from which country?', 'correct' => 'France', 'options' => ['France', 'China', 'India', 'Turkey']]
    ],

    'Sports' => [
        200 => ['question' => "What company's logo is a swoosh?", 'correct' => 'Nike', 'options' => ['Rebok', 'Adidas', 'Nike', 'Puma']],
        400 => ['question' => 'Where were the Olympics held in 2024?', 'correct' => 'Paris', 'options' => ['London', 'Paris', 'New York city', 'Tokyo']],
        600 => ['question' => 'What is the best award for a college football player called?', 'correct' => 'Heisman', 'options' => ['Lombardi', 'Russell', 'DPOY', 'Heisman']],
        800 => ['question' => 'What MLB team has the most championships?', 'correct' => 'Yankees', 'options' => ['Yankees', 'Red Sox', 'Dodgers', 'Titans']],
        1000 => ['question' => 'Who was the first golfer ever to reach 1 million in winnings?', 'correct' => 'Arnold Palmer', 'options' => ['Tiger Woods', 'Arnold Palmer', 'Babe Ruth', 'Tom Brady']]
    ],

    'Movies' => [
        200 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        400 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        600 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        800 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        1000 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']]
    ],

    'Geography' => [
        200 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        400 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        600 => ['question' => "On which river is the USA's highest concrete dam?", 'correct' => 'Colorado River', 'options' => ['Colorado River', 'Mississippi River', 'Yellow River', 'Nile River']],
        800 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        1000 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']]
    ],

    'Programming' => [
        200 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        400 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        600 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        800 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']],
        1000 => ['question' => '', 'correct' => '', 'options' => ['', '', '', '']]
    ]
    ];

    // Determine if the answer was correct and update score
    if (isset($questions[$category][$value])) {
        $correctAnswer = $questions[$category][$value]['correct'];
        if (strcasecmp($userAnswer, $correctAnswer) == 0) {
            $_SESSION['score'] += $value; // Correct answer
        } else {
            $_SESSION['score'] -= $value; // Incorrect answer
        }

        // Mark the question as answered
        if (!isset($_SESSION['answered'])) {
            $_SESSION['answered'] = [];
        }
        $_SESSION['answered'][] = "$category-$value";
    }

    // Check if all questions have been answered
    $allAnswered = count($_SESSION['answered']) >= 30; // 6 categories * 5 values
    if ($allAnswered) {
        header('Location: FinalJeopardy.php');
        exit();
    } else {
        header('Location: Jeopardy.php');
        exit();
    }
}

// Final Jeopardy logic
if (isset($_POST['final_answer'])) {
    $finalAnswer = trim($_POST['final_answer']);
    $finalAnswerSubmitted = true;

    if (strcasecmp($finalAnswer, $finalQuestion['correct']) == 0) {
        $_SESSION['score'] += 1000; // Example points for Final Jeopardy
        $resultMessage = "You win!";
    } else {
        $_SESSION['score'] = 0; // Reset score
        $resultMessage = "You lose!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Jeopardy</title>
    <link rel="stylesheet" type="text/css" href="jeopardy.css">
</head>
<body>
    <h2>Your Score: <?php echo $_SESSION['score']; ?></h2>

    <?php if ($finalAnswerSubmitted): ?>
        <h3><?php echo $resultMessage; ?></h3>
    <?php else: ?>
        <h3><?php echo $finalQuestion['question']; ?></h3>
        <form method="POST" action="answer.php">
            <input type="text" name="final_answer" required>
            <button type="submit">Submit Answer</button>
        </form>
    <?php endif; ?>

    <a href="Jeopardy.php">Start New Game</a>
</body>
</html>
