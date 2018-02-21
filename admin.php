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

			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.5.1/spectre-icons.min.css">

			<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.5.1/spectre-exp.min.css">
			 -->

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
						<p>
							<a class="btn" href="index.php">' . $lang[$language]["Home_but"] . '</a>
							<a class="btn" href="logout.php">' . $lang[$language]["Disconnect_but"] . '</a>
						</p>
					</section>
				</nav>
			</header>';

		if (isset($_SESSION['message'])) {
			echo '<div class="columns">
					<div class="column col-4 col-mx-auto">' . $_SESSION["message"] . '</div>
				  </div>';
			//header("refresh: 3;");
			unset($_SESSION['message']);
		}
		echo '<div>';
			echo '<section class="columns">
					<div class="column col-4">';
				echo '<h2>' . $lang[$language]["Managing_Bot"] . '</h2>';
						require_once 'xdcc.php';
						$bots = getBotList();
					echo '<table class="table table-scroll">';
						foreach($bots as $b) {
							echo '<tr class="text-center">
								<td title="' . $b->getName() . '">' . $b->getName() . '</td>
								<td>
									<form method="post" action="adding_admin.php">
										<fieldset>
											<input type="hidden" name="modifBot" value="' . $b->getName() . '">
											<button type="submit" class="btn" title="' . $lang[$language]["Modify_but"] . '"><i class="icon icon-edit"></i></button>
										</fieldset>
									</form>
								</td>
								<td>
									<form method="post" action="update.php">
										<fieldset>
											<input type="hidden" name="export_ddl" value="' . $b->getName() . '">
											<button type="submit" class="btn" title="' . $lang[$language]["Export_csv"] . '"><i class="icon icon-download"></i></button>
										</fieldset>
									</form>
								</td>
								<td>
									<form method="post" action="update.php">
										<fieldset>
											<input type="hidden" name="rmBot" value="' . $b->getName() . '">
											<button type="submit" class="btn" title="' . $lang[$language]["Remove_but"] . '"><i class="icon icon-delete"></i></button>
										</fieldset>
									</form>
								</td>
							</tr>';
						}
					echo '</table>';
				echo '</div>';
				echo '<div class="column col-8">';
					echo '<form method="post" action="adding_admin.php">
							<fieldset>
								<input type="hidden" name="addBot" value="true">
								<input type="submit" class="btn" value="' . $lang[$language]["Add_bot_but"] . '" >
							</fieldset>
						</form>';
					echo '<form method="post" action="update.php" enctype="multipart/form-data">
							<fieldset class="import_fieldset">
								<input type="hidden" name="upload_bot_json" value="true">
								<div class="input-group">
									<input type="file" class="form-input" accept=".json" id="uploadedfile" name="uploadedfile">
									<button type="submit" class="btn input-group-btn btn-lg">' . $lang[$language]["Import_botJSON"] . '</button>
								</div>
							</fieldset>
						</form>';
					echo '<form method="post" action="update.php">
							<fieldset>
								<input type="hidden" name="exp_bot_json" value="true">
								<input type="submit" class="btn" value="' . $lang[$language]["Export_botJSON"] . '" >
							</fieldset>
						</form>';
				echo '</div>';
			echo '</section>';

			echo '<hr>';

			//BEGIN BOOKMARKS HERE
			echo '<section class="columns">
					<div class="column col-4">';
				echo '<h2>' . $lang[$language]["Managing_Bookmark"] . '</h2>';
						require_once 'xdcc.php';
						$bookmarks = getBookmarkList();
					echo '<table class="table table-scroll">';
						foreach($bookmarks as $b) {
							echo '<tr class="text-center">
								<td title="' . $b->getName() . '">' . $b->getName() . '</td>
								<td>
									<form method="post" action="adding_admin.php">
										<fieldset>
											<input type="hidden" name="modifBookmark" value="' . $b->getName() . '">
											<button type="submit" class="btn" title="' . $lang[$language]["Modify_but"] . '"><i class="icon icon-edit"></i></button>
										</fieldset>
									</form>
								</td>
								<td>
									<form method="post" action="update.php">
										<fieldset>
											<input type="hidden" name="rmBookmark" value="' . $b->getName() . '">
											<button type="submit" class="btn" title="' . $lang[$language]["Remove_but"] . '"><i class="icon icon-delete"></i></button>
										</fieldset>
									</form>
								</td>
							</tr>';
						}
					echo '</table>';
				echo '</div>';
				echo '<div class="column col-8">';
					echo '<form method="post" action="adding_admin.php">
							<fieldset>
								<input type="hidden" name="addBookmark" value="true">
								<input type="submit" class="btn" value="' . $lang[$language]["Add_bookmark_but"] . '" >
							</fieldset>
						</form>';
					echo '<form method="post" action="update.php" enctype="multipart/form-data">
							<fieldset class="import_fieldset">
								<input type="hidden" name="upload_bookmark_json" value="true">
								<div class="input-group">
									<input type="file" class="form-input" accept=".json" id="uploadedfile" name="uploadedfile">
									<input type="submit" class="btn input-group-btn btn-lg" value="' . $lang[$language]["Import_bookJSON"] . '" >
								</div>
							</fieldset>
						</form>';
					echo '<form method="post" action="update.php">
							<fieldset>
								<input type="hidden" name="exp_bookmark_json" value="true">
								<input type="submit" class="btn" value="' . $lang[$language]["Export_bookJSON"] . '" >
							</fieldset>
						</form>';
				echo '</div>';
			echo '</section>';
			//END BOOKMARKS HERE
		echo '</div>';
}
else {
	//go to login
	header ('location: login.php');
}

?>

	<footer class="text-center">
		<?php require_once 'config.php';
			echo $lang[$language]["Powered"]; ?> <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a>
	</footer>

	<!--<script type='text/javascript' src='js/script.js'></script> -->

</body>

</html>