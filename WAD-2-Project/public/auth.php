<!DOCTYPE HTML>
<html>
	<head>
		<title>Project Team4</title>
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
							<span class="icon fa-user"></span>
							<!-- <span class="material-icons md-white text-white">logo_dev</span> -->
						</div>
						<div class="content">
							<div class="inner">
								
								<!-- <h1>Sign In</h1> -->
								<form method="post" action="login.php">
									<div class="fields">
										<div class="field">
											<label for="email">Email</label>
											<input type="text" name="email" id="email" placeholder="johndoe@email.com"/>
										</div>
										<div class="field">
											<label for="password">Password</label>
											<input type="password" name="password" id="password"/>
										</div>
									</div>
									<div class="actions">
										<input type="submit" style="margin-right:15px" value="Submit" class="primary" />
										<input type="reset" style="margin-right:15px" value="Clear" />
									</div>
									<div>
										<p><br><a href="signup.php">Don't have an account? Sign Up</a></p>
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
			<script>
				let errors = [];
				<?php
				if (isset($_SESSION["errors"])) {
					$errors = $_SESSION["errors"];
					foreach ($errors as $error) {
						echo "errors[] = `$error`;\n";
					}
				}
				?>
				console.log(errors);
			</script>
    </body>
</html>