<?php

	class Bot {

		private $name = "";
		private $xml = "";

		function __construct($n, $x) {
			$this->name = $n;
			$this->xml = $x;
		}

		public function getName() {
			return $this->name;
		}

		public function getXmlFile() {
			return $this->xml;
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

	function getBotList() {
		$string = file_get_contents("data.json");
		$jsonRS = json_decode($string, true);
		$bots = array();
		foreach ($jsonRS as $rs) {
			array_push($bots, new Bot(stripslashes($rs["name"]), stripslashes($rs["xml"])));
		}
		return $bots;
	}

	function searchBot($b, $n) {
		for($i = 0; $i < count($b); $i++) {
			if($b[$i]->getName() == $n) {
				return $b[$i]->getXmlFile();
			}
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
