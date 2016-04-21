<!DOCTYPE html>
<html lang="<?php require 'config.php'; echo $lang; ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php require 'config.php'; echo $title; ?></title>

	<link href="main.css" rel="stylesheet">

    <!-- OMGCSS core CSS -->
    <link href="https://fabienwang.github.io/omgcss/dist/css/omg.css" rel="stylesheet">

  </head>

  <body>

	<center><h1><?php require_once 'config.php'; echo $title; ?></h1></center>

    <section class="omgcontainer90 omggrid omg3columns">
      <div class="omgblock">
        <div class="omgborder">
			<h3>Bots</h3>
			<p>
			<?php require_once 'xdcc.php';
			$bots = getBotList();
			foreach($bots as &$bot) {
				echo '<a href="?bot=' . $bot->getName() . '">' . $bot->getName() . '</a><br>';
			}
			?>
			</p>
		</div>
		<?php
		require_once 'config.php';
		if ($bookmark) {
			echo "
			<h3>Bookmarks</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget volutpat nibh, ac pellentesque sem. Integer aliquet nunc at commodo tincidunt.</p>
			";
		}
		?>
      </div>
      <div class="omgblock omgblockof2">
        <h3>Bot: <?php echo htmlspecialchars($_GET["bot"]); ?></h3>
        <p><div class="omgcenter"><?php
		if (!isset($_GET["bot"]))
		{
			require_once 'config.php';
			echo $lang[$language]["choose_bot"];
		}
		else
		{
			require_once 'xdcc.php';

			echo '<table>';

    $xml=simplexml_load_file(searchBotList(getBotList(), $_GET["bot"]));

    print_r($xml);

			if (!$xml->packlist->pack)
				echo '<tr>Fail to load XML file, or the XML file is empty</tr>';
			else {
				echo '<tr id="trmain">';
					echo '<th>' . $lang[$language]["Pack"] . '</th>';
					echo '<th>' . $lang[$language]["File"] . '</th>';
					echo '<th>' . $lang[$language]["Size"] . '</th>';
					echo '<th>' . $lang[$language]["Downloads"] . '</th>';
				echo '</tr>';

				foreach($xml->packlist->pack as $p) {
				echo '<tr>';
					echo '<td>' . $p->packnr . '</td>';
					echo '<td>';
					echo '<a href="#" onclick="javascript:paste(\'' . $_GET["bot"] . '\', ' . $p->packnr . ');" title="' . $p->packname . '" >' . $p->packname . '</a>';
					echo '</td>';
					echo '<td>' . $p->packsize . '</td>';
					echo '<td>' . $p->packgets . '</td>';
				echo '</tr>';
				}

				}

			echo '</table>';
			}
		?>
		</div></p>
      </div>
    </section>

    <footer class="omgcenter">
      Powered by <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a>
    </footer>

	<script type="text/javascript">
		function paste(bot, pack){
		<?php
			echo 'window.prompt("' . $lang[$language]["Paste_windows"] . '", "/msg " + bot + " xdcc send #" + pack);';
		?>
		}
	</script>

	<!--<script src="script.js"></script>-->

    <!-- OMGCSS small js -->
    <script src="https://fabienwang.github.io/omgcss/dist/js/omg.js"></script>

  </body>

</html>
