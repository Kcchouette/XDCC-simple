<?php //start before HTML code
session_start();

require_once 'config.php';
require_once 'xdcc.php';

if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
  echo '<!DOCTYPE html>
  <html lang="' . $lang . '">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>' . $title . ' - ' . $lang[$language]["Admin_page"] . '</title>

      <link href="css/input.css" rel="stylesheet">

      <!-- OMGCSS core CSS -->
      <link href="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/css/omg.css" rel="stylesheet">

    </head>

    <body>
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
      if(isset($_POST["modifBotname"])){
        echo '<h2>' . $lang[$language]["Modify_h2"] . '</h2>';
        echo '<div class="omgcenter">
                    <form method="post" action="update.php">
                        <input type="text" name="nameBot" placeholder="' . $lang[$language]["Bot_name"] . '" value="' . $_POST["modifBotname"] . '" required >
                        <input type="text" name="xmlBot" placeholder="' . $lang[$language]["Bot_xml"] . '" value="' . searchBotList(getBotList(), $_POST["modifBotname"]) . '" required >
                        <input type="url" name="websiteBot" placeholder="' . $lang[$language]["Bot_website"] . '" value="' . returnBotWebsite(getBotList(), $_POST["modifBotname"]) . '" >
                        <input type="url" name="ircBot" placeholder="' . $lang[$language]["Bot_irc"] . '" value="' . returnBotIRC(getBotList(), $_POST["modifBotname"]) . '" >
                        <input type="hidden" name="isModifBotname" value="' . $_POST["modifBotname"] . '">
                        <input type="submit" value="' . $lang[$language]["Modify_but"] . '">
                </form>
            </div>';
      }
      else {
        echo '<h2>' . $lang[$language]["Add_h2"] . '</h2>';
        echo '<div class="omgcenter">
                    <form method="post" action="update.php">
                        <input type="text" name="nameBot" placeholder="' . $lang[$language]["Bot_name"] . '" required >
                        <input type="text" name="xmlBot" placeholder="' . $lang[$language]["Bot_xml"] . '" required >
                        <input type="url" name="websiteBot" placeholder="' . $lang[$language]["Bot_website"] . '" >
                        <input type="url" name="ircBot" placeholder="' . $lang[$language]["Bot_irc"] . '" >
                        <input type="submit" value="' . $lang[$language]["Add_but"] . '">
                </form>
            </div>';
      }
       echo '</div>';

      echo '<div class="omgcontainer90">
            <h2>' . $lang[$language]["Modify_Remove_h2"] . '</h2>';

        $bots = getBotList();

      echo '<table>';
      echo '<tr>
            <th>' . $lang[$language]["Bot_name"] . '</th>
            <th>' . $lang[$language]["Bot_xml"] . '</th>
            <th>' . $lang[$language]["Bot_website"] . '</th>
            <th>' . $lang[$language]["Bot_irc"] . '</th>
            <tr>';
            foreach($bots as $b) {
                echo '<tr class="omgcenter">
                    <td>' . $b->getName() . '</td>
                    <td>' . $b->getXmlFile() . '</td>
                    <td>' . $b->getWebsite() . '</td>
                    <td>' . $b->getIRC() . '</td>
                    <td>
                        <form method="post" action="admin.php">
                        <input type="hidden" name="modifBotname" value="' . $b->getName() . '">
                        <input type="submit" value="' . $lang[$language]["Modify_but"] . '">
                        </form>
                    </td>
                    <td>
                        <form method="post" action="update.php">
                        <input type="hidden" name="rmBotname" value="' . $b->getName() . '">
                        <input type="submit" value="' . $lang[$language]["Remove_but"] . '">
                        </form>
                    </td>
                    <td>
                        <form method="post" action="update.php">
                        <input type="hidden" name="export_ddl" value="' . $b->getName() . '">
                        <input type="submit" value="' . $lang[$language]["Export_csv"] . '">
                        </form>
                    </td>
                </tr>';
                }

        echo '</table>';
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
