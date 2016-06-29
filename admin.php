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
    <div class="fixed730 omglowmargin">
<?php

require_once 'config.php';
require_once 'xdcc.php';

echo '<header>
      <h1 class="omginline"><a class="omgtitle" href="#">' . $lang[$language]["Admin_page"] . '</a></h1>
      <a href="#" onclick="toggleMenu(\'omgmenu1\')" class="menubtn">&#9776;</a>
      <nav id="omgmenu1" class="omgmenu omginline omgpullright" style="display:none">
        <ul>
          <li><a class="omgbtn" href="index.php">' . $lang[$language]["Home_but"] . '</a></li>';
          if (isset($_POST["user"]) && isset($_POST["pass"]) && $_POST["user"] == $user && $_POST["pass"] == $password) {
            echo '<li><a class="omgbtn" href="admin.php">' . $lang[$language]["Disconnect_but"] . '</a></li>';
          }

        echo '</ul>
      </nav>
    </header>';

if (isset($_POST["user"]) && isset($_POST["pass"]) && $_POST["user"] == $user && $_POST["pass"] == $password) {

	if (isset($_POST["nameBot"]) && isset($_POST["xmlBot"]) && !isset($_POST["isModifBotname"])) {
		insertBot(new Bot($_POST["nameBot"], $_POST["xmlBot"]));
		echo '<div class="omgmsg omginfo">
            <p class="omgcenter">' . $_POST["nameBot"] . ' ' . $lang[$language]["bot_add"] . '</p>
          </div>';
	}
  else if (isset($_POST["isModifBotname"])) {
		removeBot($_POST["isModifBotname"]);
    insertBot(new Bot($_POST["nameBot"], $_POST["xmlBot"]));
		echo '<div class="omgmsg omginfo">
            <p class="omgcenter">' . $_POST["isModifBotname"] . ' ' . $lang[$language]["bot_modify"] . '</p>
          </div>';
	}
  else if (isset($_POST["rmBotname"])) {
		removeBot($_POST["rmBotname"]);
		echo '<div class="omgmsg omginfo">
            <p class="omgcenter">' . $_POST["rmBotname"] . ' ' . $lang[$language]["bot_remove"] . '</p>
          </div>';
	}

	echo '<div class="omgcontainer90">';
      if($_POST["modifBotname"]){
        echo '<h2>' . $lang[$language]["Modify_h2"] . '</h2>';
        echo '<div class="omgcenter">
    				<form method="post" action="admin.php">
    					<input type="text" name="nameBot" placeholder="' . $lang[$language]["Bot_name"] . '" value="' . $_POST["modifBotname"] . '" required >
    					<input type="text" name="xmlBot" placeholder="' . $lang[$language]["Bot_xml"] . '" value="' . searchBotList(getBotList(), $_POST["modifBotname"]) . '" required >
    					<input type="hidden" name="user" value="' . $_POST["user"] . '">
    					<input type="hidden" name="pass" value="' . $_POST["pass"] . '">
              <input type="hidden" name="isModifBotname" value="' . $_POST["modifBotname"] . '">
    					<input type="submit" value="' . $lang[$language]["Modify_but"] . '">
    			</form>
    		</div>';
      }
      else {
        echo '<h2>' . $lang[$language]["Add_h2"] . '</h2>';
        echo '<div class="omgcenter">
    				<form method="post" action="admin.php">
    					<input type="text" name="nameBot" placeholder="' . $lang[$language]["Bot_name"] . '" required >
    					<input type="text" name="xmlBot" placeholder="' . $lang[$language]["Bot_xml"] . '" required >
    					<input type="hidden" name="user" value="' . $_POST["user"] . '">
    					<input type="hidden" name="pass" value="' . $_POST["pass"] . '">
    					<input type="submit" value="' . $lang[$language]["Add_but"] . '">
    			</form>
    		</div>';
      }
	   echo '</div>';

	  echo '<div class="omgcontainer90">
			<h2>' . $lang[$language]["Modify_Remove_h2"] . '</h2>
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
  						<input type="submit" value="' . $lang[$language]["Modify_but"] . '">
						</form>
					</td>
          <td>
						<form method="post" action="admin.php">
  						<input type="hidden" name="user" value="' . $_POST["user"] . '">
  						<input type="hidden" name="pass" value="' . $_POST["pass"] . '">
  						<input type="hidden" name="rmBotname" value="' . $b->getName() . '">
  						<input type="submit" value="' . $lang[$language]["Remove_but"] . '">
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
        <input type="submit" value="' . $lang[$language]["Connect_but"] . '">
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
