<?php
include("c4connection.php");
if(!isset ($_SESSION)){
    session_start();
}

   // Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
   header("location: index.php");
   exit;
}

// Define variables and initialize with empty values
$myusername = $mypassword = "";
$myusername_err = $mypassword_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

   // Check if username is empty
   if(empty(trim($_POST["username"]))){
       $myusername_err = "Please enter username.";
   } else{
       $myusername = trim($_POST["username"]);
   }
   
   // Check if password is empty
   if(empty(trim($_POST["password"]))){
       $mypassword_err = "Please enter your password.";
   } else{
       $mypassword = trim($_POST["password"]);
   }
   
   // Validate credentials
   if(empty($myusername_err) && empty($mypassword_err)){
       // Prepare a select statement
       $sql = "SELECT username, userpass FROM players WHERE username = ? and userpass = ?";
       
       if($stmt = mysqli_prepare($conn, $sql)){
           // Bind variables to the prepared statement as parameters
           mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_userpass);
           
           // Set parameters
           $param_username = $myusername;
           $param_userpass = $mypassword;
           
           // Attempt to execute the prepared statement
           if(mysqli_stmt_execute($stmt)){
               // Store result
               mysqli_stmt_store_result($stmt);
               
               // Check if login exists, if yes then start session
               if(mysqli_stmt_num_rows($stmt) == 1){                    
                  // Password is correct, so start a new session
                  session_start();
                  
                  // Store data in session variables
                  $_SESSION["loggedin"] = true;
                  $_SESSION["id"] = $id;
                  $_SESSION["username"] = $myusername;                            
                  
                  // Redirect user to welcome page
                  header("location: index.php");
                   
               } else{
               //login doesn't exist/wrong
               echo "Incorrect login, Please try again.";
                   header('Refresh: 2; URL=login.php');
               }
           } else{
               //Catchall, something else went wrong.
               echo "Oops! Something went wrong. Please try again later.";
               header('Refresh: 2; URL=login.php');
           }

           // Close statement
           mysqli_stmt_close($stmt);
       }
   }
   // Close connection
   mysqli_close($conn);
}

?>