<?php
session_start();

// Initialize score and answered questions if they don't exist
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
if (!isset($_SESSION['answered'])) {
    $_SESSION['answered'] = []; // Track answered questions
}

// Sample questions and answers organized by category
$questions = [
    'Science' => [
         ['question' => 'It is the most common element in the human body...', 'answer' => 'Oxygen', 'options' => ['Calcium', 'Oxygen', 'Hydrogen', 'Carbon']],
         ['question' => 'What planet is known as the Red Planet?', 'answer' => 'Mars', 'options' => ['Earth', 'Mars', 'Jupiter', 'Venus']],
         ['question' => 'This English chemist and physicist discovered hydrogen.', 'answer' => 'Henry Cavendish', 'options' => ['Sir Willaims Crookes', 'Henry Cavendish', 'Dorothy Hodgkin', 'Bernard Shaw']],
         ['question' => 'It is the term for the condition when three celestial bodies are arranged in a straight line...', 'answer' => 'Syzygy', 'options' => ['Occultation', 'Parallax', 'Syzygy', 'Triple Transit']],
         ['question' => 'The first Earth Day was celebrated in this year...', 'answer' => '1970', 'options' => ['1950', '1960', '1970', '1980']]
    ],
    
    'History' => [
         ['question' => 'Who was the first President of the United States?', 'answer' => 'George Washington', 'options' => ['Ronald Reagan', 'Arturo Roman', 'George Washington', 'Richard Nixon']],
         ['question' => 'Who did James Early Ray assassinate in Memphis in April 1968?', 'answer' => 'Martin Luther King Jr.', 'options' => ['Abraham Lincoln', 'Martin Luther King Jr.', 'Alexander Hamilton', 'George W. Bush']],
         ['question' => 'The Revolutionary war was fought against what empire?', 'answer' => 'British Empire', 'options' => ['Ottoman Empire', 'Roman Empire', 'Shu Dynasty', 'British Empire']],
         ['question' => 'Near which town were there reports of a space ship landing on the 4th of July in 1947?', 'answer' => 'Roswell, New Mexico', 'options' => ['Roswell, New Mexico', 'Miami, Florida', 'Chicago, Illinois', 'Atlanta, Georgia']],
         ['question' => 'The Statue of Liberty was a gift from which country?', 'answer' => 'France', 'options' => ['France', 'China', 'India', 'Turkey']]
    ],

    'Sports' => [
         ['question' => "What company's logo is a swoosh?", 'answer' => 'Nike', 'options' => ['Rebok', 'Adidas', 'Nike', 'Puma']],
         ['question' => 'Where were the Olympics held in 2024?', 'answer' => 'Paris', 'options' => ['London', 'Paris', 'New York city', 'Tokyo']],
         ['question' => 'What is the best award for a college football player called?', 'answer' => 'Heisman', 'options' => ['Lombardi', 'Russell', 'DPOY', 'Heisman']],
         ['question' => 'What MLB team has the most championships?', 'answer' => 'Yankees', 'options' => ['Yankees', 'Red Sox', 'Dodgers', 'Titans']],
         ['question' => 'Who was the first golfer ever to reach 1 million in winnings?', 'answer' => 'Arnold Palmer', 'options' => ['Tiger Woods', 'Arnold Palmer', 'Babe Ruth', 'Tom Brady']]
    ],

    'Movies' => [
         ['question' => 'Who is the Fanous Protagonist of the Pirates of the Carribbean films?', 'answer' => 'Jack Sparrow', 'options' => ['Harry Potter', 'Percy Jackson', 'Blackbeard', 'Jack Sparrow']],
         ['question' => 'In the Harry Potter series, what is the name of the school that Harry attends?', 'answer' => 'Hogwarts', 'options' => ['Hogwarts', 'Beacon', 'Vacuole', 'Blackrock']],
         ['question' => 'WHat movie was dethromed as the highest grossing movie of all time by Avengers Endgame in 2019?', 'answer' => 'Avatar', 'options' => ['Star Wars Episode V', 'Avatar', 'Avengers Infinity War', 'The Lion King']],
         ['question' => 'Which is the first Walt Disney animated classic, the first animated full-color movie to be produced?', 'answer' => 'Snow White and the Seven Dwarfs', 'options' => ['Snow White and the Seven Dwarfs', 'Mulan', 'Anastatia', 'Cinderella']],
         ['question' => 'What movie does the quote, "Look how they massacred my boy.', 'answer' => 'The Godfather', 'options' => ['Inception', 'The Godfather', 'The Great Gatsby', 'Tenet']]
    ],

    'Geography' => [
         ['question' => 'Where is the capital of the United States?', 'answer' => 'Washington D.C.', 'options' => ['New York', 'Washington D.C.', 'Atlanta', 'Chicago']],
         ['question' => 'Toronto is a large city near Lake Ontario. Which country is this in?', 'answer' => 'Canada', 'options' => ['Italy', 'Mexico', 'Canada', 'France']],
         ['question' => "On which river is the USA's highest concrete dam?", 'answer' => 'Colorado River', 'options' => ['Colorado River', 'Mississippi River', 'Yellow River', 'Nile River']],
         ['question' => 'Yucatan, Iberian, and Balkan are all examples of this physical feature?', 'answer' => 'Peninsula', 'options' => ['Archipelago', 'Island', 'Peninsula', 'Continent']],
         ['question' => 'What is the largest city in the world?', 'answer' => 'Tokyo', 'options' => ['Paris', 'Tokyo', 'New York', 'London']]
    ],

    'Coding' => [
         ['question' => 'Which of these are a coding language', 'answer' => 'C++', 'options' => ['Nokia', 'C++', 'Plains', 'Google']],
         ['question' => 'What are conditional statements?', 'answer' => 'Programs that only run when certain paremeters are met', 'options' => ['Program that never runs', 'Programs that only run when certain paremeters are met', 'Programs that loop', 'Programs that access different pages']],
         ['question' => 'What process is used to clean up code in a program?', 'answer' => 'debugging', 'options' => ['looping', 'recursion', 'debugging', 'factoring']],
         ['question' => 'ColdFusion is a type of code used by what?', 'answer' => 'Adobe', 'options' => ['Nasa', 'The Pentagon', 'Adobe', 'Servers']],
         ['question' => 'Html is utilized in the creation webpages. In regards to Html code, what does CSS serve as of the HTML? ', 'answer' => 'Stylesheet', 'options' => ['Stylesheet', 'Authenticator', 'Parameter', 'Server-side Validation']]
    ]
];

$allAnswered = true;
foreach ($questions as $category => $categoryQuestions) {  // Correctly loop over the categories
    foreach ($categoryQuestions as $index => $question) { // Loop through each question in the category
        $questionKey = "$category-$index";
        if (!in_array($questionKey, $_SESSION['answered'])) {
            $allAnswered = false;
            break 2; // Break both loops if we find an unanswered question
        }
    }
}
$categories = array_keys($questions);
$values = [200, 400, 600, 800, 1000];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Jeopardy Game</title>
</head>
<body>
    <div class="container">
        <h1>Jeopardy Game</h1>
        <div class="score">Score: <?php echo $_SESSION['score']; ?></div>
        <?php if ($allAnswered && $_SESSION['score'] > 0): ?>
            <form action="final_jeopardy.php" method="get">
                <button type="submit" class="final-jeopardy-button">Go to Final Jeopardy</button>
            </form>
        <?php elseif ($allAnswered && $_SESSION['score'] <= 0): ?>
            <p>You have no score. Game Over.</p>
        <?php endif; ?>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert"><?php echo $_SESSION['message']; ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="grid">
            <!-- Category Row -->
            <div class="grid-row">
                <?php foreach ($categories as $category): ?>
                    <div class="grid-item header"><?php echo htmlspecialchars($category); ?></div>
                <?php endforeach; ?>
            </div>

            <!-- Questions Grid -->
            <?php for ($i = 0; $i < 5; $i++): ?>
                <div class="grid-row">
                    <?php foreach ($categories as $category): ?>
                        <?php 
                        // Check if the question has been answered
                        $questionKey = "$category-$i"; // Unique key for each question
                        ?>
                        <div class="grid-item">
                            <?php if (in_array($questionKey, $_SESSION['answered'])): ?>
                                <span class="answered"><?php echo htmlspecialchars($values[$i]); ?></span>
                            <?php else: ?>
                                <a href="question.php?category=<?php echo urlencode($category); ?>&index=<?php echo $i; ?>" class="question-link"><?php echo htmlspecialchars($values[$i]); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endfor; ?>
        </div>

        <form action="restart.php" method="post" style="margin-top: 20px;">
            <button type="submit">Restart Game</button>
        </form>
    </div>
</body>
</html>              





