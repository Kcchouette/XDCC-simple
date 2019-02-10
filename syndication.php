<?php

require_once 'config.php';
require_once 'xdcc.php';

header('Content-type: application/atom+xml');

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
echo "<feed xmlns=\"http://www.w3.org/2005/Atom\" xml:lang=\"$language\">";
echo "<title type=\"text\">$title | Feed</title>";
echo "<subtitle type=\"text\">$description</subtitle>";

// echo "<link rel=\"alternate\" type=\"html\" href=\"http://{$_SERVER['SERVER_NAME']}{$_SERVER['REQUEST_URI']}>"; // (have the url of the index.php page)
// echo "<author></author>"; // (recommended)

$url_root = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://{$_SERVER['HTTP_HOST']}";

$url = $url_root . $_SERVER['REQUEST_URI'];

echo "<id>tag:{$_SERVER['HTTP_HOST']},2016:" . htmlspecialchars($url) . "</id>";
echo "<link href=\"$url\" rel=\"self\"/>";

if (isset($_GET['bot'])) {
	$xml = haveXMLfile(searchBotXMLFile(getBotList(), $_GET['bot']));
	if ($xml && $xml->packlist->pack) {

		echo "<updated>" . date('c', (int)$xml->sysinfo->stats->lastupdate) . "</updated>";

		foreach($xml->packlist->pack as $p) {
			echo "<entry>";
			echo "<title><![CDATA[{$p->packname}]]></title>";
			echo "<link href=\"index.php?{$_GET['bot']}&amp;search=" . urlencode($p->packname) . "/>";
			echo "<id>tag:{$_SERVER['HTTP_HOST']}," . date('Y', (int)$p->adddate) . ":{$p->packbytes}</id>";
			echo "<updated>" . date('c', (int)$p->adddate) . "</updated>";
			echo "<summary>/msg {$_GET['bot']} xdcc send #{$p->packnr}</summary>";
			echo "</entry>";
		}
	}
}
echo "</feed>";
?>