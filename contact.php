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
    <link rel="stylesheet" href="./style/contact.css">
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <title>Contact Page</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins',sans-serif;
    }
      body{
        background: #efeeee;
        overflow: hidden;
    }

    </style>
   </head>
<body>
  <input type="checkbox" id="check">
  <label class="button bars" for="check"><i class="fas fa-bars"></i></label>
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
  <div class="container">
    <div class="square two"></div>
    <div class="circle one"></div>
    <div class="circle two"></div>
  </div>

  <!--Name Cards-->
  <h1>OUR TEAM</h1><br><br>
  <div class="container flex-column d-flex">
    <div class="card">
      <div class="card-content flex-row d-flex">
        <div class="logo2"></div>
        <div class="d-flex flex-column">
          <span class="title">
            Thuy Tran
          </span>
          <span class="subtitle">
            Email: thuyuyenmytran@mail.fresnostate.edu
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="container flex-column d-flex">
    <div class="card">
      <div class="card-content flex-row d-flex">
        <div class="logo3"></div>
        <div class="d-flex flex-column">
          <span class="title">
            Romeo Vanegas
          </span>
          <span class="subtitle">
            Email: rvanegas@mail.fresnostate.edu
          </span>
        </div>
      </div>
    </div>
  </div>
  <!--
  <div id="row1">
    <div id="column1">
      <h3>Thuy Tran</h3><br>
      <p>Email: thuyuyenmytran@mail.fresnostate.edu</p>
      <button class="custom-btn btn"><span>Contact Me</span></button>
    </div>
    <div id="column2">
      <h3>Romeo Vanegas</h3><br>
      <p>Email: rvanegas@mail.fresnostate.edu</p>
      <button class="custom-btn btn"><span>Contact Me</span></button>
    </div>
</div>
-->
</body>
</html>
