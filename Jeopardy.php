<?php
session_start();

// Initialize or reset the score
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

// Define categories and values
$categories = ['Science', 'History', 'Sports', 'Movies', 'Geography', 'Programming'];
$values = [200, 400, 600, 800, 1000];
$questions = [
    // Example questions with correct answers and options
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

// Handle question selection
if (isset($_GET['category']) && isset($_GET['value'])) {
    $category = $_GET['category'];
    $value = $_GET['value'];
    $questionData = $questions[$category][$value];

    // Display question page
    echo "<html><head><link rel='stylesheet' type='text/css' href='Jeopardy.css'></head><body>";
    echo "<h1>{$questionData['question']}</h1>";

    // Start timer
    echo "<div id='timer'>30</div>";
    echo "<script>
            let timeLeft = 30;
            const timerElement = document.getElementById('timer');
            const countdown = setInterval(() => {
                timeLeft--;
                timerElement.textContent = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    alert('Time is up!');
                    window.location.href='Jeopardy.php';
                }
            }, 1000);
          </script>";

    // Display options
    foreach ($questionData['options'] as $option) {
        echo "<a href='answer.php?category=$category&value=$value&answer=$option' class='option'>$option</a><br>";
    }
    echo "</body></html>";
    exit();
}

// Display Jeopardy grid
echo "<html><head><link rel='stylesheet' type='text/css' href='jeopardy.css'></head><body>";
echo "<h2>Score: " . $_SESSION['score'] . "</h2>";
echo "<table class='jeopardy-grid'>";

echo "<tr>";
foreach ($categories as $category) {
    echo "<td>$category</td>";
}
echo "</tr>";

foreach ($values as $value) {
    echo "<tr>";
    foreach ($categories as $category) {
        if (isset($_GET['answered']) && in_array("$category-$value", $_GET['answered'])) {
            echo "<td class='answered'>$value</td>";
        } else {
            echo "<td><a href='Jeopardy.php?category=$category&value=$value' class='question-box'>$value</a></td>";
        }
    }
    echo "</tr>";
}
echo "</table>";
echo "</body></html>";
