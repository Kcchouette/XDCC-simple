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
			<!--<meta name="author" content="">-->

			<title>' . $title . ' - ' . $lang[$language]["Admin_page"] . '</title>

			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/wingcss/0.1.7/wing.min.css">

			<link href="css/main.css" rel="stylesheet">
			<link href="css/admin.css" rel="stylesheet">

		</head>

		<body class="container">';

		echo '<header>
					<h1 class="text-center">' . $lang[$language]["Admin_page"] . '</h1>
					<nav class="row">
						<div class="col-8 hidden"></div>
						<a href="admin.php" class="btn btn-outline-inverted">' . $lang[$language]["Return_admin"] . '</a>
					</nav>
				</header>';

		if (isset($_POST["modifBot"])){
			require_once 'xdcc.php';
			$b = returnObject(getBotList(), $_POST["modifBot"]);

			echo '<h2>' . $lang[$language]["Modify_bot_h2"] . '</h2>';
			echo '<div class="text-center">
					<form method="post" action="update.php">
						<fieldset class="row">
							<div class="col-2"><input type="text" name="nameBot" placeholder="' . $lang[$language]["Bot_name"] . '" value="' . $b->getName() . '" required ></div>
							<div class="col-2"><input type="text" name="xmlBot" placeholder="' . $lang[$language]["Bot_xml"] . '" value="' . $b->getXmlFile() . '" required ></div>
							<div class="col-3"><input type="url" name="websiteBot" placeholder="' . $lang[$language]["Bot_website"] . '" value="' . $b->getWebsite() . '" ></div>
							<div class="col-3"><input type="url" name="ircBot" placeholder="' . $lang[$language]["Bot_irc"] . '" value="' . $b->getIRC() . '" ></div>
							<div class="col-1"><input type="hidden" name="isModifBot" value="' . $b->getName() . '"></div>
							<div class="col-1"><input type="submit" value="' . $lang[$language]["Modify_but"] . '"></div>
						</fieldset>
					</form>
				</div>';
		}
		else if (isset($_POST["addBot"])) {
			echo '<h2>' . $lang[$language]["Add_bot_but"] . '</h2>';
			echo '<div class="text-center">
					<form method="post" action="update.php">
						<fieldset class="row">
							<div class="col-2"><input type="text" name="nameBot" placeholder="' . $lang[$language]["Bot_name"] . '" required ></div>
							<div class="col-2"><input type="text" name="xmlBot" placeholder="' . $lang[$language]["Bot_xml"] . '" required ></div>
							<div class="col-3"><input type="url" name="websiteBot" placeholder="' . $lang[$language]["Bot_website"] . '" ></div>
							<div class="col-3"><input type="url" name="ircBot" placeholder="' . $lang[$language]["Bot_irc"] . '" ></div>
							<div class="col-1"><input type="hidden" name="isCreateBot" value="true"></div>
							<div class="col-1"><input type="submit" value="' . $lang[$language]["Add_but"] . '"></div>
						</fieldset>
					</form>
				</div>';
		}
		else if (isset($_POST["modifBookmark"])){
			require_once 'xdcc.php';
			$b = returnObject(getBookmarkList(), $_POST["modifBookmark"]);

			echo '<h2>' . $lang[$language]["Modify_bookmark_h2"] . '</h2>';
			echo '<div class="text-center">
					<form method="post" action="update.php">
						<fieldset class="row">
							<div class="col-3"><input type="text" name="nameBookmark" placeholder="' . $lang[$language]["Bookmark_name"] . '" value="' . $b->getName() . '" required ></div>
							<div class="col-3"><input type="text" name="searchBookmark" placeholder="' . $lang[$language]["Bookmark_search"] . '" value="' . $b->getStringSearch() . '" required ></div>
							<div class="col-3"><input type="text" name="botBookmark" placeholder="' . $lang[$language]["Bookmark_bot"] . '" value="' . $b->getBotSearch() . '" ></div>
							<input type="hidden" name="isModifBookmark" value="' . $b->getName() . '">
							<div class="col-3"><input type="submit" value="' . $lang[$language]["Modify_but"] . '"></div>
						</fieldset>
					</form>
				</div>';
		}
		else if (isset($_POST["addBookmark"])) {
			echo '<h2>' . $lang[$language]["Add_bookmark_but"] . '</h2>';
			echo '<div class="text-center">
					<form method="post" action="update.php">
						<fieldset class="row">
							<div class="col-3"><input type="text" name="nameBookmark" placeholder="' . $lang[$language]["Bookmark_name"] . '" required ></div>
							<div class="col-3"><input type="text" name="searchBookmark" placeholder="' . $lang[$language]["Bookmark_search"] . '" required ></div>
							<div class="col-3"><input type="text" name="botBookmark" placeholder="' . $lang[$language]["Bookmark_bot"] . '" ></div>
							<input type="hidden" name="isCreateBookmark" value="true">
							<div class="col-3"><input type="submit" value="' . $lang[$language]["Add_but"] . '"></div>
						</fieldset>
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

	<footer class="text-center">
	<?php
		require_once 'config.php';
		echo $lang[$language]["Powered"] . ' <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a>';
	?>
	</footer>

	<!--<script type='text/javascript' src='js/script.js'></script> -->

</body>

</html>