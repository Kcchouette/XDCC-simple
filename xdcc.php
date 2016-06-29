<?php

//controler

require_once 'database.php';
require_once 'class/Bot.php';

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

	$id = searchIdBot($bots, $bname);

	unset($bots[$id]); //removes the array at given index
    $reindex = array_values($bots); //normalize index
    $bots = $reindex; //update variable

	saveBotList($bots);
}

function searchBotList($b, $n) {
	for($i = 0; $i < count($b); $i++) {
		if($b[$i]->getName() == $n) {
			return $b[$i]->getXmlFile();
		}
	}
}

function returnBotWebsite($b, $n) {
	for($i = 0; $i < count($b); $i++) {
		if($b[$i]->getName() == $n) {
			return $b[$i]->getWebsite();
		}
	}
}

function returnBotIRC($b, $n) {
	for($i = 0; $i < count($b); $i++) {
		if($b[$i]->getName() == $n) {
			return $b[$i]->getIRC();
		}
	}
}

function searchIdBot($b, $n) {
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



	function haveSize( $nbytes ) {

		if ( $nbytes < 0 ) {
			return '0b';
		}
		if ( $nbytes < 1000 ) {
			return sprintf( '%db', $nbytes );
		}
		$nbytes = ( $nbytes + 512 ) / 1024;
		if ( $nbytes < 1000 ) {
			return sprintf( '%dk', $nbytes );
		}
		$nbytes = ( $nbytes + 512 ) / 1024;
		if ( $debug != '' ) {
			return sprintf( '%dM', $nbytes );
		}
		if ( $nbytes < 1000 ) {
			return sprintf( '%dM', $nbytes );
		}
		if ( $nbytes < 10000 ) {
			return sprintf( '%.1fG', $nbytes / 1024 );
		}
		$nbytes = ( $nbytes + 512 ) / 1024;
		if ( $nbytes < 1000 ) {
			return sprintf( '%dG', $nbytes );
		}
		if ( $nbytes < 10000 ) {
			return sprintf( '%.1fT', $nbytes / 1024 );
		}
		$nbytes = ( $nbytes + 512 ) / 1024;
		if ( $nbytes < 1000 ) {
			return sprintf( '%dT', $nbytes );
		}
		return sprintf( '%dE', $nbytes );
	}

?>
