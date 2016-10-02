<!DOCTYPE html>
<html lang="<?php require_once 'config.php'; echo $language; ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php require_once 'config.php'; echo $description; ?>">
	<!-- <meta name="author" content=""> -->
	<?php require_once 'config.php';
	if($can_track) {
		echo '<meta name="robots" content="index, follow">';
	}
	else {
		echo '<meta name="robots" content="noindex, nofollow, noarchive">';
	}
	?>

	<title><?php require_once 'config.php'; echo $title; ?></title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/wing/0.1.7/wing.min.css">

	<link href="css/button.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">

</head>

<body class="container">

	<h1 class="text-center"><?php require_once 'config.php'; echo $title; ?></h1>

	<section>
		<nav id="menu1" class="row">
			<div class="col-6">
			<?php require_once 'config.php';
				  require_once 'xdcc.php';
			//test if bot is get + if website else show main
			/* A variable is considered empty
				* if it does not exist
				* if its value equals FALSE
				* else the var exists AND has a non-empty, non-zero value.
			*/
			if (isset($_GET["bot"]) && !empty(returnBotWebsite(getBotList(), $_GET["bot"]))) {
				echo '<a href="' . returnBotWebsite(getBotList(), $_GET["bot"]) . '" class="omgbtn"><button class="btn btn-outline-inverted">' . $_GET["bot"] . ' ' . $lang[$language]["website"] . '</button></a>';
			}
			else if (!isset($_GET["bot"]) && !empty($website_link)) {
				echo '<a href="' . $website_link . '" class=""><button class="btn btn-outline-inverted">' . $website_label . '</button></a>';
			}

			if (isset($_GET["bot"]) && !empty(returnBotIRC(getBotList(), $_GET["bot"]))) {
				echo '<a href="' . returnBotIRC(getBotList(), $_GET["bot"]) . '" class=""><button class="btn btn-outline-inverted">' . $_GET["bot"] . ' ' . $lang[$language]["IRC"] . '</button></a>';
			}
			else if (!isset($_GET["bot"]) && !empty($irc_link)) {
				echo '<a href="' . $irc_link . '" class=""><button class="btn btn-outline-inverted">'. $irc_label . '</button></a>';
			}
			?>
			<!--</ul>(>--></div>
			<form name="searchform" class="col-6">
				<fieldset class="row">
					<input type="text" name="search" class="col-4" placeholder="<?php require_once 'config.php'; echo $lang[$language]["Search_on"]; ?>"  <?php if(!empty($_GET["search"])) echo 'value="' . $_GET["search"] . '"';?> required/>
					<select name="bot" class="col-4">
						<option value=""><?php require_once 'config.php'; echo $lang[$language]["ALL_BOTS"]; ?></option>
						<?php require_once 'xdcc.php';
						$bots = getBotList();
						foreach($bots as &$bot) {
							if ($bot->getName() === $_GET["bot"])
								echo '<option value="' . $bot->getName() . '" selected>' . $bot->getName() . '</option>';
							else
								echo '<option value="' . $bot->getName() . '">' . $bot->getName() . '</option>';
						}
						?>
					</select>
					<div class="col-4"><input type="submit" value="Search"/></div>
				</fieldset>
			</form>
		</nav>
	</section>

	<section class="row">
		<div class="col-3">
			<div class="border_1">
				<h2><?php require_once 'config.php'; echo $lang[$language]["Bots"]; ?></h2>
				<p>
				<?php require_once 'xdcc.php';
				$bots = getBotList();
				foreach($bots as &$bot) {
					echo '<a class="chbot" href="?bot=' . $bot->getName() . '">' . $bot->getName() . '</a><br>';
				}
				?>
				</p>
				<?php require_once 'config.php';
				if ($bookmark) {
					echo '<hr>
						<h2>' . $lang[$language]["Bookmarks"] . '</h2>';
						echo '<p>';
						require_once 'xdcc.php';
						$bookmarks = getBookmarkList();
						foreach($bookmarks as &$b) {
							echo '<a class="chbot" href="?search=' . $b->getStringSearch() . '&bot=' . $b->getBotSearch() . '">' . $b->getName() . '</a><br>';
						}
						echo '<p>';
				}
				?>
			</div>
			
		</div>

		<div class="col-1"></div>
		<div class="col-8">
		<h2><?php require_once 'config.php'; if(!empty($_GET["bot"])) echo ' &#8212; ' . $lang[$language]["Bot:"] . ' <code>' . htmlspecialchars($_GET["bot"]) . '</code>' . ' <a href="syndication.php?bot=' . $_GET["bot"] . '"> <img class="icon" src="img/Feed-icon.svg"></a> '; if(isset($_GET["search"])) echo ' &#8212; ' . $lang[$language]["Search:"] . ' <code>' . htmlspecialchars($_GET["search"]) . '</code>'; ?></h2>
			<div><?php

			require_once 'config.php';

			if (!isset($_GET["bot"]) && !isset($_GET["search"])) { //if none set, show an error
				echo '<div class="">' . $lang[$language]["choose_bot"] . '</div>';
			}
			else if (empty($_GET["bot"])) { //if bot is empty, search in all bot
				echo searchBotsList($_GET["search"]);
			}
			else { //if bot, show all the list OR show the search on a bot
				require_once 'xdcc.php';

				echo '<table class="" id="filelist">';

				
				$xml = haveXMLfile(searchBotXMLFile(getBotList(), $_GET["bot"]));

				if (!$xml || !$xml->packlist->pack)
					echo '<tr id="trmain"><th>' . $lang[$language]["Fail_load_XML"] . '</th></tr>';
				else {
					echo '<tr id="trmain">';
					echo '<th class="text-center">' . $lang[$language]["Pack"] . '</th>';
					echo '<th class="text-center">' . $lang[$language]["Size"] . '</th>';
					echo '<th >' . $lang[$language]["File"] . '</th>';
					echo '</tr>';

					if (!empty($_GET["search"]))
						echo searchBotList($xml, $_GET["bot"], $_GET["search"]);
					else
						echo showBotList($xml, $_GET["bot"]);
				}
				echo '</table>';
			}
			?>
			</div>
		</div>
	</section>

	<footer class="text-center">
	<?php
	require_once 'config.php';
		echo $lang[$language]["Powered"] . ' <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a> &#8212; <a href="admin.php">' . $lang[$language]["Admin_page"] . '</a>';
	 ?>
	</footer>

<script type="text/javascript">
function paste(bot, pack){
	<?php
	require_once 'config.php';
	echo 'window.prompt("' . $lang[$language]["Paste_windows"] . '", "/msg " + bot + " xdcc send #" + pack);';
	?>
}
</script>

<!--<script type='text/javascript' src='js/script.js'></script>

 OMGCSS small js 
<script src="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/js/omg.js"></script>-->

</body>

</html>