<?php
// Checks if session has been started, if not then starts session
if(!isset ($_SESSION)){
  session_start();
}
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// database connection
include "c4connection.php";
// these are the database columns the user can sort by
$columns = array('userid','username','wins', 'playtime', 'playcount');

// Only get the column if it exists in the above columns array, if it doesn't exist the 
// database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $conn->query('SELECT * FROM players ORDER BY ' . $column . ' ' . $sort_order)) {
  // Some variables we need for the table.
  $up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
  $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
  $add_class = ' class="highlight"';


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="./style/reset.css">
  <link rel="stylesheet" href="./style/sidebar.css">
  <link rel="stylesheet" href="./style/leader-board.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <title>Leader Board</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;

    }

    body {
      background: #efeeee;
      overflow: hidden;
    }

    table tr td:last-child{
        width: 120px;
    }
    h1 {
    text-align: center;
    font-size: 2rem;
    padding: 5%;
    color: #595959;
    }

    .table-container {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    }

    table.neumorphic{
      width: 100%;
      border-spacing: 0;
      color: #212121;
      text-align: center;
      overflow: hidden;
      padding: 20px;
      box-shadow: 9px 9px 16px rgba(163, 177, 198, 0.6),
      -9px -9px 16px rgba(255, 255, 255, 0.6);
    }
    table.neumorphic thead{
      box-shadow: 9px 9px 16px rgba(163, 177, 198, 0.6);
    }
    table.neumorphic th{
      padding: 7px;
    }

    table.neumorphic>tbody>tr>td {
      padding: 50px;
      font-size: 18px;
      position: relative;
    }

    table.neumorphic>tbody>tr:hover {
      padding: 20px;
      box-shadow: 9px 9px 16px rgba(163, 177, 198, 0.6),
      -9px -9px 16px rgba(255, 255, 255, 0.6);
    }

    table.neumorphic tr td:first-child::before {
      content: "";
      position: absolute;
      padding: 10px;
      top: 0;
      left: -5000px;
      width: 10000px;
      height: 100%;
      z-index: -10;
    }

    table.neumorphic td:hover::after {
      content: "";
      position: absolute;
      box-shadow: 9px 9px 16px rgba(163, 177, 198, 0.6),
      -9px -9px 16px rgba(255, 255, 255, 0.6);
      left: 0;
      top: -5000px;
      height: 10000px;
      width: 100%;
      z-index: -1;
    }

    a {
      text-decoration: none;
      color: #b1102b;
    }
    a:hover {
      color: #13284c;
    }
    tr:hover {
      color: #b1102b;
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
      <li><a href="login.php"><i class='fas fa-sign-out-alt'></i>Log Out</a></li>
    </ul>
    <br>
    <img class="brand-logo" src="fslogo.png"></img>
  </div>
 
  <div class="table-container">
  <h1>LEADER BOARD</h1>
  <table class="neumorphic">
    <thead>
      <tr>
        <th><a href="leader-board.php?column=userid&order=<?php echo $asc_or_desc; ?>">User ID<i class="fas fa-sort<?php echo $column == 'userid' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="leader-board.php?column=username&order=<?php echo $asc_or_desc; ?>">Username<i class="fas fa-sort<?php echo $column == 'username' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="leader-board.php?column=wins&order=<?php echo $asc_or_desc; ?>">Wins<i class="fas fa-sort<?php echo $column == 'wins' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="leader-board.php?column=playtime&order=<?php echo $asc_or_desc; ?>">Playtime<i class="fas fa-sort<?php echo $column == 'playtime' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="leader-board.php?column=playcount&order=<?php echo $asc_or_desc; ?>">Play count<i class="fas fa-sort<?php echo $column == 'playcount' ? '-' . $up_or_down : ''; ?>"></i></a></th>
      </tr>
    </thead>
		<?php while ($row = $result->fetch_assoc()): ?>
    <tbody>
      <tr>
        <td<?php echo $column == 'userid' ? $add_class : ''; ?>><?php echo $row['userid']; ?></td>
        <td<?php echo $column == 'username' ? $add_class : ''; ?>><?php echo $row['username']; ?></td>
        <td<?php echo $column == 'wins' ? $add_class : ''; ?>><?php echo $row['wins']; ?></td>
        <td<?php echo $column == 'playtime' ? $add_class : ''; ?>><?php echo $row['playtime']; ?></td>
        <td<?php echo $column == 'playcount' ? $add_class : ''; ?>><?php echo $row['playcount']; ?></td>
      </tr>
    </tbody>
		<?php endwhile; ?>
	</table>
  </div>
  <div class="container">
      <div class="square two"></div>
      <div class="circle one"></div>
      <div class="circle two"></div>
    </div>
</body>

</html>
<?php $result->free(); mysqli_close($conn);}?>