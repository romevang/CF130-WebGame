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
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./style/reset.css">
  <link rel="stylesheet" href="./style/index.css">
  <link rel="stylesheet" href="./style/sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
  <div class="wrapper">
    <input type="checkbox" id="check">
    <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
    <!--Side Navigation bar-->
    <div class="side_bar">
      <div class="title">
        <div class="logo">Menu</div>
        <label class=" button cancel" for="check"><i class="fas fa-times"></i></label>
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
    <!--End of Navigation bar-->
    <!-- <div class="neu">WELCOME!! </div> -->
    <div class="neu">WELCOME, <?php echo $_SESSION['username']; ?></div>
    <div class="container">
      <div class="square two"></div>
      <div class="circle one"></div>
      <div class="circle two"></div>
    </div>
  </div>
  <script src="./scripts/utilities.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>