<?php //start before HTML code
session_start();

require_once 'config.php';
require_once 'xdcc.php';

if (isset($_POST["nameBot"]) && isset($_POST["xmlBot"]) && !isset($_POST["isModifBotname"])) {
    insertBot(new Bot($_POST["nameBot"], $_POST["xmlBot"], $_POST["websiteBot"], $_POST["ircBot"]));
    $_SESSION['message'] = '<div class="omgmsg omginfo">
                                <p class="omgcenter">' . $_POST["nameBot"] . ' ' . $lang[$language]["bot_add"] . '</p>
                            </div>';
    unset($_POST["nameBot"]);
    unset($_POST["xmlBot"]);
    unset($_POST["websiteBot"]);
    unset($_POST["ircBot"]);
}
else if (isset($_POST["isModifBotname"])) {
    removeBot($_POST["isModifBotname"]);
    insertBot(new Bot($_POST["nameBot"], $_POST["xmlBot"], $_POST["websiteBot"], $_POST["ircBot"]));
    $_SESSION['message'] = '<div class="omgmsg omginfo">
            <p class="omgcenter">' . $_POST["isModifBotname"] . ' ' . $lang[$language]["bot_modify"] . '</p>
           </div>';
    unset($_POST["isModifBotname"]);
    unset($_POST["nameBot"]);
    unset($_POST["xmlBot"]);
    unset($_POST["websiteBot"]);
    unset($_POST["ircBot"]);
}
else if (isset($_POST["rmBotname"])) {
    removeBot($_POST["rmBotname"]);
    $_SESSION['message'] = '<div class="omgmsg omginfo">
            <p class="omgcenter">' . $_POST["rmBotname"] . ' ' . $lang[$language]["bot_remove"] . '</p>
          </div>';
    unset($_POST["rmBotname"]);
}

?>
