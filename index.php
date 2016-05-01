<!DOCTYPE html>
<html lang="<?php require 'config.php'; echo $lang; ?>">
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

  <title><?php require 'config.php'; echo $title; ?></title>

  <link href="main.css" rel="stylesheet">

  <!-- OMGCSS core CSS -->
  <link href="https://cdn.rawgit.com/fabienwang/omgcss/gh-pages/dist/css/omg.css" rel="stylesheet">

</head>

<body class="omgcontainer90">

  <center><h1><?php require_once 'config.php'; echo $title; ?></h1></center>

  <section>
        <a onclick="toggleMenu('menu2')"  class="menubtn">&#9776;</a>
        <nav id="menu2" class="omgmenu omginline omgpullleft" style="display:none">
          <ul>
            <?php require_once 'config.php';
            //test if bot is get + if website else show main
            if (/*!isset($_GET["bot"]) &&*/ !empty($main_website)) {
              echo '<li><a href="' . $main_website . '" class="omgbtn">' . $name_website . '</a></li>';
            }
            if (/*!isset($_GET["bot"]) &&*/ $main_irc) {
              echo '<li><a href="irc://' . $irc_server .'/' . $irc_channel . '" class="omgbtn omgrounded omgwarn">'. $lang[$language]["IRC"] . ' #' . $irc_channel . ' ' . $lang[$language]["IRC_on"] . ' ' . $irc_server . ' </a></li>';
            }
            ?>
          </ul>
        </nav>
      </section>

  <section class="omggrid omg3columns">
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
      <p><div><?php
      if (!isset($_GET["bot"]))
      {
        require_once 'config.php';
        echo '<div class="omgcenter">' . $lang[$language]["choose_bot"] . '</div>';
      }
      else
      {
        require_once 'xdcc.php';

        echo '<table>';

        $xml = simplexml_load_file(searchBotList(getBotList(), $_GET["bot"]));

        if (!$xml->packlist->pack)
        echo '<tr>Fail to load XML file, or the XML file is empty</tr>';
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
  echo $lang[$language]["Powered"] . ' <a href="https://github.com/Kcchouette/XDCC-simple">XDCC Simple</a>';
 ?>
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
<script src="https://cdn.rawgit.com/fabienwang/omgcss/gh-pages/dist/js/omg.js"></script>

</body>

</html>
