<?php //start before HTML code
session_start();

require_once 'config.php';
require_once 'xdcc.php';

if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
	echo '<!DOCTYPE html>
	<html lang="' . $language . '">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">

			<title>' . $title . ' - ' . $lang[$language]["Admin_page"] . '</title>

			<link href="css/main.css" rel="stylesheet">

			<link href="css/input.css" rel="stylesheet">

			<!-- OMGCSS core CSS -->
			<link href="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/css/omg.css" rel="stylesheet">

		</head>

		<body class="omgcontainer90">
			<div class="fixed730 omglowmargin">';

		echo '<header>
				<h1 class="omginline"><a class="omgtitle" href="#">' . $lang[$language]["Admin_page"] . '</a></h1>
				<a href="#" onclick="toggleMenu(\'omgmenu1\')" class="menubtn">&#9776;</a>
				<nav id="omgmenu1" class="omgmenu omginline omgpullright" style="display:none">
					<ul class="omgpullright">
						<li><a href="admin.php">' . $lang[$language]["Return_admin"] . '</a></li>
					</ul>
				</nav>
			</header>';

		if (isset($_POST["modifBookmark"])){
			require_once 'xdcc.php';
			$b = returnObject(getBookmarkList(), $_POST["modifBookmark"]);

			echo '<h2>' . $lang[$language]["Modify_bookmark_h2"] . '</h2>';
			echo '<div class="omgcenter">
					<form method="post" action="update.php">
						<input type="text" name="nameBookmark" placeholder="' . $lang[$language]["Bookmark_name"] . '" value="' . $b->getName() . '" required >
						<input type="text" name="searchBookmark" placeholder="' . $lang[$language]["Bookmark_search"] . '" value="' . $b->getStringSearch() . '" required >
						<input type="text" name="botBookmark" placeholder="' . $lang[$language]["Bookmark_bot"] . '" value="' . $b->getBotSearch() . '" >
						<input type="hidden" name="isModifBookmark" value="' . $b->getName() . '">
						<input type="submit" value="' . $lang[$language]["Modify_but"] . '">
					</form>
				</div>';
		}
		else if (isset($_POST["addBookmark"])) {
			echo '<h2>' . $lang[$language]["Add_bookmark_but"] . '</h2>';
			echo '<div class="omgcenter">
					<form method="post" action="update.php">
						<input type="text" name="nameBookmark" placeholder="' . $lang[$language]["Bookmark_name"] . '" required >
						<input type="text" name="searchBookmark" placeholder="' . $lang[$language]["Bookmark_search"] . '" required >
						<input type="text" name="botBookmark" placeholder="' . $lang[$language]["Bookmark_bot"] . '" >
						<input type="hidden" name="isCreateBookmark" value="true">
						<input type="submit" value="' . $lang[$language]["Add_but"] . '">
					</form>
				</div>';
		}
		else { //if no action
			header ('location: admin.php');
	}
}
else {
	//go to login
	header ('location: login.php');
}

?>

</div>

		<footer class="omgcenter">
		<?php
			require_once 'config.php';
			echo $lang[$language]["Powered"] . ' <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a>';
		 ?>
		</footer>

		<!-- OMGCSS small js -->
		<script src="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/js/omg.js"></script>

	</body>

</html>