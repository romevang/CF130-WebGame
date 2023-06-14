<?php
include("c4connection.php");

//session_start();
if (isset($_POST['Array'])){
    $a =$_POST['Array'];
    $a =json_decode($a);
} else {
    echo "No array";
}

$userid=$a[0];
$wins = $a[1];
$playcount = $a[2];

$q = "SELECT * FROM players WHERE userid = '$userid'";

$output = mysqli_query($conn, $q);

if($output){
    if(mysqli_num_rows($output)>0){
        $data= mysqli_fetch_assoc($output);
        //$time += $data['time'];
        $wins +=$data['wins'];
        $playcount +=$data['playcount'];
    }
}

$q = "UPDATE players SET wins='$wins', playcount='$playcount' WHERE userid='$userid'";
mysqli_query($conn,$q);
$conn->close();
?>