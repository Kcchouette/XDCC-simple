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
						<div class="col-4"><a class="btn btn-outline-inverted hidden" href="index.php">' . $lang[$language]["Home_but"] . '</a>
						<a class="btn btn-outline-inverted" href="logout.php">' . $lang[$language]["Disconnect_but"] . '</a></div>
					</nav>
				</header>';

		if (isset($_SESSION['message'])) {
			echo '<div class="row">
					<div class="col-4 hidden"></div>
					<div class="col-4">' . $_SESSION["message"] . '</div>
				  </div>';
			//header("refresh: 3;");
			unset($_SESSION['message']);
		}
		echo '<div>';
			echo '<section class="row">
					<div class="col-4">
						<div class="border_1">';
					echo '<h2>' . $lang[$language]["Modify_Remove_Bot_h2"] . '</h2>';
							require_once 'xdcc.php';
							$bots = getBotList();
						echo '<table>';
							foreach($bots as $b) {
								echo '<tr class="text-center">
									<td title="' . $b->getName() . '">' . substr($b->getName(), 0, 16) . '</td>
									<td>
										<form method="post" action="adding_admin.php">
											<fieldset>
												<input type="hidden" name="modifBot" value="' . $b->getName() . '">
												<input type="image" class="icon" src="img/Edit_icon.svg" title="' . $lang[$language]["Modify_but"] . '" alt="' . $lang[$language]["Modify_but"] . '">
											</fieldset>
										</form>
									</td>
									<td>
										<form method="post" action="update.php">
											<fieldset>
												<input type="hidden" name="export_ddl" value="' . $b->getName() . '">
												<input type="image" class="icon" src="img/CSV_file.svg" title="' . $lang[$language]["Export_csv"] . '" alt="' . $lang[$language]["Export_csv"] . '">
											</fieldset>
										</form>
									</td>
									<td>
										<form method="post" action="update.php">
											<fieldset>
												<input type="hidden" name="rmBot" value="' . $b->getName() . '">
												<input type="image" class="icon" src="img/Remove_icon.svg" title="' . $lang[$language]["Remove_but"] . '" alt="' . $lang[$language]["Remove_but"] . '">
											</fieldset>
										</form>
									</td>
								</tr>';
							}
						echo '</table>';
					echo '</div>';
				echo '</div>';
				echo '<div class="col-8">';
					echo '<form method="post" action="adding_admin.php">
							<fieldset>
								<input type="hidden" name="addBot" value="true">
								<input type="submit" class="button_add" value="' . $lang[$language]["Add_bot_but"] . '" >
							</fieldset>
						</form>';
					echo '<form method="post" action="update.php" enctype="multipart/form-data">
							<fieldset class="import_fieldset">
								<input type="hidden" name="upload_bot_json" value="true">
								<input type="file" accept=".json" id="uploadedfile" name="uploadedfile">
								<input type="submit" class="button_import" value="' . $lang[$language]["Import_botJSON"] . '" >
							</fieldset>
						</form>';
					echo '<form method="post" action="update.php">
							<fieldset>
								<input type="hidden" name="exp_bot_json" value="true">
								<input type="submit" class="button_export" value="' . $lang[$language]["Export_botJSON"] . '" >
							</fieldset>
						</form>';
				echo '</div>';
			echo '</section>';

			echo '<hr>';

			//BEGIN BOOKMARKS HERE
			echo '<section class="row">
					<div class="col-4">
						<div class="border_1">';
					echo '<h2>' . $lang[$language]["Modify_Remove_Bookmark_h2"] . '</h2>';
							require_once 'xdcc.php';
							$bookmarks = getBookmarkList();
						echo '<table>';
							foreach($bookmarks as $b) {
								echo '<tr class="text-center">
									<td title="' . $b->getName() . '">' . substr($b->getName(), 0, 16) . '</td>
									<td>
										<form method="post" action="adding_admin.php">
											<fieldset>
												<input type="hidden" name="modifBookmark" value="' . $b->getName() . '">
												<input type="image" class="icon" src="img/Edit_icon.svg" title="' . $lang[$language]["Modify_but"] . '" alt="' . $lang[$language]["Modify_but"] . '">
											</fieldset>
										</form>
									</td>
									<td>
										<form method="post" action="update.php">
											<fieldset>
												<input type="hidden" name="rmBookmark" value="' . $b->getName() . '">
												<input type="image" class="icon" src="img/Remove_icon.svg" title="' . $lang[$language]["Remove_but"] . '" alt="' . $lang[$language]["Remove_but"] . '">
											</fieldset>
										</form>
									</td>
								</tr>';
							}
						echo '</table>';
					echo '</div>';
				echo '</div>';
				echo '<div class="col-8">';
					echo '<form method="post" action="adding_admin.php">
							<fieldset>
								<input type="hidden" name="addBookmark" value="true">
								<input type="submit" class="button_add" value="' . $lang[$language]["Add_bookmark_but"] . '" >
							</fieldset>
						</form>';
					echo '<form method="post" action="update.php" enctype="multipart/form-data">
							<fieldset class="import_fieldset">
								<input type="hidden" name="upload_bookmark_json" value="true">
								<input type="file" accept=".json" id="uploadedfile" name="uploadedfile">
								<input type="submit" class="button_import" value="' . $lang[$language]["Import_bookJSON"] . '" >
							</fieldset>
						</form>';
					echo '<form method="post" action="update.php">
							<fieldset>
								<input type="hidden" name="exp_bookmark_json" value="true">
								<input type="submit" class="button_export" value="' . $lang[$language]["Export_bookJSON"] . '" >
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