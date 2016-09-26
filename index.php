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

    <link href="css/main.css" rel="stylesheet">

    <!-- OMGCSS core CSS -->
    <link href="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/css/omg.css" rel="stylesheet">

</head>

<body class="omgcontainer90">

    <center><h1><?php require_once 'config.php'; echo $title; ?></h1></center>

    <section>
        <a onclick="toggleMenu('menu1')"  class="menubtn">&#9776;</a>
        <nav id="menu1" class="omgmenu omginline" style="display:none">
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
            <form name="searchform" class="omgpullright">
              <input type="text" name="search" placeholder="Search on "  <?php if(!empty($_GET["search"])) echo 'value="' . $_GET["search"] . '"';?> required/>
			  <select name="bot">
				<option value="">TOUS</option>
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
              <input type="submit" class="omgbtn omgokay" value="Search"/>
            </form>
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
            <?php require_once 'config.php';
            if ($bookmark) {
                echo "
                    <h3>Bookmarks</h3>
                    <p>Bookmarks is not yet finished...</p>
                ";
            }
            ?>
        </div>
        <div class="omgblock omgblockof2">
        <h3><?php require_once 'config.php'; if(!empty($_GET["bot"])) echo ' &#8212; ' . $lang[$language]["Bot:"] . ' <code>' . htmlspecialchars($_GET["bot"]) . '</code>' . ' <a href="syndication.php?bot=' . $_GET["bot"] . '"> <img class="icon" src="img/Feed-icon.svg"></a> '; if(isset($_GET["search"])) echo ' &#8212; Recherche : <code>' . htmlspecialchars($_GET["search"]) . '</code>'; ?></h3>
            <div><?php

            require_once 'config.php';

            if (!isset($_GET["bot"]) && !isset($_GET["search"])) { //if none set, show an error
                echo '<div class="omgcenter">' . $lang[$language]["choose_bot"] . '</div>';
            }
            else if (empty($_GET["bot"])) { //if bot is empty, search in all bot
              echo searchBotsList($_GET["search"]);
            }
            else { //if bot, show all the list OR show the search on a bot
                require_once 'xdcc.php';

                echo '<table id="filelist">';

                $xml = simplexml_load_file(searchBotXMLFile(getBotList(), $_GET["bot"]));

                if (!$xml->packlist->pack)
                    echo '<tr id="trmain"><th>' . $lang[$language]["Fail_load_XML"] . '</th></tr>';
                else {
                    echo '<tr id="trmain">';
                    echo '<th>' . $lang[$language]["Pack"] . '</th>';
                    echo '<th>' . $lang[$language]["Size"] . '</th>';
                    echo '<th>' . $lang[$language]["File"] . '</th>';
                    echo '</tr>';

                    if (!empty($_GET["search"]))
                      echo searchBotList($xml, $_GET["bot"], $_GET["search"]);
                    else
                      echo showBotList($xml);
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

<!-- <script type='text/javascript' src='js/script.js'></script> -->

<!-- OMGCSS small js -->
<script src="https://cdn.rawgit.com/Kcchouette/omgcss/ef95db62775411425dfc2f0bcc6a8a43282efc83/dist/js/omg.js"></script>

</body>

</html>
