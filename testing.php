<?php
//File will be used for testing leaderboard updates. Will discard once completed.


//Connect to database
include("c4connection.php");
//include("functions.php");

$userid = 2;
$username = '';
$wins = '';
$playtime = '';
$playcount = '';


//query
$sql = "SELECT * FROM players WHERE userid=$userid";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_array($result))
{
  $userid = $row['userid'];
  $username = $row['username'];
  $wins = $row['wins'];
  $playtime = $row['playtime'];
  $playcount = $row['playcount'];
};

?>

<!DOCTYPE html>
<html lang="EN">
    <title>
        Testing
    </title>
    <head>
        
        <!--External CSS style sheet-->
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body>  
        <?php echo "My PHP Test!";?>
        <br>
        <?php echo $userid;?>
        <br>
        <?php echo $username;?>
        <br>
        <?php echo $wins;?>
        <br>
        <?php echo $playtime;?>
        <br>
        <?php echo $playcount;?>
        <br><br>
        <script>
            //var userid = <//?php echo $userid;?>;
            //var username = <//?php echo $username;?>;
            var wins = <?php echo $wins;?>;
            wins++;
            document.write(wins);
            //<//?php echo $wins;?> = wins;
            //var playtime = <//?php echo $playtime;?>;
            //var playcount = <//?php echo $playcount;?>;
           // <//?php $sql = "UPDATE players SET wins=$wins WHERE userid = $userid"; ?>
            /*console.log(userid);
            console.log(username);*/
            //console.log(wins);
            /*console.log(playtime);
            console.log(playcount);*/
        </script>
    </body>
</html>