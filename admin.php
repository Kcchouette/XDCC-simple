<!DOCTYPE html>
<html lang="<?php require 'config.php'; echo $lang; ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php require 'config.php'; echo $title; ?></title>

    <!-- OMGCSS core CSS -->
    <link href="https://cdn.rawgit.com/fabienwang/omgcss/gh-pages/dist/css/omg.css" rel="stylesheet">

  </head>

  <body>
    <div class="omgcontainer90 omglowerthat omgcenter">
<?php

require_once 'config.php';
require_once 'xdcc.php';
require_once 'class/Bot.php';

if (isset($_POST["user"]) && isset($_POST["pass"]) && $_POST["user"] == $user && $_POST["pass"] == $password) {

	if (isset($_POST["nameBot"]) && isset($_POST["xmlBot"]) && !isset($_POST["isModifBotname"])) {
		insertBot(new Bot($_POST["nameBot"], $_POST["xmlBot"]));
		echo '<div class="omgmsg omginfo">
            <p class="omgcenter">Bot is add : ' . $_POST["nameBot"] . '</p>
          </div>';
	}
  else if (isset($_POST["isModifBotname"])) {
		removeBot($_POST["isModifBotname"]);
    insertBot(new Bot($_POST["nameBot"], $_POST["xmlBot"]));
		echo '<div class="omgmsg omginfo">
            <p class="omgcenter">Bot is modif : ' . $_POST["isModifBotname"] . '</p>
          </div>';
	}
  else if (isset($_POST["rmBotname"])) {
		removeBot($_POST["rmBotname"]);
		echo '<div class="omgmsg omginfo">
            <p class="omgcenter">Bot is rm : ' . $_POST["rmBotname"] . '</p>
          </div>';
	}

	echo '<div class="omgcontainer90">';
      if($_POST["modifBotname"]){
        echo '<h2>Modifier un bot</h2>';
        echo '<p class="omgcenter">
    				<form method="post" action="admin.php">
    					<input type="text" name="nameBot" placeholder="Name of the bot" value="' . $_POST["modifBotname"] . '" required >
    					<input type="text" name="xmlBot" placeholder="XML of the bot" value="' . searchBotList(getBotList(), $_POST["modifBotname"]) . '" required >
    					<input type="hidden" name="user" value="' . $_POST["user"] . '">
    					<input type="hidden" name="pass" value="' . $_POST["pass"] . '">
              <input type="hidden" name="isModifBotname" value="' . $_POST["modifBotname"] . '">
    					<input type="submit" value="Modifier!">
    			</form>
    		</p>';
      }
      else {
        echo '<h2>Ajouter un bot</h2>';
        echo '<p class="omgcenter">
    				<form method="post" action="admin.php">
    					<input type="text" name="nameBot" placeholder="Name of the bot" required >
    					<input type="text" name="xmlBot" placeholder="XML of the bot" required >
    					<input type="hidden" name="user" value="' . $_POST["user"] . '">
    					<input type="hidden" name="pass" value="' . $_POST["pass"] . '">
    					<input type="submit" value="Ajouter!">
    			</form>
    		</p>';
      }
	   echo '</div>';

	  echo '<div class="omgcontainer90">
			<h2>Modifier/Supprimer un bot</h2>
			<table>';

			$bots = getBotList();
				foreach($bots as $b) {
				echo '<tr class="omgcenter">
					<td>' . $b->getName() . '</td>
					<td>' . $b->getXmlFile() . '</td>
					<td>
						<form method="post" action="admin.php">
  						<input type="hidden" name="user" value="' . $_POST["user"] . '">
  						<input type="hidden" name="pass" value="' . $_POST["pass"] . '">
  						<input type="hidden" name="modifBotname" value="' . $b->getName() . '">
  						<input type="submit" value="Modifier!">
						</form>
					</td>
          <td>
						<form method="post" action="admin.php">
  						<input type="hidden" name="user" value="' . $_POST["user"] . '">
  						<input type="hidden" name="pass" value="' . $_POST["pass"] . '">
  						<input type="hidden" name="rmBotname" value="' . $b->getName() . '">
  						<input type="submit" value="Supprimer!">
						</form>
					</td>
				</tr>';
				}

		echo '</table>';
		echo '</div>';
}
else {
    echo '
    <form method="post" action="admin.php" class="omgvertical omgcenter">
        <input type="text" name="user" placeholder="' . $lang[$language]["User"] . '" required >
        <input type="password" name="pass" placeholder="' . $lang[$language]["Password"] . '" required >
        <input type="submit" value="Connect!">
    </form>
    ';
}

?>
</div>

    <footer class="omgcenter">
    <?php
      echo $lang[$language]["Powered"] . ' <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a>';
     ?>
    </footer>

    <!-- OMGCSS small js -->
    <script src="https://cdn.rawgit.com/fabienwang/omgcss/gh-pages/dist/js/omg.js"></script>

  </body>

</html>
