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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.5.1/spectre.min.css">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.5.1/spectre-exp.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectre.css/0.5.1/spectre-icons.min.css"> -->

	<link rel="stylesheet" href="css/main.css">

</head>

<body class="container grid-xl">

	<header>
		<nav class="navbar">
			<section class="navbar-section">
			<?php require_once 'config.php';
				  require_once 'xdcc.php';
			//test if bot is get + if website else show main
			/* A variable is considered empty
				* if it does not exist
				* if its value equals FALSE
				* else the var exists AND has a non-empty, non-zero value.
			*/

			echo '<p>';
			if (isset($_GET["bot"])) {
				$b = returnObject(getBotList(), $_GET["bot"]);
				if ($b !== null) {
					if (!empty($b->getWebsite())) {
						echo '<a href="' . $b->getWebsite() . '" class="btn" title="' . $lang[$language]["Bot_website"] . ' ' . $b->getName() . '">' . $lang[$language]["website"] . '</a>';
					}
					echo '                  ';
					if (!empty($b->getIRC())) {
						echo '<a href="' . $b->getIRC() . '" class="btn" title="' . $lang[$language]["Bot_irc"] . ' ' . $b->getName() . '">' . $lang[$language]["IRC"] . '</a>';
					}
				}
			}
			else {
				if (!empty($website_link)) {
					echo '<a href="' . $website_link . '" class="btn" title="' . $lang[$language]["website"] . '">' . $website_label . '</a>';
				}
				if (!empty($irc_link)) {
					echo '<a href="' . $irc_link . '" class="btn" title="' . $lang[$language]["IRC"] . '">'. $irc_label . '</a>';
				}
			}

			echo '</p>';

			?>
		</section>

		<section class="navbar-center">
			<h1><?php require_once 'config.php'; echo $title; ?></h1>
		</section>

		<section class="navbar-section">
			<form name="searchform">
				<fieldset class="input-group input-inline">
					<input type="text" name="search" class="form-input"  placeholder="<?php require_once 'config.php'; echo $lang[$language]["Search_on"]; ?>"  <?php if(!empty($_GET["search"])) echo 'value="' . $_GET["search"] . '"';?> required/>
					<select name="bot" class="form-select">
						<option value=""><?php require_once 'config.php'; echo $lang[$language]["ALL_BOTS"]; ?></option>
						<?php require_once 'xdcc.php';
						$bots = getBotList();
						foreach($bots as &$bot) {
							if (!empty($_GET["bot"]) && $bot->getName() === $_GET["bot"])
								echo '<option value="' . $bot->getName() . '" selected>' . $bot->getName() . '</option>';
							else
								echo '<option value="' . $bot->getName() . '">' . $bot->getName() . '</option>';
						}
						?>
					</select>
					<input type="submit" class="btn btn-primary input-group-btn" value="Search"/>
				</fieldset>
			</form>
		</section>
		</nav>
	</header>

	<section class="columns">
		<div class="column col-3 col-md-12">
			<div class="panel">
				<div class="panel-header">
					<h2 class="panel-title"><?php require_once 'config.php'; echo $lang[$language]["Bots"]; ?></h2>
					<?php require_once 'xdcc.php';
					$bots = getBotList();
					echo '<ul class="panel-body">';
					foreach($bots as &$bot) {
						echo '<li class="tile tile-centered"><a class="tile-content" href="?bot=' . $bot->getName() . '" title="' . $bot->getName() . '"><div class="tile-title">' . $bot->getName() . '</div></a></li>';
					}
					echo '</ul>'
					?>
				</div>
			</div>
			<?php require_once 'config.php';
			if ($bookmark) {
				echo '<div class="panel">
					<div class="panel-header">
					<h2 class="panel-title">' . $lang[$language]["Bookmarks"] . '</h2>';
					require_once 'xdcc.php';
					$bookmarks = getBookmarkList();
					echo '<ul class="panel-body">';
					foreach($bookmarks as &$b) {
						echo '<li class="tile tile-centered"><a class="tile-content" href="?search=' . $b->getStringSearch() . '&amp;bot=' . $b->getBotSearch() . '" title="' . $b->getName() . '"><div class="tile-title">' . $b->getName() . '</div></a></li>';
					}
						echo '</ul>
						</div>
						</div>';
				}
				?>
		</div>

		<div class="column col-8 col-md-12 col-ml-auto">
		<h2><?php require_once 'config.php'; if(!empty($_GET["bot"])) echo ' &#8212; ' . $lang[$language]["Bot:"] . ' <code>' . htmlspecialchars($_GET["bot"]) . '</code>';// . ' <a href="syndication.php?bot=' . $_GET["bot"] . '"> <img class="icon" src="img/Feed_icon.svg"></a> '; if(isset($_GET["search"])) echo ' &#8212; ' . $lang[$language]["Search:"] . ' <code>' . htmlspecialchars($_GET["search"]) . '</code>'; ?></h2>
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

				echo '<table class="table" id="filelist">';


				$xml = haveXMLfile(searchBotXMLFile(getBotList(), $_GET["bot"]));

				if (!$xml || !$xml->packlist->pack)
					echo '<thead><tr id="trmain"><th>' . $lang[$language]["Fail_load_XML"] . '</th></tr><thead>';
				else {
					echo '<thead><tr id="trmain">';
					echo '<th class="text-center">' . $lang[$language]["Pack"] . '</th>';
					echo '<th class="text-center">' . $lang[$language]["Size"] . '</th>';
					echo '<th class="text-center">' . $lang[$language]["File"] . '</th>';
					echo '</tr><thead>';

					echo searchBotList($xml, $_GET["bot"], empty($_GET["search"]) ? null : $_GET["search"]);

				}
				echo '</table>';
			}
			?>
			</div>
		</div>
	</section>

	<footer class="text-center">
	<?php require_once 'config.php';
		echo $lang[$language]["Powered"]; ?> <a href="https://github.com/Kcchouette/XDCC-simple"> XDCC Simple</a> &#8212; <a href="admin.php"><?php require_once 'config.php';
		echo $lang[$language]["Admin_page"]; ?></a>
	</footer>

<script type="text/javascript">
function paste(bot, pack){
	<?php
	require_once 'config.php';
	echo 'window.prompt("' . $lang[$language]["Paste_windows"] . '", "/msg " + bot + " xdcc send #" + pack);';
	?>
}
</script>

<!--<script type='text/javascript' src='js/script.js'></script> -->

</body>

</html>