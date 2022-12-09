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
                <h2>Post Sign Up</h2>
                <!-- <h1>Sign In</h1> -->
                <form method="post" action="postsignup1.php">
                  <div class="fields">
                    <div class="field">
                      <input type="hidden" name="name" value="<?= $_POST["name"] ?>" />
                      <input type="hidden" name="email" value="<?= $_POST["email"] ?>" />
                      <input type="hidden" name="password" value="<?= $_POST["password"] ?>" />

                      <label for="username">username</label>
                      <input type="text" name="username" id="username" placeholder="username" required/>
                    </div>

                    <div class="field">
                      <label for="gender">gender</label>
                      <br>
                      <input class="form-check-input" type="radio" name="gender" value="M" id="gender1" required>
                      <label class="form-check-label" for="gender1">
                        Male
                      </label>&nbsp;
                      <input class="form-check-input" type="radio" name="gender" value="F" id="gender2" required>
                      <label class="form-check-label" for="gender2">
                        Female
                      </label>&nbsp;
                      <input class="form-check-input" type="radio" name="gender" value="O" id="gender3" required>
                      <label class="form-check-label" for="gender3">
                        Others
                      </label>&nbsp;
                    </div>

                    <div class="field">
                      <label for="age">age</label>
                      <input class="form-control" type="number" name="age" id="age" placeholder="age" required/>
                    </div>

                    <div class="field">
                      <label for="interest">interest</label>
                      <textarea id="interest-textbox" class="form-control" name="interest" id="interest" placeholder="interest" required></textarea>
                    </div>

                  </div>


                  <br>
                  <div class="actions">
                    <input type="submit" style="margin-right:15px" value="Next" class="primary"/>
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
      <div id="bg"></div>

			<!-- Scripts -->
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
