<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Answer feedback</title>
    <link rell="stylesheet" href="feedback.css">
    <style>
        .message-board{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f9f9f9;
            text-align: center;
            padding: 20px;
        }
        .message-content{
            font-size: 2em;
            padding: 40px;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);

        }
        .button-container{
            margin-top: 20px;
        }
        .back-button{
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head> 
<body>
    <div class="message-board">
        <div class="message-content">
            <?php if(isset($_SESSION['message'])): ?>
                <p><?php echo $_SESSION['message']; ?></p>
                <?php unset($_SESSION['message']); //clear message after displaying ?>
            <?php else: ?>
                <p>No messsage available.</p>
            <?php endif; ?>
            <div class="button-container">
                <a href="index.php" class="back-button">Back to game</a>
            </div>
        </div>
    </div>
</body>   
</html>