<!DOCTYPE html>
<html lang="<?php require_once 'config.php'; echo $lang; ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <?php require_once 'config.php';
    if($can_track) {
      echo '<meta name="robots" content="index, follow">';
    }
    else {
      echo '<meta name="robots" content="noindex, nofollow, noarchive">';
    }
   ?>

  <title><?php require_once 'config.php'; echo $title; ?></title>

  <link href="css/main.css" rel="stylesheet">

  <!-- OMGCSS core CSS -->
  <link href="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/css/omg.css" rel="stylesheet">

</head>

<body class="omgcontainer90">

  <center><h1><?php require_once 'config.php'; echo $title; ?></h1></center>

  <section>
        <a onclick="toggleMenu('menu2')"  class="menubtn">&#9776;</a>
        <nav id="menu2" class="omgmenu omginline omgpullleft" style="display:none">
          <ul>
            <?php require_once 'config.php';
                  require_once 'xdcc.php';
            //test if bot is get + if website else show main
            /* A variable is considered empty
                * if it does not exist
                * if its value equals FALSE
                * else the var exists AND has a non-empty, non-zero value.
            */
            if (isset($_GET["bot"]) && !empty(returnBotWebsite(getBotList(), $_GET["bot"]))) {
                echo '<li><a href="' . returnBotWebsite(getBotList(), $_GET["bot"]) . '" class="omgbtn">' . $_GET["bot"] . ' ' . $lang[$language]["website"] . '</a></li>';
            }
            else if (!isset($_GET["bot"]) && !empty($website_link)) {
              echo '<li><a href="' . $website_link . '" class="omgbtn">' . $website_label . '</a></li>';
            }

            if (isset($_GET["bot"]) && !empty(returnBotIRC(getBotList(), $_GET["bot"]))) {
                echo '<li><a href="' . returnBotIRC(getBotList(), $_GET["bot"]) . '" class="omgbtn omgrounded omgwarn">' . $_GET["bot"] . ' ' . $lang[$language]["IRC"] . '</a></li>';
            }
            else if (!isset($_GET["bot"]) && !empty($irc_link)) {
              echo '<li><a href="' . $irc_link . '" class="omgbtn omgrounded omgwarn">'. $irc_label . '</a></li>';
            }
            ?>
          </ul>
        </nav>
      </section>

  <section class="omggrid omg3columns">
    <div class="omgblock">
      <div class="omgborder">
        <h3><?php require_once 'config.php'; echo $lang[$language]["Bots"]; ?></h3>
        <p>
          <?php require_once 'xdcc.php';
          $bots = getBotList();
          foreach($bots as &$bot) {
            echo '<a class="chbot" href="?bot=' . $bot->getName() . '">' . $bot->getName() . '</a><br>';
          }
          ?>
        </p>
      </div>
      <?php
      require_once 'config.php';
      if ($bookmark) {
        echo "
        <h3>Bookmarks</h3>
        <p>Bookmarks is not yet finished...</p>
        ";
      }
      ?>
    </div>
    <div class="omgblock omgblockof2">
      <h3><?php require_once 'config.php'; echo $lang[$language]["Bot:"] . ' ' . htmlspecialchars($_GET["bot"]); ?></h3>
      <p><div><?php

      require_once 'config.php';

      if (!isset($_GET["bot"])) {
        echo '<div class="omgcenter">' . $lang[$language]["choose_bot"] . '</div>';
      }
      else {
        require_once 'xdcc.php';

        echo '<table>';

        $xml = simplexml_load_file(searchBotList(getBotList(), $_GET["bot"]));

        if (!$xml->packlist->pack)
          echo '<tr id="trmain"><th>' . $lang[$language]["Fail_load_XML"] . '</th></tr>';
        else {
          echo '<tr id="trmain">';
          echo '<th>' . $lang[$language]["Pack"] . '</th>';
          echo '<th>' . $lang[$language]["Size"] . '</th>';
          echo '<th>' . $lang[$language]["File"] . '</th>';
          echo '</tr>';

          foreach($xml->packlist->pack as $p) {
            echo '<tr>';
            echo '<td class="omgcenter">' . $p->packnr . '</td>';
            echo '<td class="omgcenter">' . $p->packsize . '</td>';
            echo '<td>';
            echo '<a href="#" onclick="javascript:paste(\'' . $_GET["bot"] . '\', ' . $p->packnr . ');" title="' . $p->packname . '" >' . $p->packname . '</a>';
            echo '</td>';
            echo '</tr>';
          }

        }

        echo '</table>';
      }
      ?>
    </div>
  </div>
</section>

<footer class="omgcenter">
<?php
  require_once 'config.php';
  echo $lang[$language]["Powered"] . ' <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a> - <a href="admin.php">' . $lang[$language]["Admin_page"] . '</a>';
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

<!--<script src="script.js"></script>-->

<!-- OMGCSS small js -->
<script src="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/js/omg.js"></script>

</body>

</html>
