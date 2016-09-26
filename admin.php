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
          <ul>
            <li><a class="omgbtn" href="index.php">' . $lang[$language]["Home_but"] . '</a></li>';
            echo '<li><a class="omgbtn" href="logout.php">' . $lang[$language]["Disconnect_but"] . '</a></li>';
          echo '</ul>
        </nav>
      </header>';

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
	echo '<div class="omgcontainer90">';
		echo '<section class="omggrid omg3columns">
        <div class="omgblock">
            <div class="omgborder">';
			echo '<h3>' . $lang[$language]["Modify_Remove_h2"] . '</h3>';
                require_once 'xdcc.php';
                $bots = getBotList();
				echo '<table>';
                foreach($bots as &$b) {
                    echo '<tr class="omgcenter">
                    <td>' . $b->getName() . '</td>
                    <td>
                        <form method="post" action="bot_admin.php">
            							<input type="hidden" name="modifBot" value="' . $b->getName() . '">
            							<input type="image" class="icon" src="img/Edit_icon.svg" alt="Modif">
            						</form>
                    </td>
                    <td>
          						<form method="post" action="update.php">
          							<input type="hidden" name="export_ddl" value="' . $b->getName() . '">
          							<input type="image" class="icon" src="img/csv_file.svg" alt="Modif">
          						</form>
                    </td>
                    <td>
          						<form method="post" action="update.php">
          							<input type="hidden" name="rmBot" value="' . $b->getName() . '">
          							<input type="image" class="icon" src="img/remove_icon.svg" alt="Modif">
          						</form>
                    </td>
                    </tr>';
                }
              echo '</table>';
            echo '</div>';
		    echo '</div>';
		echo '<div class="omgblock omgblockof2 omgpullleft">';
  		echo '<form method="post" action="update.php" enctype="multipart/form-data">
      				<input type="hidden" name="upload_json" value="true">
      				<input type="file" id="uploadedfile" name="uploadedfile">
      				<input type="submit" value="Import data.json" >
      			</form>';
  		echo '<form method="post" action="update.php">
      				<input type="hidden" name="exp_json" value="true">
      				<input type="submit" value="Export data.json" >
  			    </form>';
		echo '</div>';
		echo '</section>';
		echo '</div>';
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
