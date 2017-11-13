<?php

//controler

require_once 'database.php';
require_once 'class/Bookmark.php';
require_once 'class/Bot.php';


function haveXMLfile($xmlFile) {
	if (file_exists($xmlFile))
		return simplexml_load_file($xmlFile);
	else
		return false;
}

// return bookmark or bot object
function returnObject($b, $n) {
	for($i = 0; $i < count($b); $i++) {
		if($b[$i]->getName() == $n) {
			return $b[$i];
		}
	}
}

function searchId($b, $n) {
	for($i = 0; $i < count($b); $i++) {
		if($b[$i]->getName() == $n) {
			return $i;
		}
	}
}


class XDCC_File {

	private $id = "";
	private $name = "";

	function __construct($id, $n) {
		$this->id = $id;
		$this->name = $n;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}
}


/*
 ____              _                         _
| __ )  ___   ___ | | ___ __ ___   __ _ _ __| | __
|  _ \ / _ \ / _ \| |/ / '_ ` _ \ / _` | '__| |/ /
| |_) | (_) | (_) |   <| | | | | | (_| | |  |   <
|____/ \___/ \___/|_|\_\_| |_| |_|\__,_|_|  |_|\_\
*/

function getBookmarkList() {
	$jsonRS = readBookmarkFile();
	$bookmarks = array();
	foreach ($jsonRS as $rs) {
		array_push($bookmarks, new Bookmark(stripslashes($rs["name"]), stripslashes($rs["search"]), stripslashes($rs["bot"])));
	}
	return $bookmarks;
}

function insertBookmark($b) {
	$bookmarks = getBookmarkList();
	array_push($bookmarks, $b);
	//save database
	saveBookmarkList($bookmarks);
}

//http://stackoverflow.com/q/21559760
function removeBookmark($bname) {
	$bookmarks = getBookmarkList();

	$id = searchId($bookmarks, $bname);

	unset($bookmarks[$id]); //removes the array at given index
	$reindex = array_values($bookmarks); //normalize index
	$bookmarks = $reindex; //update variable

	saveBookmarkList($bookmarks);
}


/*
 ____        _
| __ )  ___ | |_
|  _ \ / _ \| __|
| |_) | (_) | |_
|____/ \___/ \__|
*/

function getBotList() {
	$jsonRS = readBotFile();
	$bots = array();
	foreach ($jsonRS as $rs) {
		array_push($bots, new Bot(stripslashes($rs["name"]), stripslashes($rs["xml"]), stripslashes($rs["website"]), stripslashes($rs["irc"])));
	}
	return $bots;
}

function insertBot($b) {
	$bots = getBotList();
	array_push($bots, $b);
	//save database
	saveBotList($bots);
}

//http://stackoverflow.com/q/21559760
function removeBot($bname) {
	$bots = getBotList();

	$id = searchId($bots, $bname);

	unset($bots[$id]); //removes the array at given index
	$reindex = array_values($bots); //normalize index
	$bots = $reindex; //update variable

	saveBotList($bots);
}

function searchBotXMLFile($b, $n) {
	for($i = 0; $i < count($b); $i++) {
			if($b[$i]->getName() == $n) {
				return $b[$i]->getXmlFile();
			}
	}
}

function searchBotList($xml, $bot, $search = null, $onBot = true) {
	$dom = '';
	foreach($xml->packlist->pack as $p) {
		if ($search === null || stripos($p->packname, $search) !== false) {
			$dom .= '<tbody><tr class="mouse_pointer" title="' . $bot . ' &#x2014; ' . $p->packname . '" onclick="javascript:paste(\'' . $bot . '\', ' . $p->packnr . ');">';
			if (!$onBot)
				$dom .= '<td class="text-center">' . $bot . '</td>';
			$dom .= '<td class="text-center">' . $p->packnr . '</td>';
			$dom .= '<td class="text-center">' . $p->packsize . '</td>';
			$dom .= '<td>' . $p->packname . '</td>';
			$dom .= '</tr></tbody>';
		}
	}
	return $dom;
}

function searchBotsList($search) {
	require 'config.php'; //with require_once, it does nothing

	$dom = '';
	$bots = getBotList();
	$dom .= '<table id="filelist">';
	$dom .= '<tr id="trmain">';
	$dom .= '<th>' . $lang[$language]["Bot:"] . '</th>';
	$dom .= '<th>' . $lang[$language]["Pack"] . '</th>';
	$dom .= '<th>' . $lang[$language]["Size"] . '</th>';
	$dom .= '<th>' . $lang[$language]["File"] . '</th>';
	$dom .= '</tr>';
	foreach($bots as $bot) {
		$xml = haveXMLfile(searchBotXMLFile(getBotList(), $bot->getName()));
		if (!$xml || !$xml->packlist->pack)
			;
		else
			$dom .= searchBotList($xml, $bot->getName(), $search, false);
	}
	$dom .= '</table>';
	return $dom;
}

?>
