<?php //start before DOCTYPE
session_start();
?>

<!DOCTYPE html>
<html lang="<?php require_once 'config.php'; echo $language; ?>">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<!-- <meta name="author" content=""> -->

		<title><?php require_once 'config.php'; echo $title . ' - ' . $lang[$language]["Login_page"]; ?></title>


		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.4.5/spectre.min.css">
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.4.5/spectre-exp.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.4.5/spectre-icons.min.css"> -->

		<link href="css/main.css" rel="stylesheet">

		<!--<link href="css/admin.css" rel="stylesheet"> -->

	</head>

	<body class="container grid-lg text-center">

		<header>
			<nav class="navbar">
				<section class="navbar-section">
				</section>
				<section class="navbar-section navbar-center">
					<h1><?php require_once 'config.php'; echo $lang[$language]["Login_page"]; ?></h1>
				</section>
				<section class="navbar-section">
					<a href="index.php" class="btn btn-outline-inverted"><?php require_once 'config.php'; echo $lang[$language]["Home_but"]; ?></a>
				</section>
			</nav>
		</header>

	<section class="columns">
		<div class="column col-12">

	<?php
		require_once 'config.php';

		if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
			header ('location: admin.php');
		}
		else if (isset($_POST["user"]) && isset($_POST["pass"]) && $_POST["user"] === $user && $_POST["pass"] === $password) {

			session_start();//all is ok
			//save login
			$_SESSION['login'] = $_POST['user'];
			$_SESSION['pwd'] = $_POST['pass'];
			//redirect the user
			header ('location: admin.php');
		}
		else {

			if (!empty($_POST["user"]) || !empty($_POST["pass"])) {
				echo '<div class="columns"><div class="column col-4"></div>';
				echo '<div class="column col-4"><div class="msg msg-error"><p>' . $lang[$language]["Fail_connect"] . '</p></div></div></div>';
			}
			else {

			}

			echo '<form method="post" action="login.php" class="form-horizontal text-left">
					<fieldset>
						<div class="form-group">
							<div class="col-3">
								<label class="form-label" for="user">' . $lang[$language]["User"] . '</label>
							</div>
							<div class="col-9">
								<input type="text" class="form-input" id="user" name="user" placeholder="' . $lang[$language]["User"] . '" required autofocus>
							</div>
						</div>
						<div class="form-group">
							<div class="col-3">
								<label class="form-label" for="pass">' . $lang[$language]["Password"] . '</label>
							</div>
							<div class="col-9">
								<input type="password" class="form-input" id="pass" name="pass" placeholder="' . $lang[$language]["Password"] . '" required >
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-3"></div>
							<div class="col-9">
								<input type="submit" class="btn btn-primary " value="' . $lang[$language]["Connect_but"] . '">
							</div>
						</div>
					</fieldset>
				</form></section>';
		}

	?>

	</section>

	<footer>
		<?php require_once 'config.php';
			echo $lang[$language]["Powered"]; ?> <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a>
	</footer>

	<!--<script type='text/javascript' src='js/script.js'></script> -->

	</body>

</html>
