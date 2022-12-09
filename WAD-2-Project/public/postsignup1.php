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
                <form method="post" action="createAcct.php">
                  <div class="fields">

                    <div class="field">
                      <input type="hidden" name="name" value="<?= $_POST["name"] ?>" />
                      <input type="hidden" name="email" value="<?= $_POST["email"] ?>" />
                      <input type="hidden" name="password" value="<?= $_POST["password"] ?>" />
                      <input type="hidden" name="interest" value="<?= $_POST["interest"] ?>" />
                      <input type="hidden" name="gender" value="<?= $_POST["gender"] ?>" />
                      <input type="hidden" name="username" value="<?= $_POST["username"] ?>" />
                      <input type="hidden" name="age" value="<?= $_POST["age"] ?>" />

                      <label for="mobile_number">mobile_number</label>
                      <input type="text" name="mobile_number" id="mobile_number" placeholder="mobile_number" required/>
                    </div>

                    <div class="field">
                      <label for="school">school</label>
                      <input type="text" name="school" id="school" placeholder="school" required/>
                    </div>

                    <div class="field">
                      <label for="year_of_study">year_of_study</label>
                      <input type="text" name="year_of_study" id="year_of_study" placeholder="year_of_study" required/>
                    </div>

                    <div class="field">
                      <label for="code">course</label>
                      <input type="text" name="course" id="course" placeholder="course" required/>
                    </div>


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
