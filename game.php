<?php
// Checks if session has been started, if not then starts session
if(!isset ($_SESSION)){
    session_start();
}
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<script>//trying to get seesion to function grabsession(uid);</script>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/style.css" />
    <link rel="stylesheet" href="./style/table.css" />
    <link rel="stylesheet" href="./style/game-mode.css" />
    <link rel="stylesheet" href="./style/game.css">
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <script>
        //another session passing method that failed
        var uid = <?php echo $uid?>;
    </script>
    <title>Connect Four</title>
</head>
<body style="overflow:hidden">
    <div class="wrapper" id="wrapper">
        <div class="modal">
            <div class="modal-content">
                <div class="winner-container">
                    <h1>Congratulations <span class="winner"></span></h1>
                    <button class="play-again-btn">Play again</button>
                </div>
                <div class="color-picker">
                <h1>Choose a color</h1>
                    <div class="color-player-1">
                        <h1><?php echo $_SESSION['username']; ?></h1>
                    </div>
                    <div class="color-player-2">
                        <h1>Choose a color player 2</h1>
                    </div>
                    <button class="play-game-btn">Play game</button>
                </div>
            </div>
        </div>
        <div class="current-player"></div>
        <button class="flip-btn">Flip Board</button>
        <input type="checkbox" id="check" onblur="">
        <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
        <div class="side_bar">
            <div class="title">
                <div class="logo">Menu</div>
                <label for="check" class=" button cancel"><i class="fas fa-times"></i></label>
            </div>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i>Main</a></li>
                <li><a href="help.php"><i class="fas fa-question-circle"></i>Help</a></li>
                <li><a href="contact.php"><i class="fas fa-phone-volume"></i>Contact</a></li>
                <li><a href="game.php"><i class='fas fa-gamepad'></i>Game</a></li>
                <li><a href="leader-board.php"><i class="fa fa-trophy"></i>Leader Board</a></li>
                <li><a href="logout.php"><i class='fas fa-sign-out-alt'></i>Log Out</a></li>
            </ul>
            <br>
            <img class="brand-logo" src="fslogo.png"></img>
        </div>
        <br>
        <form class="game-mode">
            <select name="sizeOptions" class="size-options">
                <option disabled selected>Please Select Board Size</option>
                <option value="1">6x7</option>
                <option value="2">8x9</option>
            </select>
        </form>
    </div>
    <br>
    <div class="timer">00:00:00</div>
    <div>
        <span>
            <input type="text" class="player" id="player1" value="<?php echo $_SESSION['username']; ?>" placeholder="Player 1"></input>
            <input type="text" class="player" id="player2" placeholder="Player 2"></input>
            <input type="button" class="my-5 btn neumorphic-btn start-game-btn" id="button" value="Start Game"></input>
        </span>
    </div>



    <!--Buttons for changing board colors-->
    <div class="relative">
        <p>Click to change board color:</p>
        <button class="navitem" id="blue" onclick="toBlue()"></button>
        <button class="navitem" id="black" onclick="toBlack()"></button>
        <button class="navitem" id="white" onclick="toWhite()"></button>
    </div>

    <script src="./scripts/utilities.js"></script>
    <script src="./scripts/constants.js"></script>
    <script src="./scripts/game.js"></script>
    <script src="./scripts/game-hint.js"></script>
    <script src="./scripts/DynamicTable.js"></script>
    <script src="./scripts/EventHandlers.js"></script>
    <script src="./scripts/EventListener.js"></script>
    <script src="./scripts/index.js"></script>
    <script src="./scripts/bootstrap-select.min.js"></script>
    <script>
        document.querySelector('label').addEventListener('change', (e) => { console.log(e) })
    </script>
</body>

</html>