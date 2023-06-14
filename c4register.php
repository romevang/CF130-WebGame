<?php
   //database connection
   include("c4connection.php");
   //PHP session start
   if(!isset ($_SESSION)){
    session_start();
  }

   //init variables for input validation
   $myusername = $mypassword = "";
   $name_err = $pass_err = "";

  // Checks submitted form data
  if($_SERVER["REQUEST_METHOD"] == "POST") {

     //Checks and sanitizes input for username
     $input_name = trim($_POST["username"]);
     if(empty($input_name)){
         $name_err = "Please enter a username.";
     } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
         $name_err = "Please enter a valid username.";
     } else{
         $myusername = $input_name;
     }

     //Checks and sanitizes input for password
     $input_pass = trim($_POST["password"]);
     if(empty($input_pass)){
         $pass_err = "Please enter a password.";
     } elseif(!filter_var($input_pass, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
         $pass_err = "Please enter a valid name.";
     } else{
         $mypassword = $input_pass;
     }

     // If no errors then insert into database
     if(empty($name_err) && empty($pass_err)) {
        // Prepares an insert statement
        $sql = "INSERT INTO players (userid, username, userpass, wins, playtime, playcount)
        VALUES (?, ?, ?, ?, ?, ?);";

        // If valid SQL statement
        if($stmt = mysqli_prepare($conn, $sql)){

           //Creates prepared statement with parameters
           mysqli_stmt_bind_param($stmt, "issiii", $param_id, $param_name, $param_pass, $param_wins, $param_pt, $param_pc);

           //Set parameter values
           $param_id = 0;
           $param_name = $myusername;
           $param_pass = $mypassword;
           $param_wins = 0;
           $param_pt = 0;
           $param_pc = 0;

           // Attempt to execute the prepared statement
           if(mysqli_stmt_execute($stmt)){
              // Records created successfully. Redirect to login page
              //header("location: login.html");
               echo "Account created successfully!";
               header('Refresh: 2; URL=login.php');
           } else{
              //echo error
              echo "Oops! Something went wrong. Please try again.";
              header('Refresh: 2; URL=error.php');
           }

         }
         // Close statement
         mysqli_stmt_close($stmt);
      }
      // Close connection
      mysqli_close($conn);

}


?>
 