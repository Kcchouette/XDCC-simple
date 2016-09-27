<?php //start before HTML code
session_start();

require_once 'config.php';
require_once 'xdcc.php';

if (isset($_POST["isCreate"])) {
	insertBot(new Bot($_POST["nameBot"], $_POST["xmlBot"], $_POST["websiteBot"], $_POST["ircBot"]));

	$_SESSION['message'] = '<div class="omgmsg omginfo">
								<p class="omgcenter">' . $_POST["nameBot"] . ' ' . $lang[$language]["bot_add"] . '</p>
							</div>';

	unset($_POST["nameBot"]);
	unset($_POST["xmlBot"]);
	unset($_POST["websiteBot"]);
	unset($_POST["ircBot"]);
	unset($_POST["isCreate"]);
	header ('location: admin.php');
}
else if (isset($_POST["isModifBot"])) {

	removeBot($_POST["isModifBot"]);
	insertBot(new Bot($_POST["nameBot"], $_POST["xmlBot"], $_POST["websiteBot"], $_POST["ircBot"]));

	$_SESSION['message'] = '<div class="omgmsg omginfo">
								<p class="omgcenter">' . $_POST["isModifBot"] . ' ' . $lang[$language]["bot_modify"] . '</p>
							</div>';

	unset($_POST["isModifBot"]);
	unset($_POST["nameBot"]);
	unset($_POST["xmlBot"]);
	unset($_POST["websiteBot"]);
	unset($_POST["ircBot"]);
	header ('location: admin.php');
}
else if (isset($_POST["rmBot"])) {
	removeBot($_POST["rmBot"]);
	$_SESSION['message'] = '<div class="omgmsg omginfo">
								<p class="omgcenter">' . $_POST["rmBot"] . ' ' . $lang[$language]["bot_remove"] . '</p>
							</div>';

	unset($_POST["rmBot"]);
	header ('location: admin.php');
}

else if (isset($_POST["export_ddl"])) {
	$xml = haveXMLfile(searchBotXMLFile(getBotList(), $_POST["export_ddl"]));

	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $_POST["export_ddl"] . '.csv"');
	echo "\xEF\xBB\xBF"; // UTF-8 BOM

	$line = 0;

	$csv[$line++] = array($lang[$language]["Pack"], $lang[$language]["File"], $lang[$language]["Size"], $lang[$language]["Downloads"]); //i = 0, and after this line, i = 1

	if($xml && $xml->packlist->pack) {
		foreach($xml->packlist->pack as $p) {
			$csv[$line++] = array($p->packnr, $p->packname, $p->packsize, $p->packgets);
		}
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

else if (isset($_POST["exp_json"])) {

	header('Content-disposition: attachment; filename=' . $bot_file);
	header('Content-type: application/json');
	echo file_get_contents($bot_file);

	unset($_POST["exp_json"]);
}

else if (isset($_POST["upload_json"])) {

	$target_file = basename($_FILES["uploadedfile"]["name"]);

	if ($target_file === $bot_file && pathinfo($target_file, PATHINFO_EXTENSION) === 'json') {
		if(file_exists($target_file)) {
			unlink($target_file); //remove the file
		}
		if (move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $target_file)) {
			$_SESSION['message'] = '<div class="omgmsg omginfo">
								<p class="omgcenter">' . $lang[$language]["Upload_file"] . '</p>
							</div>';
		 }
		 else {
		 	$_SESSION['message'] = '<div class="omgmsg omgerr">
								<p class="omgcenter">' . $lang[$language]["Upload_file_fail"] . '</p>
							</div>';
		 }

		
	}
	else {
		$_SESSION['message'] = '<div class="omgmsg omgwarn">
								<p class="omgcenter">' . $lang[$language]["Upload_file_fail_name"] . '</p>
							</div>';
	}

	unset($_POST["upload_json"]);
	header ('location: admin.php');
}

else
	header ('location: admin.php');

?>