<?php // start before HTML code
session_start();

require_once 'config.php';
require_once 'database.php';
require_once 'xdcc.php';

// BOT
if (isset($_POST['isCreateBot'])) {
	insertBot(new Bot(htmlspecialchars($_POST['nameBot'], ENT_COMPAT), $_POST['xmlBot'], $_POST['websiteBot'], $_POST['ircBot']));

	$_SESSION['message'] = "<div class=\"text-success\">
								<p>{$_POST['nameBot']} {$lang[$language]['msg_add']}</p>
							</div>";

	unset($_POST['nameBot']);
	unset($_POST['xmlBot']);
	unset($_POST['websiteBot']);
	unset($_POST['ircBot']);
	unset($_POST['isCreateBot']);
	header ('location: admin.php');
}
else if (isset($_POST['isModifBot'])) {

	removeBot(htmlspecialchars($_POST['isModifBot'], ENT_COMPAT));
	insertBot(new Bot(htmlspecialchars($_POST['nameBot'], ENT_COMPAT), $_POST['xmlBot'], $_POST['websiteBot'], $_POST['ircBot']));

	$_SESSION['message'] = "<div class=\"text-success\">
								<p>{$_POST['isModifBot']} {$lang[$language]['msg_modify']}</p>
							</div>";

	unset($_POST['isModifBot']);
	unset($_POST['nameBot']);
	unset($_POST['xmlBot']);
	unset($_POST['websiteBot']);
	unset($_POST['ircBot']);
	header ('location: admin.php');
}
else if (isset($_POST['rmBot'])) {
	removeBot(htmlspecialchars($_POST['rmBot'], ENT_COMPAT));
	$_SESSION['message'] = "<div class=\"text-success\">
								<p>{$_POST['rmBot']} {$lang[$language]['msg_remove']}</p>
							</div>";

	unset($_POST['rmBot']);
	header ('location: admin.php');
}
// BOOKMARK
else if (isset($_POST['isCreateBookmark'])) {
	insertBookmark(new Bookmark(htmlspecialchars($_POST['nameBookmark'], ENT_COMPAT), htmlspecialchars($_POST['searchBookmark'], ENT_COMPAT), htmlspecialchars($_POST['botBookmark'], ENT_COMPAT)));

	$_SESSION['message'] = "<div class=\"text-success\">
								<p>{$_POST['nameBookmark']} {$lang[$language]['msg_add']}</p>
							</div>";

	unset($_POST['nameBookmark']);
	unset($_POST['searchBookmark']);
	unset($_POST['botBookmark']);
	unset($_POST['isCreateBookmark']);
	header ('location: admin.php');
}
else if (isset($_POST['isModifBookmark'])) {

	removeBookmark(htmlspecialchars($_POST['isModifBookmark'], ENT_COMPAT));
	insertBookmark(new Bookmark(htmlspecialchars($_POST['nameBookmark'], ENT_COMPAT), htmlspecialchars($_POST['searchBookmark'], ENT_COMPAT), htmlspecialchars($_POST['botBookmark'], ENT_COMPAT)));

	$_SESSION['message'] = "<div class=\"text-success\">
								<p>{$_POST['isModifBookmark']} {$lang[$language]['msg_modify']}</p>
							</div>";

	unset($_POST['isModifBookmark']);
	unset($_POST['nameBookmark']);
	unset($_POST['searchBookmark']);
	unset($_POST['botBookmark']);
	header ('location: admin.php');
}
else if (isset($_POST['rmBookmark'])) {
	removeBookmark(htmlspecialchars($_POST['rmBookmark'], ENT_COMPAT));
	$_SESSION['message'] = "<div class=\"text-success\">
								<p>{$_POST['rmBookmark']} {$lang[$language]['msg_remove']}</p>
							</div>";

	unset($_POST['rmBookmark']);
	header ('location: admin.php');
}
// OTHER
else if (isset($_POST['export_ddl'])) {
	$xml = haveXMLContent(searchBotXMLContent(getBotList(), htmlspecialchars($_POST['export_ddl'], ENT_COMPAT)));

	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . htmlspecialchars($_POST['export_ddl'], ENT_COMPAT) . '.csv"');
	echo "\xEF\xBB\xBF"; // UTF-8 BOM

	$line = 0;

	$csv[$line++] = array($lang[$language]['Pack'], $lang[$language]['File'], $lang[$language]['Size'], $lang[$language]['Downloads']); // i = 0, and after this line, i = 1

	if($xml && $xml->packlist->pack) {
		foreach($xml->packlist->pack as $p) {
			$csv[$line++] = array($p->packnr, $p->packname, $p->packsize, $p->packgets);
		}
	}

	$csv[$line++] = array();
	$csv[$line++] = array();
	$csv[$line++] = array($lang[$language]['Pack_number'], $xml->sysinfo->quota->packsum, "", $lang[$language]['Transfered_daily'], $xml->sysinfo->quota->transfereddaily);
	$csv[$line++] = array($lang[$language]['Packs_size'], $xml->sysinfo->quota->diskspace, "", $lang[$language]['Transfered_weekly'], $xml->sysinfo->quota->transferedweekly);
	$csv[$line++] = array("", "", "", $lang[$language]['Transfered_monthly'], $xml->sysinfo->quota->transferedmonthly);
	$csv[$line++] = array("", "", "", $lang[$language]['Transfered_total'], $xml->sysinfo->quota->transferedtotal);
	$csv[$line++] = array();
	$csv[$line++] = array($lang[$language]['Last_update'], date('r', (int)$xml->sysinfo->stats->lastupdate));
	$csv[$line++] = array();
	$csv[$line++] = array();
	$csv[$line++] = array($lang[$language]['Other_sysinfo']);
	$csv[$line++] = array("", $lang[$language]['Slots_max'], $xml->sysinfo->slots->slotsmax);
	$csv[$line++] = array("", $lang[$language]['Main_queue_max'], $xml->sysinfo->mainqueue->queuemax);
	$csv[$line++] = array("", $lang[$language]['Idle_queue_max'], $xml->sysinfo->idlequeue->queuemax);
	$csv[$line++] = array("", $lang[$language]['Bandwith_max'], $xml->sysinfo->bandwidth->bandmax);

	$fp = fopen('php://output', 'w');
	foreach ($csv as $line) {
		fputcsv($fp, $line, $csv_separator);
	}
	fclose($fp);

	unset($_POST['export_ddl']);
}

else if (isset($_POST['exp_bot_json'])) {

	header('Content-disposition: attachment; filename="' . databaseBotNameFile() . '"');
	header('Content-type: application/json');
	echo file_get_contents(databaseBotFullFile());

	unset($_POST['exp_json']);
}

else if (isset($_POST['exp_bookmark_json'])) {

	header('Content-disposition: attachment; filename="' . databaseBookmarkNameFile() . '"');
	header('Content-type: application/json');
	echo file_get_contents(databaseBookmarkFullFile());

	unset($_POST['exp_json']);
}

else if (isset($_POST['upload_bot_json'])) {

	$target_file = basename($_FILES['uploadedfile']['name']);

	if ($target_file === databaseBotNameFile() && pathinfo($target_file, PATHINFO_EXTENSION) === 'json') {
		if(file_exists(databaseBotFullFile())) {
			unlink(databaseBotFullFile()); // remove the file
		}
		if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], databaseBotFullFile())) {
			$_SESSION['message'] = "<div class=\"text-success\">
								<p>{$lang[$language]['Upload_file']}</p>
							</div>";
		 }
		 else {
		 	$_SESSION['message'] = "<div class=\"text-error\">
								<p>{$lang[$language]['Upload_file_fail']}</p>
							</div>";
		 }

		
	}
	else {
		$_SESSION['message'] = "<div class=\"text-warning\">
								<p>{$lang[$language]['Upload_file_fail_name']}</p>
							</div>";
	}

	unset($_POST['upload_json']);
	header ('location: admin.php');
}

else if (isset($_POST['upload_bookmark_json'])) {

	$target_file = basename($_FILES['uploadedfile']['name']);

	if ($target_file === databaseBookmarkNameFile() && pathinfo($target_file, PATHINFO_EXTENSION) === 'json') {
		if(file_exists(databaseBookmarkFullFile())) {
			unlink(databaseBookmarkFullFile()); // remove the file
		}
		if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], databaseBookmarkFullFile())) {
			$_SESSION['message'] = "<div class=\"text-success\">
								<p>{$lang[$language]['Upload_file']}</p>
							</div>";
		 }
		 else {
		 	$_SESSION['message'] = "<div class=\"text-error\">
								<div>{$lang[$language]['Upload_file_fail']}</div>
							</div>";
		 }

		
	}
	else {
		$_SESSION['message'] = "<div class=\"text-warning\">
								<p>$target_file</p>
							</div>";
	}

	unset($_POST['upload_json']);
	header ('location: admin.php');
}

else
	header ('location: admin.php');

?>