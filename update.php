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

if (!isset($_POST["export_ddl"])) {
    header ('location: admin.php');
}
else {
    require_once 'xdcc.php';
    $xml = simplexml_load_file(searchBotList(getBotList(), $_POST["export_ddl"]));

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $_POST["export_ddl"] . '.csv"');
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $line = 0;

    $csv[$line++] = array($lang[$language]["Pack"], $lang[$language]["File"], $lang[$language]["Size"], $lang[$language]["Downloads"]); //i = 0, and after this line, i = 1

    foreach($xml->packlist->pack as $p) {
        $csv[$line++] = array($p->packnr, $p->packname, $p->packsize, $p->packgets);
    }

    $csv[$line++] = array();
    $csv[$line++] = array();
    $csv[$line++] = array($lang[$language]["Pack_number"], $xml->sysinfo->quota->packsum, '', $lang[$language]["Transfered_daily"], $xml->sysinfo->quota->transfereddaily);
    $csv[$line++] = array($lang[$language]["Packs_size"], $xml->sysinfo->quota->diskspace, '', $lang[$language]["Transfered_weekly"], $xml->sysinfo->quota->transferedweekly);
    $csv[$line++] = array('', '', '', $lang[$language]["Transfered_monthly"], $xml->sysinfo->quota->transferedmonthly);
    $csv[$line++] = array('', '', '', $lang[$language]["Transfered_total"], $xml->sysinfo->quota->transferedtotal);
    $csv[$line++] = array();
    $csv[$line++] = array($lang[$language]["Last_update"], date('r', (int)$xml->sysinfo->stats->lastupdate));
    $csv[$line++] = array();
    $csv[$line++] = array();
    $csv[$line++] = array($lang[$language]["Other_sysinfo"]);
    $csv[$line++] = array('', $lang[$language]["Slots_max"], $xml->sysinfo->slots->slotsmax);
    $csv[$line++] = array('', $lang[$language]["Main_queue_max"], $xml->sysinfo->mainqueue->queuemax);
    $csv[$line++] = array('', $lang[$language]["Idle_queue_max"], $xml->sysinfo->idlequeue->queuemax);
    $csv[$line++] = array('', $lang[$language]["Bandwith_max"], $xml->sysinfo->bandwidth->bandmax);

    $fp = fopen('php://output', 'w');
    foreach ($csv as $line) {
        fputcsv($fp, $line, $csv_separator);
    }
    fclose($fp);

    unset($_POST["export_ddl"]);
}

?>
