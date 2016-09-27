<?php //start before DOCTYPE
session_start();
?>

<!DOCTYPE html>
<html lang="<?php require 'config.php'; echo $lang; ?>">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<?php echo '<title>' . $title . ' - ' . $lang[$language]["Login_page"] . '</title>'; ?>

		<link href="css/input.css" rel="stylesheet">

		<!-- OMGCSS core CSS -->
		<link href="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/css/omg.css" rel="stylesheet">

	</head>

	<body>
		<div class="fixed730 omglowmargin">
<?php

require_once 'config.php';
require_once 'xdcc.php';

echo '<header>
		<h1 class="omginline"><a class="omgtitle" href="#">' . $lang[$language]["Login_page"] . '</a></h1>
		<a href="#" onclick="toggleMenu(\'omgmenu1\')" class="menubtn">&#9776;</a>
		<nav id="omgmenu1" class="omgmenu omginline omgpullright" style="display:none">
			<ul>
				<li><a class="omgbtn" href="index.php">' . $lang[$language]["Home_but"] . '</a></li>
			</ul>
		</nav>
	</header>';

	if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
		header ('location: admin.php');
	}
	else if (isset($_POST["user"]) && isset($_POST["pass"]) && $_POST["user"] == $user && $_POST["pass"] == $password) {

		session_start();//all is ok
		//save login
		$_SESSION['login'] = $_POST['user'];
		$_SESSION['pwd'] = $_POST['pass'];
		//redirect the user
		header ('location: admin.php');
	}
	else {
		echo '
			<form method="post" action="login.php" class="omgvertical omgcenter">
					<input type="text" name="user" placeholder="' . $lang[$language]["User"] . '" required autofocus>
					<input type="password" name="pass" placeholder="' . $lang[$language]["Password"] . '" required >
					<input type="submit" value="' . $lang[$language]["Connect_but"] . '">
			</form>';
	}

?>
</div>

	<footer class="omgcenter">
	<?php
		echo $lang[$language]["Powered"] . ' <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a>';
	 ?>
	</footer>

	<!-- OMGCSS small js -->
	<script src="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/js/omg.js"></script>

	</body>

</html>