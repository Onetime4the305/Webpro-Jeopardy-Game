<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Jeopardy Turtial</title>
    <link rel="stylesheet" href="tutorial.css">
</head>
<body>
    <h1>Welcome to the jeopardy tutorial</h1>

    <div class="container">
        <!--screenshot section-->
            <div class="screenshot"> 
                <img src="mainpage.png" alt="jeopardy game screenshot">
            </div>
            <!--chatbox section--> 
            <div class="chatbox rules-section"> 
                <h2>Single player jeopardy rules</h2>
                <p>Welcome to jeopardy! here are the rules for single players.</p>
                <ul>
                    <li>Select a question by choosing a category and its point value.</li>
                    <li>you earn point by answering the question correctly. Remember the timer is 20 seconds!</li> 
                    <li> try to reach the highest score by the end of the game.</li>
                    <li> the final round known as final jeopardy can wager to any amount from zero.</li>
                    <p>what is exactly a final jeopardy?. <a href="tutorial_2.php">Click here to see a visual!</a>
                </ul>
        </div>
        <!--bottom section with screenshot and timer-->
            <div class="bottom-section">
                <div class="screenshot-bottom">
                    <img src="question_screenshot.png" alt="Question screenshot" width="350" height="auto">
                </div>
                <div class="timer-container">
                <!--circular timer animation-->
                    <svg class="countdown-circle" viewBox="0 0 160 160">
                        <circle cx="80" cy="80" r="75" class="circle-bg"/>
                        <circle cx="80" cy="80" r="75" class="circle-progress" />
                    </svg>
                    <div class="countdown-text">20s</div>
                </div>
            </div>
        </div>
    <footer>
    <p>your points varies if you get the question right or wrong. <a href="index.php">Click here to play the game!</a> </p>
    </footer>
</body>
</html>