<?php
// Includes all packages from Composer;
require_once "../vendor/autoload.php";

// Includes all self-written code from src/ folder
require_once "../src/common.php";

// use Firebase\JWT\JWT;

session_start();

if (isset($_SESSION["id"])) {
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Sign Up</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fonts.css"><link>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css"></link>
    <link rel="stylesheet" href="assets/css/login_main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
  </head>
  <body class="is-preload">

    <!-- Wrapper -->
      <div id="wrapper">
        <header id="header">
            <div class="logo">
              <span class="icon fa-address-book"></span>
            </div>
            <div class="content">
              <div class="inner">
                <h2>Register an Account</h2>
                <!-- <h1>Sign In</h1> -->
                <form method="post" action="postsignup.php">
                  <div class="fields">
                    <div class="field half">
                      <label for="name">Name</label>
                      <input type="text" name="name" id="name" placeholder="john doe" required/>
                    </div>
                    <div class="field half">
                      <label for="email">Email</label>
                      <input class="form-control" type="email" name="email" id="email" placeholder="johndoe@email.com" required/>
                    </div>
                    <div class="field half">
                      <label for="password">Password</label>
                      <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                    </div>

                    <div class="field half">
                      <label for="cpassword">Confirm Password</label>
                      <input type="password" id="cpassword" name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                    </div>

                  </div>

                  <div class="field" id="message">
                    <p><br>Password must contain the following:</p>
                    <span id="letter" class="invalid">A <b>lowercase</b> letter</span><br>
                    <span id="capital" class="invalid">A <b>capital (uppercase)</b> letter</span><br>
                    <span id="number" class="invalid">A <b>number</b></span><br>
                    <span id="length" class="invalid">Minimum <b>8 characters</b></span>
                  </div>
                  <br>
                  <div class="actions">
                    <input type="submit" style="margin-right:15px" value="Submit" class="primary"/>
                    <input type="reset" style="margin-right:15px" value="Clear" />
                  </div>
                  <div>
                    <p><br><a href="auth.php">Already have an account? Sign In</a></p>
                  </div>
                </form>
              </div>
            </div>
                    </header>
          <footer id="footer">
            <p class="copyright">&copy; Team 4</p>
          </footer>

      </div>

    <!-- BG -->
      <div id="bg"></div><!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/browser.min.js"></script>
      <script src="assets/js/breakpoints.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>
      <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/vue.global.js"></script>
        <script src="assets/js/axios.min.js"></script>

    </body>
</html>
