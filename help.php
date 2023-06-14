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
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="./style/help.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Help</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins',sans-serif;
    }
      body{
        background: #f4f4f4f4;
    }
      .wrapper {

      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      justify-items: center;
      justify-content: center;
      align-items: start;
      color: #525050;
    }

    .card {
      padding: 40px;
      max-width: 620px; 
      min-width: 420px;
      background: #f4f4f4;
      border-radius: 18px;
      box-shadow:  3px 3px 6px #bebebe, 
                    -3px -3px 6px #eeeded;
    }
    .square,
    .circle {
    width: 20vw;
    height: 20vw;
    position: absolute;
    z-index: -1;
    }

    .square:after,
    .circle:after {
      content: "";
      position: absolute;
      width: 70%;
      height: 70%;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: -1;
    }

    .square {
      border-radius: 10px;
      transform: rotate(45deg);
      box-shadow: -9px 0 9px 0 rgba(255, 255, 255, 0.4),
        9px 0 9px 0 rgba(40, 54, 216, 0.86);
    }

    .square::after {
      border-radius: 10px;
      box-shadow: inset -9px 0 9px 0 rgba(255, 255, 255, 0.4),
        inset 9px 0 9px 0 rgba(39, 81, 230, 0.812);
    }

    .circle {
      border-radius: 50%;
      box-shadow: -9px -9px 9px 0 rgba(255, 255, 255, 0.4),
        9px 9px 9px 0 rgba(173, 12, 12, 0.886);
    }

    .circle:after {
      border-radius: 50%;
      box-shadow: inset -9px -9px 9px 0 rgba(255, 255, 255, 0.4),
        inset 9px 9px 9px 0 rgba(168, 13, 13, 0.786);
    }


    .circle.one {
      top: -5%;
      right: -5%;
    }

    .square.two {
      bottom: -5%;
      right: -5%;
    }

    .circle.two {
      bottom: -5%;
      left: -5%;
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

    <h2>GET STARTED</h2><br>
    <div class="wrapper">
      <div class="card">
        <h4>Navigate to GAME tab</h4>
        <ul>
          <li>Insert Player1 & Player2's names</li>
          <li>Choose board size</li>
          <li>Hit Start Game button</li>
          <li>Choose piece color for each player</li>
          <li>Press Play Game</li>
          <li>The board colors can be changed by clicking on the color buttons at the bottom of the page</li>
        </ul>
      </div>
    </div>

      <div id="tabs" class="tabs-container">
        <br>
        <h2>WAYS TO WIN THE GAME</h2>
        <br>
        <div class="tabs">
            <a id="tab1" data-tab="1" class="tab"></a>
            <a id="tab2" data-tab="2" class="tab"></a>
            <a id="tab3" data-tab="3" class="tab"></a>
            <a id="tab4" data-tab="4" class="tab"></a>
        </div>

        <div class="content">
            <div id="tabcontent1" data-tab="1" class="tabcontent">
              <h4>Connect Four Pieces Horizontally</h4>
              <br>
              <img class="img" src="./photos/horizontal.png">
            </div>
            <div id="tabcontent2" data-tab="2" class="tabcontent">
              <h4>Connect Four Pieces Vertically</h4>
              <br>
              <img class="img" src="./photos/vertical.png">
            </div>
            <div id="tabcontent3" data-tab="3" class="tabcontent">
              <h4>Connect Four Pieces Diagonally (Left)</h4>
              <br>
              <img class="img" src="./photos/dleft.png">
            </div>
            <div id="tabcontent4" data-tab="4" class="tabcontent">
              <h4>Connect Four Pieces Diagnoally (Right)</h4>
              <br>
              <img class="img" src="./photos/dright.png">
            </div>
        </div>

      </div>

      <!--shapes-->
      <div class="">
        <div class="square two"></div>
        <div class="circle one"></div>
        <div class="circle two"></div>
      </div>
      <div class="dark-mode-switch">
          <label class="switch-label" for="dark-mode-switch"></label>
          <label class="switch">
              <input type="checkbox" id="dark-mode-switch">
              <span class="slider round"></span>
          </label>
      </div>
    </div>
  <script>

  // DOM Elements
  const tabs = document.querySelectorAll('.tab')
  const tabContents = document.querySelectorAll('.tabcontent')
  const darkModeSwitch = document.querySelector('#dark-mode-switch')
    
  // Functions
  const activateTab = tabnum => {
      
      tabs.forEach( tab => {
        tab.classList.remove('active')
      })
      
      tabContents.forEach( tabContent => {
          tabContent.classList.remove('active')
      })
    
      document.querySelector('#tab' + tabnum).classList.add('active')
      document.querySelector('#tabcontent' + tabnum).classList.add('active')
      localStorage.setItem('jstabs-opentab', JSON.stringify(tabnum))
    
  }

  // Event Listeners
  tabs.forEach(tab => {
      tab.addEventListener('click', () => {
          activateTab(tab.dataset.tab)
      })
  })

  darkModeSwitch.addEventListener('change', () => {
      document.querySelector('body').classList.toggle('darkmode')
      localStorage.setItem('jstabs-darkmode', JSON.stringify(!darkmode))
  })

  // Retrieve stored data
  let darkmode = JSON.parse(localStorage.getItem('jstabs-darkmode'))
  const opentab =  JSON.parse(localStorage.getItem('jstabs-opentab')) || '3'

  // and..... Action!

  if (darkmode) {
      document.querySelector('body').classList.add('darkmode')
      document.querySelector('#dark-mode-switch').checked = 'checked'
  }
  activateTab(opentab)
  </script>
</body>
</html>
