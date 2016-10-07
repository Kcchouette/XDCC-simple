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


		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/wingcss/0.1.7/wing.min.css">

		<link href="css/main.css" rel="stylesheet">

		<link href="css/admin.css" rel="stylesheet">

	</head>

	<body class="container">

		<header>
			<h1 class="text-center"><?php require_once 'config.php'; echo $lang[$language]["Login_page"]; ?></h1>

			<nav class="row">
				<div class="col-8 hidden"></div>
				<a href="index.php" class="btn btn-outline-inverted"><?php require_once 'config.php'; echo $lang[$language]["Home_but"]; ?></a>
			</nav>
		</header>

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
			
			echo '<div class="row"><div class="col-4 hidden"></div>';
			echo '<div class="col-4"><div class="msg msg-error"><p>' . $lang[$language]["Fail_connect"] . '</p></div></div></div>';
		}
		else {
			
		}
		echo '<section class="row">';
		echo '<div class="col-3 hidden"></div>';
		echo '<form method="post" action="login.php" class="col-6">
				<fieldset>
					<input type="text" name="user" placeholder="' . $lang[$language]["User"] . '" required autofocus>
					<input type="password" name="pass" placeholder="' . $lang[$language]["Password"] . '" required >
					<input type="submit" value="' . $lang[$language]["Connect_but"] . '">
				</fieldset>
			</form></section>';
	}

?>

	<footer class="text-center">
		<?php require_once 'config.php';
			echo $lang[$language]["Powered"]; ?> <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a>
	</footer>

	<!--<script type='text/javascript' src='js/script.js'></script> -->

	</body>

</html>