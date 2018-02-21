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

			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.5.1/spectre.min.css">
			<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.5.1/spectre-exp.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.5.1/spectre-icons.min.css"> -->

			<link href="css/main.css" rel="stylesheet">
			<!--<link href="css/admin.css" rel="stylesheet">-->

		</head>

		<body class="container grid-lg">';

		echo '<header>
				<nav class="navbar">
					<section class="navbar-section">
					</section>
					<section class="navbar-section navbar-center">
						<h1 class="text-center">' . $lang[$language]["Admin_page"] . '</h1>
					</section>
					<section class="navbar-section">
						<a class="btn" href="admin.php">' . $lang[$language]["Return_admin"] . '</a>
					</section>
				</nav>
			</header>';

		if (isset($_POST["modifBot"])){
			require_once 'xdcc.php';
			$b = returnObject(getBotList(), $_POST["modifBot"]);

			echo '<h2>' . $lang[$language]["Modify_bot"] . '</h2>';
			echo '<form method="post" action="update.php">
					<fieldset class="">
						<div class="form-group">
							<label class="form-label" for="nameBot">' . $lang[$language]["Bot_name"] . '</label>
							<input type="text" class="form-input" id="nameBot" name="nameBot" placeholder="' . $lang[$language]["Bot_name"] . '" value="' . $b->getName() . '" required >
						</div>
						<div class="form-group">
							<label class="form-label" for="xmlBot">' . $lang[$language]["Bot_xml"] . '</label>
							<input type="text" class="form-input" id="xmlBot" name="xmlBot" placeholder="' . $lang[$language]["Bot_xml"] . '" value="' . $b->getXmlFile() . '" required >
						</div>
						<div class="form-group">
							<label class="form-label" for="websiteBot">' . $lang[$language]["Bot_website"] . '</label>
							<input type="url" class="form-input" id="websiteBot" name="websiteBot" placeholder="' . $lang[$language]["Bot_website"] . '" value="' . $b->getWebsite() . '" >
						</div>
						<div class="form-group">
							<label class="form-label" for="ircBot">' . $lang[$language]["Bot_irc"] . '</label>
							<input type="url" class="form-input" id="ircBot" name="ircBot" placeholder="' . $lang[$language]["Bot_irc"] . '" value="' . $b->getIRC() . '" >
						</div>
						<input type="hidden" name="isModifBot" value="' . $b->getName() . '">
						<input type="submit" class="btn btn-primary" value="' . $lang[$language]["Modify_but"] . '">
					</fieldset>
				</form>';
		}
		else if (isset($_POST["addBot"])) {
			echo '<h2>' . $lang[$language]["Add_bot_but"] . '</h2>';
			echo '<form method="post" action="update.php">
					<fieldset class="">
						<div class="form-group">
							<label class="form-label" for="nameBot">' . $lang[$language]["Bot_name"] . '</label>
							<input type="text" class="form-input" id="nameBot" name="nameBot" placeholder="' . $lang[$language]["Bot_name"] . '" required >
						</div>
						<div class="form-group">
							<label class="form-label" for="xmlBot">' . $lang[$language]["Bot_xml"] . '</label>
							<input type="text" class="form-input" id="xmlBot" name="xmlBot" placeholder="' . $lang[$language]["Bot_xml"] . '" required >
						</div>
						<div class="form-group">
							<label class="form-label" for="websiteBot">' . $lang[$language]["Bot_website"] . '</label>
							<input type="url" class="form-input" id="websiteBot" name="websiteBot" placeholder="' . $lang[$language]["Bot_website"] . '" >
						</div>
						<div class="form-group">
							<label class="form-label" for="ircBot">' . $lang[$language]["Bot_irc"] . '</label>
							<input type="url" class="form-input" id="ircBot" name="ircBot" placeholder="' . $lang[$language]["Bot_irc"] . '" >
						</div>
						<input type="hidden" name="isCreateBot" value="true">
						<input type="submit" class="btn btn-primary" value="' . $lang[$language]["Add_but"] . '">
					</fieldset>
				</form>';
		}
		else if (isset($_POST["modifBookmark"])){
			require_once 'xdcc.php';
			$b = returnObject(getBookmarkList(), $_POST["modifBookmark"]);

			echo '<h2>' . $lang[$language]["Modify_bookmark"] . '</h2>';
			echo '<form method="post" action="update.php">
					<fieldset class="">
						<div class="form-group">
							<label class="form-label" for="nameBookmark">' . $lang[$language]["Bookmark_name"] . '</label>
							<input type="text" id="nameBookmark" name="nameBookmark" placeholder="' . $lang[$language]["Bookmark_name"] . '" value="' . $b->getName() . '" required >
						</div>
						<div class="form-group">
							<label class="form-label" for="searchBookmark">' . $lang[$language]["Bookmark_search"] . '</label>
							<input type="text" id="searchBookmark" name="searchBookmark" placeholder="' . $lang[$language]["Bookmark_search"] . '" value="' . $b->getStringSearch() . '" required >
						</div>
						<div class="form-group">
							<label class="form-label" for="botBookmark">' . $lang[$language]["Bookmark_bot"] . '</label>
							<input type="text" id="botBookmark" name="botBookmark" placeholder="' . $lang[$language]["Bookmark_bot"] . '" value="' . $b->getBotSearch() . '" >
						</div>
						<input type="hidden" name="isModifBookmark" value="' . $b->getName() . '">
						<input type="submit" class="btn btn-primary" value="' . $lang[$language]["Modify_but"] . '"></div>
					</fieldset>
				</form>';
		}
		else if (isset($_POST["addBookmark"])) {
			echo '<h2>' . $lang[$language]["Add_bookmark_but"] . '</h2>';
			echo '<form method="post" action="update.php">
					<fieldset class="">
						<div class="form-group">
							<label class="form-label" for="nameBookmark">' . $lang[$language]["Bookmark_name"] . '</label>
							<input type="text" name="nameBookmark" placeholder="' . $lang[$language]["Bookmark_name"] . '" required >
						</div>
						<div class="form-group">
							<label class="form-label" for="searchBookmark">' . $lang[$language]["Bookmark_search"] . '</label>
							<input type="text" name="searchBookmark" placeholder="' . $lang[$language]["Bookmark_search"] . '" required >
						</div>
						<div class="form-group">
							<label class="form-label" for="botBookmark">' . $lang[$language]["Bookmark_bot"] . '</label>
							<input type="text" name="botBookmark" placeholder="' . $lang[$language]["Bookmark_bot"] . '" >
						</div>
						<input type="hidden" name="isCreateBookmark" value="true">
						<input type="submit" value="' . $lang[$language]["Add_but"] . '">
					</fieldset>
				</form>';
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