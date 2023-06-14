<?php
  // includes for database and registration
  include("c4connection.php");
  include("c4register.php");
  // Checks if session has been started, if not then starts session
  if(!isset ($_SESSION)){
    session_start();
  }
  
  // Check if the user is already logged in, if yes then redirect him to welcome page.
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
  }
?>
<!--HTML Begins -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="./style/login.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
              <div class="sign-up-container">
                <!--Account registration-->
                <form action="c4register.php" method="post">
                  <!--Username-->
                  <h1>Create Account</h1>
                  <span>Using a name and password, please.</span>
                  <input type="text" name="username" placeholder="username" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $myusername; ?>">
                  <br><span class="invalid-feedback" style="color: red;"> <?php echo $name_err ?> </span>
                  <!--Password-->
                  <input type="password" name="password" placeholder="password" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mypassword; ?>">
                  <br><span class="invalid-feedback" style="color: red;"> <?php echo $pass_err ?> </span>
                  <input type="submit" class= "form_btn" style="cursor: pointer;" value = "Sign Up"/><br />
                  <!--End of Create Account-->
                </form>
              </div>
              <!--Start of Normal Login-->
              <div class="sign-in-container">
                <form action="c4login.php" method="post">
                  <h1>Sign In</h1>
                  <span>with your Username and Password</span>
                  <input type="text" name="username" placeholder="username">
                  <input type="password" name="password" placeholder="password">
                  <input type="submit" class= "form_btn" style="cursor: pointer;" value = "Sign-In"/>
                </form>
              <!--end of Normal Login-->
              </div>
              <div class="overlay-container">
                <div class="overlay-left">
                  <h1>Welcome Back</h1>
                  <p>If you are a returned user, please sign in:</p>
                  <button id="signIn" class="overlay_btn">Sign In</button>
                </div>
                <div class="overlay-right">
                  <h1>Hello there!</h1>
                  <p>If you are a new user, please sign up:</p>
                  <button id="signUp" class="overlay_btn">Sign Up</button>
                </div>
              </div>
            </div>
          </div>
          <script src="./scripts/login.js"></script>
    </body>
</html>